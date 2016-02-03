<div class="o-card o-card--shadow">
  <?php get_template_part( 'partials/featured-image-slide' ); ?>
  <div class="o-card__body">
    <h2 class="o-card__title <?php ( get_field( 'event_date' ) ) ? print 'u-margin--none' : '' ?>">
      <!-- <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"> -->
        <?php the_title(); ?>
      <!-- </a> -->
    </h2>
    <div class="o-card__text">
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
        <?php
        $map_link = get_field( 'event_map_link' );
        if ( $map_link ) { ?>
          <a href="<?php the_field( 'event_map_link' ); ?>" target="_blank">
        <?php }
        the_field( 'event_venue' );
        if ( $map_link ) { ?>
          </a>
        <?php } ?>
      </p>
      <?php
      }
      the_content(); ?>
    </div>
  </div>
</div>