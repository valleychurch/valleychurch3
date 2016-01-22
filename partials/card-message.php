<a class="o-card o-card--shadow" href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
  <?php get_template_part( 'partials/featured-image-simple' ); ?>
  <div class="o-card__body">
    <h3 class="h4 o-card__title u-margin--none">
      <!-- <a > -->
        <?php the_title(); ?>
      <!-- </a> -->
    </h3>
    <?php //the_content('Read more'); ?>
  </div>
</a>