<?php
/*
  Template Name: Events
*/
get_header(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="o-col-xxs-12 c-post-content u-center-block">

        <h1 <?php ( get_field( 'hide_h1' ) == 1 ) ? print 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>

        <?php the_content(); ?>

      </div>

    </article>

  </section>

  <section class="o-container c-section c-section--grey">

    <div class="o-row">
      <div class="c-post-content--wide u-center-block">
      <?php
        $args =
          array(
            'post_type' => 'events',
            'post_status' => 'publish',
            'posts_per_page' => -1
          );

        $wp_query = new WP_Query( $args );
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="o-col-xxs-12">
          <?php get_template_part( 'partials/card', 'event' ); ?>
        </div>
      <?php
      endwhile;
      get_template_part( 'partials/pagination' );
      else :
        get_template_part( 'no-content-found' );
      endif;
      ?>
      </div>
    </div>
  </section>

<?php get_footer(); ?>