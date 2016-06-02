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
  $myLocation = isset( $_COOKIE['vc_location_id'] ) ? $_COOKIE['vc_location_id'] : 0;
  $locationArgs =
    array(
      'post_type' => 'location',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    );
  $locations = get_posts( $locationArgs ); ?>

  <section class="c-section u-background-grey--11">

    <div class="o-container">
      <div class="o-row o-row--center">
        <div class="o-col-xxs-12 o-col-md-3">
          <label for="location-select">Location</label>
          <select id="location-select">
            <option value="0"<?= ( $myLocation == 0 ) ? " selected" : ""; ?>>--All--</option>
            <?php foreach ( $locations as $location ) { ?>
            <option value="<?= $location->ID; ?>"<?= ( $myLocation == $location->ID ) ? " selected" : ""; ?>>
              <?= $location->post_title; ?>
            </option>
            <?php } ?>
          </select>
        </div>
        <div class="o-col-xxs-12 o-col-md-3">
          <label>&nbsp;</label>
          <a href="#" class="o-btn js-search-events" role="button">
            Search
          </a>
          <a href="#" class="o-btn o-btn--reset js-reset-events" role="button">
            Reset
          </a>
        </div>
      </div>
    </div>

    <div class="o-container">

      <div class="o-row o-row--center js-events-container">

      </div>

    </div>

  </section>

<?php get_footer(); ?>
