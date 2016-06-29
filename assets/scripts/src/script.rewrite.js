"use strict";

var googleActive = ( typeof google !== "undefined" ),
    map,
    mapOpts,
    mapStyle,
    mapCentre = ( googleActive === true ) ? new google.maps.LatLng(53.733241, -2.662240) : "",
    mapBounds,
    mapLocations,
    mapInfoWindow,
    mapMarker,
    mapMarkerIcon = "/wp-content/themes/valleychurch3/assets/images/dist/marker.png",
    mapMarkerIconSmall = "/wp-content/themes/valleychurch3/assets/images/dist/marker-small.png";

mapStyle = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];

var Valley = (function() {

  /**
   * Reusable variables
   */
  var doc = document;
  var win = window;
  var nav = navigator;
  var $doc = $(doc);
  var $win = $(win);
  var $body = $('body');
  var $header = $('.c-header');

  return {

    /**
     * Scoped variables inside `Valley.#` for storing key bits of information
     */
    Version: '3.2.0',

    /**
     * Kick everything off
     */
    Init: function() {
      doc.documentElement.setAttribute('data-useragent', nav.userAgent);

      Valley.InitSideNav();
      Valley.ModernizrTest();
      Valley.Slider();
      Valley.CheckNotifications();
      Valley.ResponsiveIframes();
      Valley.DownArrows();
      Valley.CheckHeaderPosition();
      Valley.SetMainLocation();
      Valley.RemoveMainLocation();
      Valley.CheckMainLocation();
    },

    /**
     * Initialise the Google Map
     */
    InitMap: function(map_centre, zoom, auto_size, location_array, info_window_content, marker_click, scrollable) {
      if ( googleActive === true ) {
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
        // console.log(mapLocations);

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

        google.maps.event.addDomListener(win, 'resize', Valley.CentreMap);
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
        var notificationData = JSON.parse( localStorage.getItem( 'valley.notification' ) );
        if ( notificationData !== null ) {
          if ($('.c-notification').first().attr('id') !== notificationData.id) {
            localStorage.removeItem( 'valley.notification' );
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
        .first()
        .addClass('is-notification-active')
        .attr('aria-expanded', 'true');

      $('.js-notification-dismiss').on('click', function(e) {
        e.preventDefault();
        $('.c-notification')
          .first()
          .attr('aria-expanded', 'false')
          .removeClass('is-notification-active');

        var notificationDataToSet = {
          id: $('.c-notification').first().attr('id'),
          hide: true,
        };
        localStorage.setItem( 'valley.notification', JSON.stringify( notificationDataToSet ) );
      });
    },

    ModernizrTest: function() {
      Modernizr.addTest('fontvariant', function() {
        var fontVariantLigatures = !!('fontVariantLigatures' in doc.body.style);
        var fontFeatureSettings = !!('fontFeatureSettings' in doc.body.style);

        return !!(fontVariantLigatures || fontFeatureSettings);
      });
    },

    Slider: function() {
      var prevImg =
        '<img src="//cdn.valleychurch.eu/wp-content/themes/valleychurch3/assets/images/dist/icon-prev.svg" width="100%" height="100%" class="prev-btn" />';

      var nextImg =
        '<img src="//cdn.valleychurch.eu/wp-content/themes/valleychurch3/assets/images/dist/icon-next.svg" width="100%" height="100%" class="next-btn" />';

      $('.c-slides').responsiveSlides({
        speed: 500,
        timeout: 8000,
        auto: true,
        nav: true,
        pager: true,
        navContainer: '.slide-control',
        prevText: prevImg,
        nextText: nextImg
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
      $('iframe').each(function(i, el) {
        $(el).wrap('<div class="o-ratio u-margin--md--double"/>');
      });
    },

    DownArrows: function() {
      $('.js-jump-down').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent();

        $('html, body').animate({
          scrollTop: ( parent.next().offset().top - $header.height() )
        }, 1000);
      });
    },

    CheckHeaderPosition: function() {
      var scroll = $win.scrollTop();

      if ( $body.hasClass( 'home' ) ) {
        if ( scroll > 150 && !$header.hasClass( 'is-visible' ) ) {
          $header.addClass( 'is-visible' );
        }
        if ( scroll < 150 && $header.hasClass( 'is-visible' ) ) {
          $header.removeClass( 'is-visible' );
        }
      }
    },

    SetMainLocation: function() {
      $('.js-set-location').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('location-id');
        var name = $(this).data('location-name');

        Cookies.set('vc_location_id', id, { expires: 365 });
        Cookies.set('vc_location_name', name, { expires: 365 });

        $(this)
          .removeClass('js-set-location')
          .addClass('js-remove-location')
          .text('Remove as my main location');

        Valley.RemoveMainLocation();
      });
    },

    RemoveMainLocation: function() {
      $('.js-remove-location').on('click', function(e) {
        e.preventDefault();

        Cookies.remove('vc_location_id');
        Cookies.remove('vc_location_name');

        $(this)
          .removeClass('js-remove-location')
          .addClass('js-set-location')
          .text('Set as my main location');

        Valley.SetMainLocation();
      });
    },

    CheckMainLocation: function() {
      if ( $('.js-set-location').length !== 0 ) {
        var $this = $('.js-set-location');
        var id = parseInt($this.data('location-id'));
        var name = $this.data('location-name');

        if (typeof Cookies.get('vc_location_id') !== "undefined" && typeof Cookies.get('vc_location_name') !== "undefined") {
          if ( Cookies.get('vc_location_id') === String(id) && Cookies.get('vc_location_name') === String(name) ) {
            $this
              .removeClass('js-set-location')
              .addClass('js-remove-location')
              .text('Remove as my main location');

            Valley.RemoveMainLocation();
          }
        }
      }
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

$(window).scroll(function() {
  debounce(Valley.CheckHeaderPosition(), 500);
});
