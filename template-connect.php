<?php
/*
  Template Name: Connect Groups
*/
get_header();

if (have_posts()) :
  while (have_posts()) :
    the_post(); ?>

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

  <div class="c-map c-map--40">
    <div class="c-map__inner js-google-map"></div>
  </div>

<?php
endwhile; else : endif; wp_reset_query();
add_action( 'wp_footer', 'load_connect_groups', 50 );
get_footer();
?>
