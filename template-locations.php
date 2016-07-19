<?php
/**
 * Template Name: Locations
 */
get_header();
?>

  <div class="c-map c-map--40">
    <div class="c-map__inner js-google-map"></div>
  </div>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row u-text-center">

        <div class="o-col-xxs-12">
          <h1 class="kilo u-margin--half <?= ( get_field( 'hide_h1' ) == 1 ) ? "u-hidden" : ""; ?>"><?php the_title(); ?></h1>
        </div>

        <div class="o-col-xxs-12 o-col-sm-8 o-col-md-7 u-center-block">
          <p class="lead u-margin u-margin--md--double">
            <?= get_the_content(); ?>
          </p>
        </div>

      </div>

    </article>

  </section>

  <?php
  wp_reset_query();
  $args =
    array(
      'post_type' => 'location',
      'post_status' => array( 'publish', 'private' ),
      'posts_per_page' => -1,
    );

  $locations = new WP_Query( $args );
  if ( $locations->have_posts() ) : ?>
  <section class="c-section u-background-grey--11">

    <div class="o-container">

      <div class="o-row o-row--center">

      <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>

      <div class="o-col-xxs-12 o-col-md-4">
        <?php get_template_part( 'partials/card', 'location' ); ?>
      </div>

      <?php endwhile; ?>
      </div>

    </div>

  </section>

  <?php else : endif; ?>

<?php
add_action( 'wp_footer', 'load_locations', 50 );
get_footer();
?>
