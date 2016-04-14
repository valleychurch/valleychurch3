<?php
/**
 * Template Name: Locations
 */
get_header();
?>

<?php
  $args =
    array(
      'post_type' => 'location',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    );

  $locations = new WP_Query( $args );
?>

<script>
  function initMap() {
    mapOpts = {
      zoom: 9,
      center: mapCentre,
      //mapTypeId: google.maps.MapTypeId.ROADMAP,
      rotateControl: false,
      panControl: false,
      mapTypeControl: false,
      mapTypeControlOptions: {
        myTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
      },
      streetViewControl: false,
      scrollwheel: false
    };

    map = new google.maps.Map(document.getElementsByClassName('js-google-map')[0], mapOpts);

    map.set('styles', mapStyle);

    mapBounds = new google.maps.LatLngBounds();

    mapLocations = [
    <?php
    $i = 0; if ( $locations->have_posts() ) : while ( $locations->have_posts() ) : $locations->the_post();
    $info = get_the_content();
    $location = get_field('location');
    if ( $location ) {
    ?>
      ['<?php the_title(); ?>', <?= $location['lat']; ?>, <?= $location['lng']; ?>],
    <?php
    $i++;
    }
    endwhile;
    endif;
    wp_reset_query();
    ?>
    ];

    for (var i = 0; i < mapLocations.length; i++) {
      var mapLocation = mapLocations[i];
      mapMarker = new google.maps.Marker({
        position: new google.maps.LatLng(mapLocation[1], mapLocation[2]),
        map: map,
        title: mapLocation[0]
      });
      mapBounds.extend(new google.maps.LatLng(mapLocation[1], mapLocation[2]));
    }

    map.fitBounds(mapBounds);
    centreMap();
  }

  google.maps.event.addDomListener(window, 'load', initMap);
  google.maps.event.addDomListener(window, 'load', centreMap);

  google.maps.event.addDomListener(window, 'resize', centreMap);
</script>

  <div class="c-banner c-banner--clear u-margin u-margin--sm--double">

    <div class="o-row c-map c-map--40">
      <div class="c-map__inner js-google-map"></div>
    </div>

  </div>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

        <div class="o-col-xxs-12 c-post-content u-center-block">

          <h1 <?php ( get_field( 'hide_h1' ) == 1 ) ? print 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>

          <?php the_content(); ?>

        </div>

    </article>

  </section>

  <?php wp_reset_query(); ?>
  <?php if ( $locations->have_posts() ) : ?>

  <section class="o-container c-section c-section--grey">

    <div class="o-row">
    <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>

      <div class="o-col-xxs-12 o-col-md-4">

        <div class="o-card u-text-center">
          <?php
          set_query_var( 'class', 'o-card__img' );
          get_template_part( 'partials/featured-image', 'slide' );
          ?>
          <div class="o-card__body">
            <?php $times = get_field( 'service_times' ); ?>
            <h2 class="o-card__title <?php ( $times ) ? print "u-margin--half" : ""; ?>"><?php the_title(); ?></h2>
            <?php if ( $times ) { ?>
            <h3 class="o-card__subtitle"><?php the_field( 'service_times' ); ?></h3>
            <?php } ?>
            <div class="o-card__text">
            <?php if ( get_field( 'address' ) ) { ?>
            <p>
            <?php if ( get_field( 'google_maps_link' ) ) { ?>
              <a href="http://<?= get_field( 'google_maps_link' ); ?>" target="_blank">
            <?php }
            echo get_field( 'address' );
            if ( get_field( 'google_maps_link' ) ) { ?>
              </a>
            <?php } ?>
            </p>
            <?php } ?>
            </div>
          </div>
        </div>

      </div>

    <?php endwhile; ?>

    </div>

  <?php else : endif; ?>

  </section>

<?php get_footer(); ?>
