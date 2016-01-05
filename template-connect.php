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

  $connect = new WP_Query( $args );
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
      <?php $i = 0; if ( $connect->have_posts() ) : while ( $connect->have_posts() ) : $connect->the_post(); ?>
        <?php
          $info = get_the_content();
          $loc = get_field("cg_location");
      ?>
        ['<?php the_title(); ?>','<?php echo $info; ?>',<?php echo $loc['lat']; ?>,<?php echo $loc['lng']; ?>],
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
        mapInfoWindow.setContent("<h3 class='no-margin-bottom'>" + this.title + "</h3>" + this.html);
        mapInfoWindow.open(map, this);
      });
      mapBounds.extend(new google.maps.LatLng(mapConnectGroup[2], mapConnectGroup[3]));
    }

    map.fitBounds(mapBounds);
    centreMap();
  }

  google.maps.event.addDomListener(window, 'load', initMap);
  google.maps.event.addDomListener(window, 'load', centreMap);

  google.maps.event.addDomListener(window, 'resize', centreMap);
</script>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="c-section o-container">

    <article <?php post_class( 'o-row c-article u-margin' ); ?> role="article">

      <div class="o-col-xs-12 o-col-md-7 c-post-content u-center-block">

        <h1><?php the_title(); ?></h1>

        <?php the_content(); ?>

        <h2>Where do groups meet?</h2>
        <p>Our connect groups meet all over the region, check out the map below to find one near you! Please <a href="/contact">get in touch</a> if you're interested in joining a connect group.</p>

      </div>

    </article>

  </section>

  <div class="c-map c-map--40">
    <div class="c-map__inner js-google-map"></div>
  </div>


<?php endwhile; endif; ?>

<?php get_footer(); ?>