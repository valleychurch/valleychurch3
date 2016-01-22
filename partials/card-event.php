<div class="o-card o-card--shadow">
  <?php if ( has_post_thumbnail() ) { ?>
  <div class="o-card__image"><?php the_post_thumbnail(); ?></div>
  <?php } ?>
  <div class="o-card__body">
    <h2 class="o-card__title">
      <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
      </a>
    </h2>
    <?php if ( get_field( 'event_date' ) ) { ?>
    <p class="o-card__text lead">
      <?php if ( get_field( 'event_time' ) ) {
        echo get_field( 'event_date' ) . ', ' . get_field( 'event_time' );
      } else {
        the_field( 'event_date' );
      } ?>
    </p>
    <?php
    }
    if ( get_field( 'event_venue' ) ) { ?>
    <p class="o-card__text">
      Held at:
      <?php if ( get_field( 'event_map_link' ) ) { ?>
        <a href="<?php the_field( 'event_map_link' ); ?>" target="_blank">
          <?php the_field( 'event_venue' ); ?>
        </a>
      <?php } else {
        the_field( 'event_venue' );
      } ?>
    </p>
  <?php } ?>
  </div>

</div>