<?php
include_once('../../../wp-load.php');

define( 'CS_APP_ACCOUNT', 'valley' );
define( 'CS_APP_APPLICATION', 'valleychurch-website' );
define( 'CS_APP_AUTH', 'Dg8lHr5mIg30qcVdN7Je' );
define( 'CS_BASE_URL' 'https://api.churchsuite.co.uk/v1' )

define( 'CS_EVENTS_URL', CS_BASE_URL . '/calendar/events?per_page=200' );
define( 'CS_GROUPS_URL', CS_BASE_URL . '/smallgroups/groups?view=active_future' );

// GROUPS IMPORT
$ch = curl_init( CS_GROUPS_URL );
curl_setopt_array( $ch,
  array(
    CURLOPT_TIMEOUT => 0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPHEADER => array(
      'X-Account: ' . CS_APP_ACCOUNT,
      'X-Application: ' . CS_APP_APPLICATION,
      'X-Auth: ' . CS_APP_AUTH
    )
  )
);

$result = curl_exec($ch);

curl_close($ch);

$json = json_decode($result);
$groups = $json->groups;
$email = "Request URL: " . CS_GROUPS_URL . "<br/><br/>";

foreach( $groups as $group ) {
  if ( $group->public_visible == "1" && $group->signup_enabled == "1" && $group->signup_link_visible == true ) {
    //Check against currently added groups
    $wp_group = new WP_Query(
      array(
        'post_count'  => -1,
        'post_type'   => 'connect',
        'meta_key'    => 'identifier',
        'meta_value'  => $group->identifier
      )
    );

    if ( $wp_group->post_count == 0 ) {
      $post_id = wp_insert_post(
        array(
          'post_type' => 'event',
          'post_title' => $group->name,
          'post_content' => $group->description,
          'post_status' => 'publish',
          'post_author' => 2,
          'post_date' => strtotime($group->signup_date_start),
          'comment_status' => 'closed',
          'ping_status' => 'closed',
        )
      );

      // If it's successfully added to the DB
      if ( $post_id ) {
        $email .= "Successfully added " . $group->name . " <a href='" . get_edit_post_link( $post_id ) . "'>(ID: " . $post_id . ")</a> to WP<br/>";

        // Add expiry date
        _scheduleExpiratorEvent( $post_id, strtotime( $group->signup_date_end ), array( 'expireType' => 'draft', 'id' => $post_id ) );

        // Update ACF fields
        update_field( 'field_59b642a9ed98e', $group->identifier, $post_id );
        update_field( 'field_59b642d0ed98f', $group->date_start, $post_id );
        update_field( 'field_59b642dbed990', $group->date_end, $post_id );
        update_field( 'field_59b64450ed999', $group->frequency, $post_id );
        update_field( 'field_59b642f0ed991', $group->day, $post_id );
        update_field( 'field_59b6432ced992', $group->time, $post_id );

        if ( count( $group->location ) != 0 ) {
          update_field( 'field_59b64389ed994', $group->location->name, $post_id );
          update_field( 'field_59b64390ed995', $group->location->address, $post_id );
          update_field( 'field_59b6439aed996', $group->location->latitude, $post_id );
          update_field( 'field_59b643a0ed997', $group->location->longitude, $post_id );
        }

        update_field( 'field_59b64354ed993', $group->signup_full, $post_id );

        if ( $group->signup_link_visible == true ) {
          update_field( 'field_59b643a9ed998', 'https://valley.churchsuite.co.uk/groups/' . $group->identifier, $post_id );
        }

        // Try and get the image
        if ( count( $group->images ) > 0 ) {
          $file = $group->images->lg->url;
          add_media_to_wp($group, $file, $post_id);
        }
      }

      // Fail, do something with the error?
      else {
        $email .= "Couldn't add " . $group->name . " to WP<br/>";
      }
    }

    // Run an update?
    else {
      $post_to_update = $wp_group->posts[0];
      $post_id = $post_to_update->ID;
      $update_count = 1;

      //Basic object to add data to
      $updated_info = array(
        'ID' => $post_id
      );

      if ( esc_html($post_to_update->post_title) != esc_html( $group->name ) ) {
        $updated_info["post_title"] = $group->name;
        $update_count++;
      }

      if ( $post_to_update->post_content != $group->description ) {
        $updated_info["post_content"] = $group->description;
        $update_count++;
      }

      if ( get_field( 'identifier', $post_to_update) != $group->identifier ) {
        $updated_info["identifier"] = $group->identifier;
        $update_count++;
      }

      if ( get_field( 'date_start', $post_to_update) != $group->date_start ) {
        $updated_info["date_start"] = $group->date_start;
        $update_count++;
      }

      if ( get_field( 'date_end', $post_to_update) != $group->date_end ) {
        $updated_info["date_end"] = $group->date_end;
        $update_count++;
      }

      if ( get_field( 'frequency', $post_to_update) != $group->frequency ) {
        $updated_info["frequency"] = $group->frequency;
        $update_count++;
      }

      if ( get_field( 'day', $post_to_update) != $group->day ) {
        $updated_info["day"] = $group->day;
        $update_count++;
      }

      if ( get_field( 'time', $post_to_update) != $group->time ) {
        $updated_info["time"] = $group->time;
        $update_count++;
      }

      if ( count( $group->location ) != 0 ) {
        if ( get_field( 'location', $post_to_update) != $group->location->name ) {
          $updated_info["location"] = $group->location->name;
          $update_count++;
        }

        if ( get_field( 'location_address', $post_to_update) != $group->location->address ) {
          $updated_info["location_address"] = $group->location->address;
          $update_count++;
        }

        if ( get_field( 'location_latitude', $post_to_update) != $group->location->latitude ) {
          $updated_info["location_latitude"] = $group->location->latitude;
          $update_count++;
        }

        if ( get_field( 'location_longitude', $post_to_update) != $group->location->longitude ) {
          $updated_info["location_longitude"] = $group->location->longitude;
          $update_count++;
        }
      }

      if ( get_field( 'signup_full', $post_to_update) != $group->signup_full ) {
        $updated_info["signup_full"] = $group->signup_full;
        $update_count++;
      }

      if ( get_field( 'signup_url', $post_to_update) != $group->signup_link_visible ) {
        $updated_info["signup_url"] = 'https://valley.churchsuite.co.uk/groups/' . $group->identifier;
        $update_count++;
      }

      // Update post if there's more data than just ID
      if ( $update_count > 1 ) {
        wp_update_post( $updated_info );
        $email .= "Updated " . $group->name . " (ID: " . $post_id . ")<br/>";
      }

      else {
        $email .= "No need to update " . $group->name . " <a href='" . get_edit_post_link( $post_id ) . "'>(ID: " . $post_id . ")</a><br/>";
      }

      // See if there's a featured image to add
        if ( count( $group->images ) > 0 ) {
          // Clear previous images
          $media = get_attached_media( 'image', $post_id );
          if ( count( $media ) > 0 ) {
            foreach( $media as $image ) {
              wp_delete_attachment( $image->ID, true );
            }
          }

          // Add new image
          $file = $group->images->lg->url;
          add_media_to_wp($group, $file, $post_id);
        }
    }
  }
}

if ( !empty( $email ) ) {
  echo $email;
  wp_mail( 'web@valleychurch.eu', 'ChurchSuite groups import ' . date( 'd/m/Y' ), $email, array( 'Content-Type: text/html; charset=UTF-8' ) );
}
?>