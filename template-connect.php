<?php
/*
  Template Name: Connect Groups
*/
get_header(); ?>

<?php
  $args =
    array(
      'post_type' => 'connect',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    );

  $wp_query = new WP_Query( $args );
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

    mapInfoWindow = new google.maps.InfoWindow({
      content: 'Loading...'
    });

    mapBounds = new google.maps.LatLngBounds();

    mapLocations = [
      <?php $i = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php
          $info = get_the_content();
          $loc = get_field("cg_location");
      ?>
        ['<?php the_title(); ?>','<?= $info; ?>',<?= ( $loc ) ? $loc : ''; ?>],
      <?php $i++; endwhile; else : endif; ?>
      <?php wp_reset_query(); ?>
    ];

    //Add marker and info window for each group
    for (var i = 0; i < mapLocations.length; i++) {
      var mapConnectGroup = mapLocations[i];
      mapMarker = new google.maps.Marker({
        position: new google.maps.LatLng(mapConnectGroup[2], mapConnectGroup[3]),
        map: map,
        title: mapConnectGroup[0],
        html: mapConnectGroup[1]
      });
      google.maps.event.addListener(mapMarker, 'click', function() {
        mapInfoWindow.setContent("<h3 class='h4 u-margin--half'>" + this.title + "</h3>" + this.html);
        mapInfoWindow.open(map, this);
      });
      mapBounds.extend(new google.maps.LatLng(mapConnectGroup[2], mapConnectGroup[3]));
    }

    map.fitBounds(mapBounds);
    centreMap();
  }

  function centreMap() {
    google.maps.event.trigger(map, 'resize');
    map.setCenter(mapCentre);
    map.fitBounds(mapBounds);
  }

  google.maps.event.addDomListener(window, 'load', initMap);
  google.maps.event.addDomListener(window, 'load', centreMap);

  google.maps.event.addDomListener(window, 'resize', centreMap);
</script>

<?php
if (have_posts()) :
  while (have_posts()) :
    the_post(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="c-post-content u-center-block">

        <h1 <?= ( get_field( 'hide_h1' ) == 1 ) ? 'class="u-hidden"' : ""; ?>><?php the_title(); ?></h1>

        <?php the_content(); ?>

      </div>

    </article>

  </section>

  <div class="c-map c-map--40">
    <div class="c-map__inner js-google-map"></div>
  </div>

<?php endwhile; else : endif; ?>

<?php get_footer(); ?>
