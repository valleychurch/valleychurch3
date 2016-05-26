<?php
/*
  Template Name: Meet the Team
*/
get_header(); ?>

  <?php
  set_query_var( 'class', 'c-featured' );
  get_template_part( 'partials/hero', 'banner' );
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin--double' ); ?>>

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>

          <?php the_content(); ?>

        </div>

      </div>

    </article>

    <?php
    wp_reset_query();
    $args =
      array(
        'post_type' => 'staff',
        'post_status' => 'publish',
        'posts_per_page' => -1
      );

    $wp_query = new WP_Query( $args );
    if ( have_posts() ) : ?>
    <div class="o-row">
    <?php while( have_posts() ) : the_post(); ?>
      <div class="o-col-xxs-12 o-col-lg-10 u-center-block">
        <div class="o-row u-margin--double">
        <?php if ( has_post_thumbnail() ) { ?>
          <div class="o-col-xxs-12 o-col-sm-4 o-col-md-5">
            <?php
            set_query_var( 'margin', true );
            get_template_part( 'partials/hero' );
            ?>
          </div>
          <div class="o-col-xxs-12 o-col-sm-8 o-col-md-7">
        <?php } else { ?>
          <div class="o-col-xxs-12">
        <?php }
          if ( get_field( 'job_title' ) ) { ?>
            <h2 class="u-margin--none"><?php the_title(); ?></h2>
            <h3><?php the_field( 'job_title' ); ?></h3>
          <?php } else { ?>
            <h2><?php the_title(); ?></h2>
          <?php }
          the_content();
          if ( have_rows( 'twitter' ) ) {
            while ( have_rows( 'twitter' ) ) {
              the_row(); ?>
          <p class="u-margin--half">
            <a href="http://twitter.com/<?= get_sub_field( 'twitter_handle' ); ?>" target="_blank">
              <i class="fa fa-lg fa-fw fa-twitter"></i> Follow <?php the_sub_field( 'twitter_name' ); ?> on Twitter
            </a>
          </p>
          <?php }
          }
          ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
    </div>
    <?php else: endif; ?>
  </section>

<?php get_footer(); ?>
