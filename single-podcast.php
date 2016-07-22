<?php get_header(); ?>

  <?php
  $message_id = $post->ID;
  $messages_page = get_page_by_path( '/messages' );
  if ( has_post_thumbnail( $messages_page->ID ) ) {
    set_query_var( 'class', 'c-featured' );
    set_query_var( 'page_id', $messages_page->ID );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row">

        <div class="o-col-xxs-8 o-col-md-4 o-col-lg-3 u-center-block--xxs">

          <?php
          set_query_var( 'page_id', $message_id );
          set_query_var( 'margin', true );
          get_template_part( 'partials/hero' );
          ?>

        </div>

        <div class="o-col-xxs-12 o-col-md-8 o-col-lg-9">

          <?php if ( get_field( 'custom_h1' ) ) { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?= get_field( 'custom_h1' ); ?></h1>
          <?php } else { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>
          <?php } ?>
          <?php if ( get_the_terms( $post->ID, 'series' ) ) { ?>
          <h2><?= get_the_terms( $post->ID, 'series' )[0]->name; ?></h2>
          <?php } ?>

          <div class="o-flag u-margin--double">
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

          <?php the_content(); ?>

        </div>

      </div>

    </article>

  </section>

<?php get_footer(); ?>
