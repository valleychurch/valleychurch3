<?php

/* Template Name: Locations */

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
        var map,
            mapOpts,
            mapStyle,
            mapStyled,
            mapCentre = new google.maps.LatLng(53.733241, -2.662240),
            mapBounds,
            mapLocations,
            mapMarker;

        var mapStyled = new google.maps.StyledMapType(mapStyle, { name: "Styled" });

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

          map.set('styles', [
            {
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "saturation": 36
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 40
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    },
                    {
                        "weight": 1.2
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 18
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 19
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    }
                ]
            }
          ]);

          mapBounds = new google.maps.LatLngBounds();

          mapLocations = [
          <?php
            $i = 0; if ( $locations->have_posts() ) : while ( $locations->have_posts() ) : $locations->the_post();
            $info = get_the_content();
            $location = get_field('location');
            if ( $location ) {
          ?>
            ['<?php the_title(); ?>', <?php echo $location['lat']; ?>, <?php echo $location['lng']; ?>],
          <?php
            $i++;
            }
            endwhile; endif; wp_reset_query();
          ?>
          ];

          for (var i = 0; i < mapLocations.length; i++) {
            var mapLocation = mapLocations[i];
            mapMarker = new google.maps.Marker({
              position: new google.maps.LatLng(mapLocation[1], mapLocation[2]),
              map: map,
              title: mapLocation[0]
            })
            mapBounds.extend(new google.maps.LatLng(mapLocation[1], mapLocation[2]));
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

        google.maps.event.addDomListener(window, 'resize', centerMap);
      </script>


      <div class="c-banner c-banner--clear u-margin u-margin--sm--double">

        <div class="c-google-map js-google-map">

        </div>

      </div>


      <article <?php post_class( 'o-container' ); ?> role="article">

        <div class="o-row">

          <div class="o-col-xs-12 o-col-md-7 c-post-content u-center-block">

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>
            <?php wp_reset_query(); ?>

          </div>

        </div>

        <?php if ( $locations->have_posts() ) : ?>

        <div class="o-row">

        <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>

          <div class="o-col-xs-12 o-col-md-4">

            <div class="o-card">
              <?php if ( has_post_thumbnail() ) { ?>
              <div class="o-card__image"><?php the_post_thumbnail(); ?></div>
              <?php } ?>
              <div class="o-card__body">
                <h2 class="o-card__title"><?php the_title(); ?></h2>
                <?php $terms = get_the_terms( $post->ID, 'location_type' ); if ( $terms && !is_wp_error( $terms ) ) { ?>
                <p class="o-card__subtitle"><?php echo $terms[0]->name; ?></p>
                <?php } ?>
                <p class="o-card__text"><?php the_field('location_address'); ?></p>
              </div>
            </div>

          </div>

        <?php endwhile; ?>

        </div>

        <?php endif; ?>

      </article>