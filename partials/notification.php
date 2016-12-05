<?php
  $args =
    array(
      'post_type' => 'notification',
      'post_status' => array( 'publish', 'private' ),
      'showposts' => 1,
    );

  $notification = new WP_Query( $args );

  if ( $notification->have_posts() ) :
    while ( $notification->have_posts() ) :
      $notification->the_post();
?>

<div class="c-notification c-notification--fixed" data-notification-id="<?= the_ID(); ?>" aria-expanded="false">
  <div class="o-container o-container--full">
    <div class="o-flag o-flag--rev">
      <div class="o-flag__flex">
        <?php the_content(); ?>
      </div>
      <div class="o-flag__fix">
        <button aria-label="Dismiss notification" class="o-btn o-btn--reset c-notification__dismiss js-notification-dismiss" onclick="__gaTracker('send', 'event', 'dismiss-notification', '<?= the_ID(); ?>');">
          &times;
          <!-- <i class="fa fa-times"></i> -->
        </button>
      </div>
    </div>
  </div>
</div>

<?php
    endwhile;
  endif;
  wp_reset_query();
?>
