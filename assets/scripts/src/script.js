
/**
* Global variables
*/
var doc = document,
    win = window,
    nav = navigator,
    $doc = $(doc),
    $win = $(win),
    $body = $('body'),
    $header = $('.c-header');

/**
 *   Google Maps related variables
 */
var googleActive = ( typeof google !== "undefined" ),
    map,
    mapOpts,
    mapStyle = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}],
    mapCentre = ( googleActive === true ) ? new google.maps.LatLng(53.733241, -2.662240) : "",
    mapBounds,
    mapLocations,
    mapInfoWindow,
    mapMarker,
    //mapMarkerIcon = "/wp-content/themes/valleychurch3/assets/images/dist/marker.png",
    mapMarkerIconSmall = "/wp-content/themes/valleychurch3/assets/images/dist/marker-small.png";

var Valley = (function() {
  "use strict";

  return {

    /**
     * Scoped variables inside `Valley.#` for storing key bits of information
     */
    Version: '3.6.1',

    /**
     * Kick everything off
     */
    Init: function() {
      Valley.InitSideNav();
      Valley.ModernizrTest();
      Valley.CheckNotifications();
      Valley.AttachCookiePopup();
      Valley.ResponsiveIframes();
      Valley.ResponsiveTables();

      doc.documentElement.setAttribute('data-useragent', nav.userAgent);

      if ( $('input[name="locationid"]').length !== 0 ) {
        var location = $('input[name="locationid"]').val();
        location = location.charAt(0).toUpperCase() + location.substring(1);
        $('select[name="location"]').val( location );
      }

      // iOS fix
      $('.c-menu > .menu-item > a').attr('onclick', 'void(0)');
    },

    /**
     * Initialise the Google Map
     */
    InitMap: function(map_centre, zoom, auto_size, location_array, info_window_content, marker_click, scrollable) {
      if ( googleActive === true ) {
        mapCentre = map_centre;
        mapOpts = {
          zoom: zoom,
          center: map_centre,
          rotateControl: false,
          panControl: false,
          mapTypeControl: false,
          mapTypeControlOptions: {
            myTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
          },
          streetViewControl: false,
          scrollwheel: scrollable,
        };

        map = new google.maps.Map(document.getElementsByClassName('js-google-map')[0], mapOpts);

        map.set('styles', mapStyle);

        if ( info_window_content !== "" ) {
          mapInfoWindow = new google.maps.InfoWindow({
            content: 'Loading...'
          });
        }

        if ( auto_size === 1 ) {
          mapBounds = new google.maps.LatLngBounds();
        }

        mapLocations = location_array;

        //Add marker and info window for each group
        for (var i = 0; i < mapLocations.length; i++) {
          var mapLoc = mapLocations[i];
          mapMarker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(mapLoc[0], mapLoc[1]),
            title: mapLoc[2],
            html: mapLoc[3],
            url: mapLoc[4],
            animation: google.maps.Animation.DROP,
            icon: mapMarkerIconSmall,
          });

          if ( info_window_content !== "" ) {
            google.maps.event.addListener(mapMarker, 'click', function() {
              mapInfoWindow.setContent(info_window_content);
              mapInfoWindow.open(map, this);
            });
          }

          if ( marker_click === 1 ) {
            google.maps.event.addListener(mapMarker, 'click', function() {
              win.location.href = this.url;
            });
          }

          if ( auto_size === 1 ) {
            mapBounds.extend(new google.maps.LatLng(mapLoc[0], mapLoc[1]));
          }
        }

        if ( auto_size === 1 ) {
          map.fitBounds(mapBounds);
        }

        Valley.CentreMap(auto_size);

        google.maps.event.addDomListener(win, 'resize', Valley.CentreMap(auto_size));
      }
    },

    /**
     * Reusable function for centring the map
     */
    CentreMap: function(auto_size) {
      google.maps.event.trigger(map, 'resize');
      map.setCenter(mapCentre);
      if ( auto_size === 1 ) {
        map.fitBounds(mapBounds);
      }
    },

    CheckNotifications: function() {
      try {
        var notificationData = JSON.parse( localStorage.getItem( 'Valley.Notification' ) );
        if ( notificationData !== null ) {
          if ($('.c-notification').data('notification-id') !== notificationData.id) {
            localStorage.removeItem( 'Valley.Notification' );
            Valley.AttachNotifications();
          }
        }
        else {
          Valley.AttachNotifications();
        }
      }
      catch( e ) { console.log("Error: " + e.message); }
    },

    AttachNotifications: function() {
      $('.c-notification')
        .addClass('is-notification-active')
        .attr('aria-expanded', 'true');

      $('.js-notification-dismiss').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).closest('.c-notification');

        parent
          .attr('aria-expanded', 'false')
          .removeClass('is-notification-active');

        var notificationData = {
          id: parent.data('notification-id'),
          hide: true,
        };
        localStorage.setItem( 'Valley.Notification', JSON.stringify( notificationData ) );
      });
    },

    AttachCookiePopup: function () {
      $('.js-cookies-dismiss').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).closest('.c-notification');

        parent
          .attr('aria-expanded', 'false')
          .removeClass('is-notification-active');

        Cookies.set('valleyHideCookieBar', '1', { expires: 60, secure: true });
      });
    },

    ModernizrTest: function() {
      Modernizr.addTest('fontvariant', function() {
        var fontVariantLigatures = !!('fontVariantLigatures' in doc.body.style);
        var fontFeatureSettings = !!('fontFeatureSettings' in doc.body.style);

        return !!(fontVariantLigatures || fontFeatureSettings);
      });
    },

    InitSideNav: function() {
      $('.js-nav-toggle').on('click', function(e) {
        e.preventDefault();
        $body.toggleClass('is-menu-active');
      });
    },

    CheckSideNav: function() {
      if (Modernizr.mq('(min-width: 60em)')) {
        if ($body.hasClass('is-menu-active')) {
          $body.removeClass('is-menu-active');
        }
      }
    },

    ResponsiveIframes: function() {
      $('.c-post-content iframe').each(function(i, el) {
        $(el).wrap('<div class="o-ratio u-margin u-margin-double@md"/>');
      });
    },

    ResponsiveTables: function() {
      $('table.o-table').each(function(i, el) {
        $(el).wrap('<div class="o-table-responsive u-margin u-margin-double@md"/>');
      });
    },

  };
}());

// Obligatory debounce function
function debounce(func, wait, immediate) {
  var result;
  var timeout = null;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) { result = func.apply(context, args); }
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) { result = func.apply(context, args); }
    return result;
  };
}

$(function() {
  Valley.Init();
});

$(window).resize(function() {
  debounce(Valley.CheckSideNav(), 250);
});
