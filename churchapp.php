<?php

error_reporting(1);

define('APP_ACCOUNT', 'valley');
define('APP_APPLICATION', 'valleychurch-website');
define('APP_AUTH', 'Dg8lHr5mIg30qcVdN7Je');
define('APP_URL', 'https://api.churchapp.co.uk/v1/calendar/events');

require_once('../../../wp-load.php');
require_once('../../../wp-admin/includes/image.php');

$ch = curl_init(APP_URL);
curl_setopt_array($ch,
  array(
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

$event_categories = [
  8,  // Events
  9,  // Connect
  10, // Creative
  13, // Pastoral
  14, // Sisterhood
  15, // Valley Men
];


foreach( $events as $event ) {
  if ( $event->public_visible == 1 ) {
    //Check against currently added events
    $wp_event = new WP_Query(
      array(
        'post_count'  => -1,
        'post_type'   => 'event',
        'meta_key'    => 'identifier',
        'meta_value'  => $event->identifier
      )
    );

    // Check if the category should be added to the website
    if ( in_array( $event->category->id, $event_categories ) ) {
      // If it's not found in the DB we can add it
      if ( $wp_event->post_count == 0 ) {
        $post_id = wp_insert_post(
          array(
            'post_type' => 'event',
            'post_title' => $event->name,
            'post_content' => $event->description,
            'post_status' => 'publish', //TODO: Change to public once it works
            'post_author' => 2,
            'comment_status' => 'closed',
            'ping_status' => 'closed',
          )
        );

        // If it's successfully added to the DB
        if ( $post_id ) {
          echo "Successfully added " . $event->name . " <a href='" . get_edit_post_link( $post_id ) . "'>(ID: " . $post_id . ")</a> to WP<br/>";

          // Add expiry date
          _scheduleExpiratorEvent( $post_id, strtotime( $event->datetime_end ) );

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
            addMediaToWp($event, $file, $post_id);
          }
        }

        // Fail, do something with the error?
        else {
          echo "Couldn't add " . $event->name . " to WP<br/>";
        }
      }

      // Run an update?
      else {
        $post_to_update = $wp_event->posts[0];
        $post_id = $post_to_update->ID;

        //Basic object to add data to
        $updated_info = array(
          'ID' => $post_id
        );

        //If title has changed
        if ( $post_to_update->post_title != $event->name ) {
          $updated_info["post_title"] = $event->name;
        }

        if ( $post_to_update->post_content != $event->description ) {
          $updated_info["post_content"] = $event->description;
        }

        //Update post if there's more data than just ID
        if ( count( $updated_info ) > 1 ) {
          wp_update_post( $updated_info );
          echo "Updated " . $event->name . " (ID: " . $post_id . ")<br/>";
        }

        // See if there's a featured image to add
        if ( count( $event->images ) > 0 && !has_post_thumbnail( $post_id ) ) {
          $file = $event->images->original_1000;
          addMediaToWp($event, $file, $post_id);
        }

        else {
          echo "No need to update " . $event->name . " <a href='" . get_edit_post_link( $post_id ) . "'>(ID: " . $post_id . ")</a><br/>";
        }
      }
    }
  }
}

function addMediaToWp($event, $file, $post_id) {
  $filename = basename( $file );

  $upload_file = wp_upload_bits( $filename, null, file_get_contents( $file ) );
  if ( !$upload_file['error'] ) {
    $wp_filetype = wp_check_filetype( $filename, null );
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_parent' => $post_id,
      'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
      'post_content' => '',
      'post_status' => 'inherit'
    );
    $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $post_id );
    if ( !is_wp_error( $attachment_id ) ) {
      $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
      wp_update_attachment_metadata( $attachment_id,  $attachment_data );
      set_post_thumbnail( $post_id, $attachment_id );
      echo '&nbsp;&nbsp;' . 'Successfully added post thumbnail (ID: ' . $attachment_id . ') to ' . $event->name . '<br/>';
    }
  }
}

?>
