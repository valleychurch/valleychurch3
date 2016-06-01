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

      <div class="o-row u-text-center">
        <div class="o-col-xxs-12">
          <h1 class="kilo u-margin--half <?= ( get_field( 'hide_h1' ) == 1 ) ? "u-hidden" : ""; ?>"><?php the_title(); ?></h1>
        </div>
        <div class="o-col-xxs-12 o-col-sm-8 o-col-md-7 u-center-block">
          <?= get_the_content(); ?>
        </div>
      </div>

    </article>

  </section>

<?php
  $args =
    array(
      'post_type' => 'events',
      'post_status' => 'publish',
      'posts_per_page' => 12
    );

  $wp_query = new WP_Query( $args );
  if ( have_posts() ) : ?>
  <section class="c-section u-background-grey--11">

    <div class="o-container">

      <div class="o-row">

        <?php while ( have_posts() ) : the_post(); ?>

        <div class="o-col-xxs-12 o-col-md-4">
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
