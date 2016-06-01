<a class="o-card o-card--shadow" href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>">
  <?php set_query_var( 'class', 'o-card__img' ); ?>
  <?php get_template_part( 'partials/hero', 'slide' ); ?>
  <div class="o-card__body u-text-center">
    <h2 class="h3 o-card__title <?= ( get_field( 'event_date' ) ) ? 'u-margin--half' : 'u-margin--none' ?>">
      <!-- <a href="<?= get_permalink(); ?>" title="<?php the_title(); ?>"> -->
        <?php the_title(); ?>
      <!-- </a> -->
    </h2>
    <?php if ( get_field( 'event_date' ) ) { ?>
    <h3 class="h4 o-card__subtitle u-margin--none u-text-black">
      <?php if ( get_field( 'event_time' ) ) {
        echo get_field( 'event_date' ) . ', ' . get_field( 'event_time' );
      } else {
        the_field( 'event_date' );
      } ?>
    </h3>
    <?php } ?>
  </div>
</a>
