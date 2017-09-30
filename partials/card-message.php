<article <?= post_class() ?>>
  <a class="o-card o-card--shadow" href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>">
    <?php
    set_query_var( 'class', 'o-card__img' );
    set_query_var( 'figure', true );
    get_template_part( 'partials/hero-blog' ); ?>
    <div class="o-card__body">
      <p class="small u-text-muted u-margin-quarter">
        <?= get_the_content(); ?>
      </p>
      <div class="o-card__title">
        <h3 class="h4 <?= ( get_the_terms( $post->ID, 'series' ) ) ? "u-margin-half" : ""; ?>">
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
        <div class="o-flag">
          <div class="o-flag__fix">
            <?php
              set_query_var( 'size', 'sm' );
              get_template_part( 'partials/avatar' );
            ?>
          </div>
          <div class="o-flag__flex">
            <p class="u-margin-none small u-line-height--small">
              <?php if ( get_field( 'podcast_author' ) ) {
                the_field( 'podcast_author' );
              } else {
                the_author();
              } ?>
            </p>
          </div>
        </div>
        <?php // } ?>
      </div>
    </div>
  </a>
</article>
