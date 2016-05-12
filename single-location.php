<?php get_header(); ?>

<script>
  var mapCentre = new google.maps.LatLng(<?= get_field('location')['coordinates']; ?>);
  function initMap() {
    mapOpts = {
      zoom: 16,
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

    mapMarker = new google.maps.Marker({
      position: mapCentre,
      map: map,
      // title: "<?= the_title(); ?>",
      // html: mapConnectGroup[1]
    });
    // google.maps.event.addListener(mapMarker, 'click', function() {
    //   mapInfoWindow.setContent("<h3 class='h4 u-margin--half'>" + this.title + "</h3>" + this.html);
    //   mapInfoWindow.open(map, this);
    // });
    //
    centreMap();
  }

  function centreMap() {
    google.maps.event.trigger(map, 'resize');
    map.setCenter(mapCentre);
  }

  google.maps.event.addDomListener(window, 'load', initMap);
  google.maps.event.addDomListener(window, 'load', centreMap);

  google.maps.event.addDomListener(window, 'resize', centreMap);
</script>

  <?php get_template_part( 'partials/featured-image' ); ?>

  <section class="o-container c-section">

    <article <?php post_class( 'o-row c-article u-margin' ); ?>>

      <div class="c-post-content u-center-block">

        <h1><?php the_title(); ?></h1>

        <?php the_content(); ?>

      </div>

    </article>

  </section>

  <div class="c-map c-map--40">
  <?php if ( get_field( 'google_maps_link' ) ) { ?>
    <a class="o-btn c-map__btn" title="Get directions" href="<?= get_field( 'google_maps_link' ); ?>">
      Get directions
    </a>
  <?php } ?>
    <div class="c-map__inner js-google-map"></div>
  </div>

<?php get_footer(); ?>
