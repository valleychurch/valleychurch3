<?php
include_once('../../../wp-load.php');

define( 'APP_ACCOUNT', 'valley' );
define( 'APP_APPLICATION', 'valleychurch-website' );
define( 'APP_AUTH', 'Dg8lHr5mIg30qcVdN7Je' );
define( 'APP_URL', 'https://api.churchapp.co.uk/v1/calendar/events?group_by_sequence=true&per_page=200' );

$date_today = date("Y-m-d");
  $date_future = date("Y-m-d", strtotime("+3 months"));

  $ch = curl_init(APP_URL . "&date_start=" . $date_today . "&date_end=" . $date_future);
  curl_setopt_array($ch,
    array(
      CURLOPT_TIMEOUT => 0,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_HTTPHEADER => array(
        'X-Account: ' . APP_ACCOUNT,
        'X-Application: ' . APP_APPLICATION,
        'X-Auth: ' . APP_AUTH
      )
    )
  );

  $result = curl_exec($ch);

  curl_close($ch);

  $json = json_decode($result);
  $events = $json->events;
  $email = "Request URL: " . APP_URL + "&date_start=" + $date_today + "&date_end=" + $date_future . "<br/><br/>";

  foreach( $events as $event ) {
    if ( $event->public_visible == 1 && $event->signup_options->public->featured == 1 && $event->category->id != "5" && $event->category->id != "11" ) {
      //Check against currently added events
      $wp_event = new WP_Query(
        array(
          'post_count'  => -1,
          'post_type'   => 'event',
          'meta_key'    => 'identifier',
          'meta_value'  => $event->identifier
        )
      );

      // If it's not found in the DB we can add it
      if ( $wp_event->post_count == 0 ) {
        $post_id = wp_insert_post(
          array(
            'post_type' => 'event',
            'post_title' => $event->name,
            'post_content' => $event->description,
            'post_status' => 'publish',
            'post_author' => 2,
            'comment_status' => 'closed',
            'ping_status' => 'closed',
          )
        );

        // If it's successfully added to the DB
        if ( $post_id ) {
          $email .= "Successfully added " . $event->name . " <a href='" . get_edit_post_link( $post_id ) . "'>(ID: " . $post_id . ")</a> to WP<br/>";

          // Add expiry date
          _scheduleExpiratorEvent( $post_id, strtotime( $event->datetime_end ), array( 'expireType' => 'draft', 'id' => $post_id ) );

          // Update ACF fields
          update_field( 'field_582456c4b953e', $event->identifier, $post_id );
          update_field( 'field_582456d0b953f', $event->datetime_start, $post_id );
          update_field( 'field_58249be78d880', strtotime($event->datetime_start), $post_id );
          update_field( 'field_582456e3b9540', $event->datetime_end, $post_id );
          if ( count( $event->location ) != 0 ) {
            update_field( 'field_582456f3b9541', $event->location->name, $post_id );
            update_field( 'field_582456ffb9542', $event->location->address, $post_id );
            update_field( 'field_58245707b9543', $event->location->latitude, $post_id );
            update_field( 'field_5824570fb9544', $event->location->longitude, $post_id );
          }
          update_field( 'field_5824571ab9545', $event->signup_options->tickets->enabled, $post_id );
          update_field( 'field_58245724b9546', $event->signup_options->tickets->url, $post_id );

          // Try and get the image
          if ( count( $event->images ) > 0 ) {
            $file = $event->images->original_1000;
            add_media_to_wp($event, $file, $post_id);
          }
        }

        // Fail, do something with the error?
        else {
          $email .= "Couldn't add " . $event->name . " to WP<br/>";
        }
      }

      // Run an update?
      else {
        $post_to_update = $wp_event->posts[0];
        $post_id = $post_to_update->ID;
        $update_count = 1;

        //Basic object to add data to
        $updated_info = array(
          'ID' => $post_id
        );

        //If title has changed
        if ( esc_html($post_to_update->post_title) != esc_html($event->name) ) {
          $updated_info["post_title"] = $event->name;
          $update_count++;
        }

        if ( $post_to_update->post_content != $event->description ) {
          $updated_info["post_content"] = $event->description;
          $update_count++;
        }

        if ( get_field( 'identifier', $post_to_update) != $event->identifier ) {
          update_field( 'field_582456c4b953e', $event->identifier, $post_id );
          $update_count++;
        }

        if ( get_field( 'datetime_start', $post_to_update) != $event->datetime_start ) {
          update_field( 'field_582456d0b953f', $event->datetime_start, $post_id );
          $update_count++;
        }

        if ( get_field( 'datetimestamp_start', $post_to_update) != strtotime( $event->datetime_start ) ) {
          update_field( 'field_58249be78d880', strtotime($event->datetime_start), $post_id );
          $update_count++;
        }

        if ( get_field( 'datetime_end', $post_to_update) != $event->datetime_end ) {
          update_field( 'field_582456e3b9540', $event->datetime_end, $post_id );
          _unscheduleExpiratorEvent( $post_id );
          _scheduleExpiratorEvent( $post_id, strtotime( $event->datetime_end ), array( 'expireType' => 'draft', 'id' => $post_id ) );
          $update_count++;
        }

        if ( count( $event->location ) != 0 ) {
          if ( get_field( 'location', $post_to_update) != $event->location->name ) {
            update_field( 'field_582456f3b9541', $event->location->name, $post_id );
            $update_count++;
          }

          if ( get_field( 'location_address', $post_to_update) != $event->location->address ) {
            update_field( 'field_582456ffb9542', $event->location->address, $post_id );
            $update_count++;
          }

          if ( get_field( 'location_latitude', $post_to_update) != $event->location->latitude ) {
            update_field( 'field_58245707b9543', $event->location->latitude, $post_id );
            $update_count++;
          }

          if ( get_field( 'location_longitude', $post_to_update) != $event->location->longitude ) {
            update_field( 'field_5824570fb9544', $event->location->longitude, $post_id );
            $update_count++;
          }
        }

        if ( get_field( 'signup_available', $post_to_update) != $event->signup_options->tickets->enabled ) {
          update_field( 'field_5824571ab9545', $event->signup_options->tickets->enabled, $post_id );
          $update_count++;
        }

        if ( get_field( 'signup_url', $post_to_update) != $event->signup_options->tickets->url ) {
          update_field( 'field_58245724b9546', $event->signup_options->tickets->url, $post_id );
          $update_count++;
        }

        //Update post if there's more data than just ID
        if ( $update_count > 1 ) {
          wp_update_post( $updated_info );
          $email .= "Updated " . $event->name . " (ID: " . $post_id . ")<br/>";
        }

        else {
          $email .= "No need to update " . $event->name . " <a href='" . get_edit_post_link( $post_id ) . "'>(ID: " . $post_id . ")</a><br/>";
        }

        // See if there's a featured image to add
        if ( count( $event->images ) > 0 && !has_post_thumbnail( $post_id ) ) {
          $file = $event->images->original_1000;
          add_media_to_wp($event, $file, $post_id);
        }

      }
    }
  }

  if ( !empty( $email ) ) {
    echo $email;
    wp_mail( 'web@valleychurch.eu', 'ChurchApp event import ' . date( 'd/m/Y' ), $email, array( 'Content-Type: text/html; charset=UTF-8' ) );
  }
?>