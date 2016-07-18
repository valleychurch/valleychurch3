<?php get_header(); ?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'class', 'c-featured' );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class="o-container c-section u-background-grey--11">

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

  <section class="o-container c-section">

    <article class="o-row c-article u-margin">

      <div class="o-col-xxs-12 o-col-md-4 u-grid-1--md">

        <?php if ( get_field( 'address' ) ) { ?>
          <h3>Address</h3>
          <p><?= get_field( 'address' ); ?></p>
        <?php } ?>

        <?php if ( get_field( 'service_times' ) ) { ?>
          <h3>Service times</h3>
          <p><?= get_field( 'service_times' ); ?></p>
        <?php } ?>

        <?php if ( get_field( 'phone_number' ) || get_field( 'email_address' ) ) { ?>
          <h3>Contact</h3>
          <?php if ( get_field( 'phone_number' ) ) { ?>
            <p><strong>Phone:</strong> <?= get_field( 'phone_number' ); ?>
          <?php } ?>
          <?php if ( get_field( 'email_address' ) ) { ?>
            <p><strong>Phone:</strong> <?= get_field( 'email_address' ); ?>
          <?php } ?>
        <?php } ?>

      </div>

      <div class="o-col-xxs-12 o-col-md-8 u-grid-0--md">

        <h2>Where do I go when I get there?</h2>
        <?php
        echo get_field( 'location_get_there', 'location' );
        if ( get_field( 'get_there' ) ) {
          echo get_field( 'get_there' );
        }
        ?>

        <h2>What do you do for kids and youth?</h2>
        <?php
        echo get_field( 'location_kids_youth', 'location' );
        if ( get_field( 'kids_youth' ) ) {
          echo get_field( 'kids_youth' );
        }
        ?>

        <h2>What happens during the service?</h2>
        <?php
        echo get_field( 'location_service', 'location' );
        if ( get_field( 'service' ) ) {
          echo get_field( 'service' );
        }
        ?>

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
  $args = array(
    'post_type' => 'post',
    'post_status' => array( 'publish', 'private' ),
    'posts_per_page' => 3,
    'tax_query' => array(
      array(
        'taxonomy' => 'location',
        'field' => 'slug',
        'terms' => $post->slug
      )
    )
  );
  $posts = new WP_Query( $args );
  if ( $posts->have_posts() ) : ?>
  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="c-post-content u-center-block u-text-center">

        <h4 class="h2">Recent Blogs</h4>
      </div>

    </article>

    <div class="o-row">
  <?php
    while ( $posts->have_posts() ) :
      $posts->the_post();
  ?>
      <div class="o-col-xxs-12 o-col-sm-4">
        <?php get_template_part( 'partials/card', 'blog' ); ?>
      </div>
  <?php endwhile; ?>
    </div>

  </section>
  <?php else: endif;
  wp_reset_query(); ?>

<?php
add_action( 'wp_footer', 'load_location', 50 );
get_footer();
?>
