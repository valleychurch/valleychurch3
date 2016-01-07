<?php
  $args =
    array(
      'post_type' => 'notification',
      'showposts' => 1,
      'post_status' => 'publish'
    );

  $notification = new WP_Query( $args );

  if ( $notification->have_posts() ) :
    while ( $notification->have_posts() ) :
      $notification->the_post();
?>

<div class="c-notification" id="notification-<?php the_date('dmY'); ?>" aria-expanded="false">
  <div class="o-container">
    <?php the_content(); ?>
    <button aria-label="Dismiss notification" class="o-btn o-btn--reset c-notification__dismiss js-notification-dismiss">
      &times;
    </button>
  </div>
</div>

<?php
    endwhile;
  endif;
  wp_reset_query();
?>