<?php get_header(); ?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'figure', true );
    get_template_part( 'partials/hero', 'banner' );
  }
  ?>

  <section class="c-section u-background-grey--11">

    <article <?php post_class( 'o-container c-article u-margin' ); ?>>

      <div class="o-row">

        <div class="c-post-content u-center-block u-text-center">

          <?php if ( get_field( 'custom_h1' ) ) { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?= get_field( 'custom_h1' ); ?></h1>
          <?php } else { ?>
          <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>
          <?php } ?>
          <a class="o-btn o-btn--ghost o-btn--xsmall js-set-location" href="#" data-location-id="<?= $post->ID ?>" data-location-name="<?= get_the_title(); ?>">
            Set as my main location
          </a>

        </div>

      </div>

    </article>

  </section>

  <section class="c-section">

    <article class="o-container c-article u-margin">

      <div class="o-row">

        <div class="o-col-12@xxs o-col-8@md">

          <div class="c-post-content u-center-block">

            <?php the_content(); ?>

            <h2>Plan your visit</h2>

            <p>If you're visiting Valley for the first time, we're excited to have you with us! If you would like, you can send us your details below and one of our team will greet you on the day and show you around.</p>

            <input type="hidden" id="locationid" name="locationid" value="<?= the_ID() ?>">
            <?= do_shortcode( '[contact-form-7 id="11252" title="Plan a Visit"]' ) ?>

          </div>

        </div>

        <aside class="o-col-12@xxs o-col-4@md">

          <hr class="u-hide@md" />

          <?php if ( get_field( 'address' ) ) { ?>
            <h3 class="u-margin-half">Address</h3>
            <address itemscope itemprop="address" itemtype="http://schema.org/PostalAddress">
              <p class="lead">
                <?= get_field( 'address' ); ?>
              </p>
            </address>
            <?php if ( get_field( 'google_maps_link' ) ) { ?>
              <p>
                <a class="o-btn" title="Get directions" href="http://<?= get_field( 'google_maps_link' ); ?>" role="button">
                  Get directions
                </a>
              </p>
            <?php } ?>
          <?php } ?>

          <?php if ( get_field( 'service_times' ) ) { ?>
            <h3 class="u-margin-half">Service times</h3>
            <p><?= get_field( 'service_times' ); ?></p>
          <?php } ?>

          <?php if ( get_field( 'phone_number' ) || get_field( 'email_address' ) ) { ?>
            <h3 class="u-margin-half">Contact</h3>
            <?php if ( get_field( 'phone_number' ) ) { ?>
              <p<?= get_field( 'email_address' ) ? " class='u-margin-half'" : "" ?>><strong>Phone:</strong> <a href="tel:<?= get_field( 'phone_number' ); ?>"><?= get_field( 'phone_number' ); ?></a></p>
            <?php } ?>
            <?php if ( get_field( 'email_address' ) ) { ?>
              <p><strong>Email:</strong> <a href="mailto:<?= get_field( 'email_address' ); ?>"><?= get_field( 'email_address' ); ?></a></p>
            <?php } ?>
          <?php } ?>

          <?php if ( get_field( 'social_twitter' ) || get_field( 'social_facebook' ) || get_field( 'social_instagram' ) ) { ?>
            <h3 class="u-margin-half">Follow us on social media</h3>
            <?php if ( get_field( 'social_twitter' ) ) { ?>
            <a href="https://twitter.com/<?= get_field( 'social_twitter' ); ?>" class="o-btn o-btn--small u-background-twitter" role="button">
              <i class="fa fa-twitter fa-fw u-text-white"></i> Twitter
            </a>
            <?php } ?>
            <?php if ( get_field( 'social_facebook' ) ) { ?>
            <a href="https://facebook.com/<?= get_field( 'social_facebook' ); ?>" class="o-btn o-btn--small u-background-facebook" role="button">
              <i class="fa fa-facebook-official fa-fw u-text-white"></i> Facebook
            </a>
            <?php } ?>
            <?php if ( get_field( 'social_instagram' ) ) { ?>
            <a href="http://instagram.com/<?= get_field( 'social_instagram' ); ?>" class="o-btn o-btn--small u-background-instagram" role="button">
              <i class="fa fa-instagram fa-fw u-text-white"></i> Instagram
            </a>
            <?php } ?>
          <?php } ?>

        </aside>

      </div>

    </article>

  </section>

  <?php if ( get_field( 'location' ) ) { ?>
  <div class="c-map c-map--40">
  <?php if ( get_field( 'google_maps_link' ) ) { ?>
    <a class="o-btn c-map__btn" title="Get directions" href="http://<?= get_field( 'google_maps_link' ); ?>" role="button">
      Get directions
    </a>
  <?php } ?>
    <div class="c-map__inner js-google-map"></div>
  </div>
  <?php } ?>

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
  <section class="c-section">

    <div class="o-container">

      <div class="o-row u-margin">

        <div class="c-post-content u-center-block u-text-center">

          <h4 class="h2">Recent Blogs</h4>

        </div>

      </div>

      <div class="o-row">
    <?php
      while ( $posts->have_posts() ) :
        $posts->the_post();
    ?>
        <div class="o-col-12@xxs o-col-4@sm">
          <?php get_template_part( 'partials/card', 'blog' ); ?>
        </div>
    <?php endwhile; ?>
      </div>

    </div>

  </section>
  <?php else: endif;
  wp_reset_query(); ?>

  <?php
  $args = array(
    'post_type' => 'events',
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
  <section class="c-section">

    <div class="o-container">

      <div class="o-row u-margin">

        <div class="c-post-content u-center-block u-text-center">

          <h4 class="h2">Upcoming Events</h4>

        </div>

      </div>

      <div class="o-row">
    <?php
      while ( $posts->have_posts() ) :
        $posts->the_post();
    ?>
        <div class="o-col-12@xxs o-col-4@sm">
          <?php get_template_part( 'partials/card', 'blog' ); ?>
        </div>
    <?php endwhile; ?>
      </div>

    </div>

  </section>
  <?php else: endif;
  wp_reset_query(); ?>

<?php
if ( get_field( 'location' ) ) {
  add_action( 'wp_footer', 'load_location', 50 );
}
get_footer();
?>
