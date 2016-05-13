<?php
/**
 * Template Name: Locations
 */
get_header();
?>

  <div class="c-banner c-banner--clear u-margin u-margin--sm--double">

    <div class="c-map c-map--40">
      <div class="c-map__inner js-google-map"></div>
    </div>

  </div>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

        <div class="c-post-content u-center-block">

          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>

          <?php the_content(); ?>

        </div>

    </article>

  </section>

  <?php
  wp_reset_query();
  $args =
    array(
      'post_type' => 'location',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    );

  $locations = new WP_Query( $args );
  if ( $locations->have_posts() ) : ?>

  <section class="o-container c-section c-section--grey">

    <div class="o-row">
    <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>

      <div class="o-col-xxs-12 o-col-md-4">
        <?php get_template_part( 'partials/card', 'location' ); ?>
      </div>

    <?php endwhile; ?>

    </div>

  <?php else : endif; ?>

  </section>

<?php
add_action( 'wp_footer', 'load_locations', 50 );
get_footer();
?>
