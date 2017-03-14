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

          <h1 class="<?= $h1_class ?>" itemprop="name">
          <?php if ( get_field( 'custom_h1' ) ) {
            get_field( 'custom_h1' );
          } else {
            the_title();
          } ?>
          </h1>

          <?php if ( get_field( 'datetime_start' ) ) { ?>
          <h2 <?= ( get_field( 'datetimestamp_start' ) ? 'itemprop="startDate" content="' . date( 'c', get_field( 'datetimestamp_start' ) ) . '"' : "" ); ?>>
            <?php if ( get_field( 'all_day_event' ) == 0 ) {
              echo date('jS F, g:ia', strtotime( get_field( 'datetime_start' ) ) )
            } else {
              echo date('jS F', strtotime( get_field( 'datetime_start' ) ) )
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

          <?php the_content(); ?>

          <?php if ( get_field( 'signup_available' ) ) { ?>
          <p>
            <a class="o-btn" href="<?= get_field( 'signup_url' ) ?>" target="_blank">
              Sign up
            </a>
          </p>
          <?php } ?>

          <?php get_template_part('partials/sharer'); ?>

        </div>

      </div>

    </article>

  </section>

<?php get_footer(); ?>
