<?php
/*
  Template Name: Meet the Team
*/
get_header(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="o-col-xs-12 c-post-content u-center-block">

        <h1><?php the_title(); ?></h1>

        <?php the_content(); ?>

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
      <div class="o-col-xs-12 o-col-md-10 u-center-block">
        <div class="o-row u-margin">
        <?php if ( has_post_thumbnail() ) { ?>
          <div class="o-col-xs-12 o-col-md-5">
            <?php
            set_query_var( 'margin', true );
            get_template_part( 'partials/featured-image' );
            ?>
          </div>
          <div class="o-col-xs-12 o-col-md-7">
        <?php } else { ?>
          <div class="o-col-xs-12">
        <?php }
          if ( get_field( 'job_title' ) ) { ?>
            <h2 class="u-margin--none"><?php the_title(); ?></h2>
            <h3><?php the_field( 'job_title' ); ?></h3>
          <?php } else { ?>
            <h2><?php the_title(); ?></h2>
          <?php }
          the_content(); ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
    </div>
    <?php else: endif; ?>
  </section>

<?php get_footer(); ?>