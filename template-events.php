<?php
/*
  Template Name: Events
*/
get_header(); ?>

  <?php
  set_query_var( 'class', 'c-featured' );
  get_template_part( 'partials/hero', 'banner' );
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>

          <?php the_content(); ?>

        </div>

      </div>

    </article>

  </section>

  <section class="c-section u-background-grey--10">

    <div class="o-container">

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

    </div>

  </section>

<?php get_footer(); ?>
