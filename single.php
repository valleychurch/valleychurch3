<?php get_header(); ?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'figure', true );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class=" c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <?php if ( get_field( 'custom_h1' ) ) { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?= get_field( 'custom_h1' ); ?></h1>
          <?php } else { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>
          <?php } ?>

          <div class="o-flag u-margin--double">
            <div class="o-flag__fix">
              <?php get_template_part( 'partials/avatar' ); ?>
            </div>
            <div class="o-flag__flex">
              <p class="u-margin--none">
                <?php the_author(); ?>
              </p>
              <p class="small u-text-muted u-margin--none">
                <strong>
                  <time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time>
                </strong>
              </p>
            </div>
          </div>

          <?php the_content(); ?>

        </div>

      </div>

    </article>

  </section>

  <section class="c-section">

    <div class="o-container">

      <div class="o-row">

        <div class="c-post-content c-post-content--fixed u-center-block">

          <hr/>

          <?php comments_template(); ?>

        </div>

      </div>

    </div>

  </section>

<?php get_footer(); ?>
