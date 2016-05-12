<a class="o-card o-card--shadow" href="<?= get_permalink(); ?>">
  <?php set_query_var( 'class', 'o-card__img' ); ?>
  <?php get_template_part( 'partials/featured-image', 'slide' ); ?>
  <div class="o-card__body u-text-center">
    <h2 class="o-card__title <?= ( $times ) ? "u-margin--half" : ""; ?>"><?php the_title(); ?></h2>
    <?php if ( get_field( 'service_times' ) ) { ?>
    <h3 class="h4 o-card__subtitle"><?php the_field( 'service_times' ); ?></h3>
    <?php } ?>
    <div class="o-card__text">
    <?php if ( get_field( 'address' ) ) {
      echo get_field( 'address' );
    } ?>
    </div>
  </div>
</a>
