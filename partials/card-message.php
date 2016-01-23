<a class="o-card o-card--shadow" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
  <?php get_template_part( 'partials/featured-image-simple' ); ?>
  <div class="o-card__body">
    <h3 class="h5 o-card__title">
      <?php echo get_the_title(); ?>
    </h3>
    <p class="u-margin--none small">
      <?php echo get_the_content(); ?>
    </p>
  </div>
</a>