<a class="o-card o-card--shadow" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
  <?php get_template_part( 'partials/featured-image-simple' ); ?>
  <div class="o-card__body">
    <div class="o-card__title">
      <h3 class="h5 <?php ( get_the_terms( $post->ID, 'series' ) ) ? print "u-margin--half" : ""; ?>">
        <?php echo get_the_title(); ?>
      </h3>
      <?php if ( get_the_terms( $post->ID, 'series' ) ) { ?>
      <h4 class="h6">
        <?php echo get_the_terms( $post->ID, 'series' )[0]->name; ?>
      </h4>
      <?php } ?>
    </div>
    <div class="o-card__text">
      <?php // if ( get_the_author_id() != 2 ) { ?>
      <div class="o-flag u-margin">
        <div class="o-flag__fix">
          <?php get_template_part( 'partials/avatar' ); ?>
        </div>
        <div class="o-flag__flex">
          <p class="u-margin--none">
            <?php if ( get_field( 'podcast_author' ) ) {
              the_field( 'podcast_author' );
            } else {
              the_author();
            } ?>
          </p>
        </div>
      </div>
      <?php // } ?>
      <p class="u-margin--none small">
        <?php echo get_the_content(); ?>
      </p>
    </div>
  </div>
</a>