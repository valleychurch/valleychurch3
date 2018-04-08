<?php get_header(); ?>

  <?php
  if ( has_post_thumbnail() ) {
    set_query_var( 'figure', true );
    get_template_part( 'partials/hero', 'banner' );
  }

  $h1_class;

  if ( get_field( 'datetime_start' ) ) {
    $h1_class .= "u-margin-none ";
  }

  if ( get_field( 'hide_h1' ) ) {
    $h1_class .= "u-hidden ";
  }
  ?>

  <section class="c-section">

    <article <?php post_class( 'o-container c-article u-margin' ); ?> itemscope itemtype="http://schema.org/Event">

      <div class="o-row">

        <div class="c-post-content u-center-block">

          <?php if ( has_post_thumbnail() ) {
            $img_id = get_post_thumbnail_id( $post->ID );
            $img = wp_get_attachment_image_src( $img_id, 'slide' );
          ?>

          <img src="<?= $img[0] ?>" itemprop="image" class="u-hidden">
          <?php } ?>

          <h1 class="<?= $h1_class ?>" itemprop="name">
          <?php if ( get_field( 'custom_h1' ) ) {
            get_field( 'custom_h1' );
          } else {
            the_title();
          } ?>
          </h1>

          <?php if ( get_field( 'datetime_start' ) ) { ?>
          <h2 <?= ( get_field( 'datetimestamp_start' ) ? 'itemprop="startDate" content="' . date( 'c', get_field( 'datetimestamp_start' ) ) . '"' : "" ); ?>>
            <?php if ( get_field( 'all_day_event' ) == 1 ) {
              echo date('jS F', strtotime( get_field( 'datetime_start' ) ) );
            }
            else {
              echo date('jS F, g:ia', strtotime( get_field( 'datetime_start' ) ) );
            } ?>
          </h2>
          <?php } ?>

          <?php if ( get_field( 'location' ) ) { ?>
          <p class="lead">
          <?php if ( get_field( 'location_latitude' ) && ( get_field( 'location_longitude' ) ) ) { ?>
            <a href="https://www.google.com/maps/search/<?= the_field( 'location' ) ?>, <?= the_field( 'location_address' ) ?>/@<?= the_field( 'location_latitude' ) ?>,<?= the_field( 'location_longitude' ) ?>,17z">
          <?php } ?>
            <?= the_field( 'location' ) ?>
          <?php if ( get_field( 'location_latitude' ) && ( get_field( 'location_longitude' ) ) ) { ?>
            </a>
          <?php } ?>
          </p>
          <?php } ?>

          <?php if ( get_field( 'location' ) ) { ?>
          <span class="u-hidden" itemprop="location" itemscope itemtype="http://schema.org/Place">
            <span itemprop="name"><?= the_field( 'location' ) ?></span>
            <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
              <?php if ( get_field( 'location_address' ) ) { ?>
              <span itemprop="postalCode"><?= the_field( 'location_address' ) ?></span>
              <?php } ?>
            </span>
            <?php if ( get_field( 'location_latitude' ) && ( get_field( 'location_longitude' ) ) ) { ?>
            <span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
              <meta itemprop="latitude" content="<?= the_field( 'location_latitude' ) ?>" />
              <meta itemprop="longitude" content="<?= the_field( 'location_longitude' ) ?>" />
            </span>
            <?php } ?>
          </span>
          <?php } ?>

          <?php the_content(); ?>

          <?php if ( get_field( 'signup_available' ) ) { ?>
          <p>
            <a class="o-btn" href="<?= get_field( 'signup_url' ) ?>">
              Sign up
            </a>
          </p>
          <?php } ?>

          <?php get_template_part('partials/sharer'); ?>

        </div>

      </div>

    </article>

  </section>

  <?php
  $cards = get_field('cards');
  $card_class = get_field('card_class');
  $heading = get_field('heading');
  $intro = get_field('introduction');

  if (have_rows('cards')) { ?>
  <section class="c-section u-background-grey--11">
    <div class="o-container">
      <div class="o-row">
      <?php if ($heading) { ?>
        <h2><?= $heading ?></h2>
      <?php 
    } ?>
      <?php if ($intro) {
        echo $intro;
      } ?>
      <?php
      while (have_rows('cards')) {
        the_row(); ?>

        <div class="<?= (get_field('card_class')) ? $card_class : "o-col-12@xxs o-col-6@md"; ?>">
          <div class="o-card o-card--shadow">
            <?php if (get_sub_field('image')) {
              set_query_var('image_id', get_sub_field('image')["id"]);
              set_query_var('class', 'o-card__img');
              get_template_part('partials/hero', 'slide');
            } ?>

            <?php if (get_sub_field('title') || get_sub_field('content')) { ?>
            <div class="o-card__body">

              <?php if (get_sub_field('title')) { ?>
              <h2 class="h3 o-card__title <?= (get_sub_field('subtitle')) ? 'u-margin-half' : '' ?>"><?= get_sub_field('title'); ?></h2>
              <?php 
            } ?>

              <?php if (get_sub_field('subtitle')) { ?>
              <h3 class="h4 o-card__subtitle u-text-black"><?= get_sub_field('subtitle'); ?></h3>
              <?php 
            } ?>

              <?php if (get_sub_field('content')) { ?>
              <p class="o-card__text"><?= get_sub_field('content'); ?></p>
              <?php 
            } ?>

            <?php
              $link = null;
              if (get_sub_field('button_link')) {
                $link = get_sub_field('button_link');
              }
              elseif (get_sub_field('button_external_link')) {
                $link = get_sub_field('button_external_link');
              }
              else $link = '';
            ?>
            <?php if (get_sub_field('show_button') == 1) { ?>
              <a class="o-btn" href="<?= $link ?>">
                <?php if (get_sub_field('button_text')) {
                  echo get_sub_field('button_text');
                } ?>
              </a>
              <?php 
            } ?>

            </div>
            <?php 
          } ?>

          </div>
        </div>

      <?php 
    } ?>
      </div>
    </div>
  </section>
  <?php 
} ?>

<?php get_footer(); ?>
