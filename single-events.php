<?php get_header(); ?>

  <?php
  set_query_var( 'figure', true );
  get_template_part( 'partials/hero', 'banner' );
  ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="c-post-content u-center-block">

        <h1 class="<?= ( get_field( 'hide_h1' ) == 1 ) ? 'u-hidden' : '' ?> <?= ( get_field( 'event_date' ) ) ? 'u-margin--half' : 'u-margin--none' ?>"><?php the_title(); ?></h1>

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

    </article>

  </section>

<?php get_footer(); ?>
