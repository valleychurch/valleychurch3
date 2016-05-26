<a class="o-card o-card--shadow" href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>">
  <?php set_query_var( 'class', 'o-card__img' ); ?>
  <?php get_template_part( 'partials/hero' ); ?>
  <div class="o-card__body">
    <div class="o-card__title">
      <h3 class="h5 <?= ( get_the_terms( $post->ID, 'series' ) ) ? "u-margin--half" : ""; ?>">
        <?= get_the_title(); ?>
      </h3>
      <?php if ( get_the_terms( $post->ID, 'series' ) ) { ?>
      <h4 class="h6">
        <?= get_the_terms( $post->ID, 'series' )[0]->name; ?>
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
          <p class="u-margin--none u-line-height--small">
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
        <?= get_the_content(); ?>
      </p>
    </div>
  </div>
</a>
