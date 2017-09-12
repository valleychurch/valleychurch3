<article <?= post_class() ?>>
  <a class="o-card o-card--shadow" href="<?= get_permalink(); ?>">
    <?php set_query_var( 'class', 'o-card__img' ); ?>
    <?php get_template_part( 'partials/hero', 'slide' ); ?>
    <div class="o-card__body">
      <h2 class="h3 o-card__title <?= ( get_field( 'service_times' ) ) ? "u-margin-half" : "u-margin-none"; ?>"><?php the_title(); ?></h2>
      <?php if ( get_field( 'service_times' ) ) { ?>
      <h3 class="h4 o-card__subtitle u-text-black"><?php the_field( 'service_times' ); ?></h3>
      <?php } ?>
      <div class="o-card__text">
      <?php if ( get_field( 'address' ) ) {
        echo get_field( 'address' );
      } ?>
      </div>
    </div>
  </a>
</article>
