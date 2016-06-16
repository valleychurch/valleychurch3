<?php get_header(); ?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'class', 'c-featured' );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="c-post-content u-center-block u-text-center">

        <h1><?php the_title(); ?></h1>
        <a class="o-btn o-btn--ghost o-btn--xsmall js-set-location" href="#" data-location-id="<?= $post->ID ?>" data-location-name="<?= get_the_title(); ?>">
          Set as my main location
        </a>

        <?php the_content(); ?>

      </div>

    </article>

  </section>

  <div class="c-map c-map--40">
  <?php if ( get_field( 'google_maps_link' ) ) { ?>
    <a class="o-btn c-map__btn" title="Get directions" href="<?= get_field( 'google_maps_link' ); ?>" role="button">
      Get directions
    </a>
  <?php } ?>
    <div class="c-map__inner js-google-map"></div>
  </div>

<?php
add_action( 'wp_footer', 'load_location', 50 );
get_footer();
?>
