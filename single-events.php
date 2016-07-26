<?php get_header(); ?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'figure', true );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?> itemscope itemtype="http://schema.org/Event">

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <?php if ( get_field( 'custom_h1' ) ) { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?> itemprop="name"><?= get_field( 'custom_h1' ); ?></h1>
          <?php } else { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?> itemprop="name"><?php the_title(); ?></h1>
          <?php } ?>

          <?php if ( get_field( 'event_date' ) ) { ?>
          <h2 class="h3">
            <?php if ( get_field( 'event_time' ) ) {
              echo get_field( 'event_date' ) . ', ' . get_field( 'event_time' );
            } else {
              the_field( 'event_date' );
            } ?>
          </h2>
          <?php } ?>

          <?php the_content(); ?>

          <?php get_template_part( 'partials/sharer' ); ?>

        </div>

      </div>

    </article>

  </section>

<?php get_footer(); ?>
