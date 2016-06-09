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

    <form name="events-search" method="GET" action="<?php echo get_permalink(); ?>">

      <div class="o-container">
        <div class="o-row o-row--center">
          <div class="o-col-xxs-12 o-col-md-2">
            <label for="location-select">Location</label>
            <select name="locationid" id="location-select">
              <option value="0"<?= ( $myLocation == 0 ) ? " selected" : ""; ?>>--All--</option>
              <?php foreach ( $locations as $location ) { ?>
              <option value="<?= $location->ID; ?>"<?= ( $myLocation == $location->ID ) ? " selected" : ""; ?>>
                <?= $location->post_title; ?>
              </option>
              <?php } ?>
            </select>
          </div>
          <div class="o-col-xxs-12 o-col-md-2">
            <label for="date-from">From</label>
            <input type="date" name="datefrom" id="date-from" min="<?= date( "Y-m-d" ); ?>" max="<?= date( "Y-m-d", strtotime("+1 years")); ?>" value="<?= date( "Y-m-d" ); ?>">
          </div>
          <div class="o-col-xxs-12 o-col-md-2">
            <label for="date-to">To</label>
            <input type="date" name="dateto" id="date-to" min="<?= date( "Y-m-d" ); ?>" max="<?= date( "Y-m-d", strtotime("+1 years")); ?>" value="<?= date( "Y-m-d", strtotime("+2 months") ); ?>">
          </div>
          <div class="o-col-xxs-12 o-col-md-2">
            <label>&nbsp;</label>
            <input type="submit" class="o-btn js-search-events" value="Search">
            <input type="reset" class="o-btn o-btn--reset js-reset-events" value="Reset">
          </div>
        </div>
      </div>

      <div class="o-container">

        <div class="o-row o-row--center">

        <?php
          $tax_query = [];
          $meta_query = [];
          $location = ( isset( $_GET['locationid'] ) ? $_GET['locationid'] : 0 );
          $current_page = get_query_var( 'paged',  1 );
          $datefrom = ( isset( $_GET['datefrom'] ) ? $_GET['datefrom'] : date("Y-m-d") );
          $dateto = ( isset( $_GET['dateto'] ) ? $_GET['dateto'] : date("Y-m-d", strtotime("+2 months") ) );

          if ( isset( $location ) && $location != 0 ) {
            $tax_query[] =
              array(
                'taxonomy'  => 'location',
                'field'     => 'term_id',
                'terms'     => $location,
                'operator'  => 'IN',
              );
          }

          $meta_query[] =
            array(
              'relation'  => 'AND',
              array(
                'key'     => 'datetime_start',
                'value'   => strtotime( $datefrom ),
                'compare' => '>='
              ),
              array(
                'key'     => 'datetime_end',
                'value'   => strtotime( $dateto ),
                'compare' => '<='
              )
            );

          $args =
            array(
              'post_type'       => 'events',
              'post_status'     => 'publish',
              'posts_per_page'  => 12,
              'paged'           => $current_page,
              'meta_query'      => $meta_query,
              'tax_query'       => $tax_query,
            );

          $wp_query = new WP_Query( $args );

          if ( $wp_query->have_posts() ) :
            while ( $wp_query->have_posts() ) :
              $wp_query->the_post(); ?>

            <div class="o-col-xxs-12 o-col-md-4">
              <?php get_template_part( 'partials/card', 'event' ); ?>
            </div>

          <?php
            endwhile;
          get_template_part( 'partials/pagination' );
          else:
            get_template_part( 'partials/no-content-found' );
          endif;

          wp_reset_query();
          wp_reset_postdata();
        ?>

        </div>

      </div>

    </form>

  </section>

<?php get_footer(); ?>
