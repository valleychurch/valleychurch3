"use strict";
/**
 * Global variable for storing bits of information and resuables
 */
var valley = {
  version: '3.2.0dev',
  isModernBrowser: (
    'querySelector' in document
    && 'addEventListener' in window
    && 'localStorage' in window
    && (
      ('XMLHttpRequest' in window && 'withCredentials' in new XMLHttpRequest())
      || 'XDomainRequest' in window
    )
  ),
  css: {
    loaded: false,
    version: null,
    fromLocalStorage: false,
    fromAsync: false,
  },
  fontAwesome: {
    loaded: false
  },
  js: {
    loaded: false,
  },
  supports: {
    objectFit: false,
    fontVariantLigatures: false,
  },
  homeSliderActive: false,
  notificationActive: false
};


/**
 * Try and get CSS from localStorage as soon as possible
 */
// loadCSSFromStorage(valley.version);


/**
 * Async load the main script file (non-render blocking)
 */
// var script = document.createElement('script');
// script.async = 'async';
// script.src = '/wp-content/themes/valleychurch3/assets/scripts/dist/script.min.js';
// document.getElementsByTagName("head")[0].appendChild(script);


/**
 * Most of this taken from the amazing work of Patrick Hamann and The Guardian team
 * https://github.com/guardian/frontend/blob/9c071adf6a1b9238362be85210cdad05c6a53955/common/app/views/fragments/loadCss.scala.html
 */
function loadCSSFromStorage() {
  var c = localStorage.getItem('valley.css.' + valley.version), s, sc;
  if(c) {
    s = document.createElement('style');
    sc = document.getElementsByTagName('script')[0];
    s.innerHTML = c;
    s.setAttribute('data-loaded-from', 'local');
    sc.parentNode.insertBefore(s, sc);
    valley.css.loaded = true;
    valley.css.fromLocalStorage = true;
    valley.css.version = valley.version;
  }
}

function loadCSSWithAjax(c, save) {
  var xhr = new XMLHttpRequest();
  try {
    xhr.open('GET', c);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if(xhr.status === 200) {
          inlineCSS(xhr.responseText, valley.version);
          if (save === true) {
            storeCSS(xhr.responseText, valley.version);
          }
        }
      }
    };
    setTimeout( function () {
      if(xhr.readyState < 4) {
        xhr.abort();
        loadCSSWithLink(c);
      }
    }, 5000);
    xhr.send();
  }
  catch (ex) {
    loadCSSWithLink(c);
  }
}

function loadCSSWithLink(c) {
  var l = document.createElement('link');
  l.rel = "stylesheet";
  l.type = 'text/css';
  l.href = c;
  injectElement(l);
}

function injectElement(e) {
  var sc = document.getElementsByTagName('script')[0];
  sc.parentNode.insertBefore(e, sc);
}

function inlineCSS(c) {
  var s = document.createElement('style');
  s.innerHTML = c;
  s.setAttribute('data-loaded-from', 'ajax');
  injectElement(s);
  valley.css.loaded = true;
  valley.css.fromAsync = true;
  valley.css.version = valley.version;
}

function storeCSS(c) {
  Object.keys(localStorage).some(function(key) {
    if(key.match(/^valley.css/g)) {
      localStorage.removeItem(key);
      return true;
    }
    return false;
  });
  try {
    localStorage.setItem('valley.css.' + valley.version, c);
  }
  catch(e) {}
}

var googleActive = ( typeof google !== "undefined" ),
    map,
    mapOpts,
    mapStyle,
    mapStyled = ( googleActive ) ? new google.maps.StyledMapType(mapStyle, { name: "Styled" }) : "",
    mapCentre = ( googleActive ) ? new google.maps.LatLng(53.733241, -2.662240) : "",
    mapBounds,
    mapLocations,
    mapInfoWindow,
    mapMarker,
    mapMarkerIcon = "/wp-content/themes/valleychurch3/assets/images/dist/marker.png",
    mapMarkerIconSmall = "/wp-content/themes/valleychurch3/assets/images/dist/marker-small.png";

mapStyle = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];

// Centre Google map
function centreMap(auto_size) {
  google.maps.event.trigger(map, 'resize');
  map.setCenter(mapCentre);
  if ( auto_size === 1 ) {
    map.fitBounds(mapBounds);
  }
}

// Initialise Google map
function initMap(map_centre, zoom, auto_size, location_array, info_window_content, marker_click, scrollable) {
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
        window.location.href = this.url;
      });
    }

    if ( auto_size === 1 ) {
      mapBounds.extend(new google.maps.LatLng(mapLoc[0], mapLoc[1]));
    }
  }

  if ( auto_size === 1 ) {
    map.fitBounds(mapBounds);
  }

  centreMap(auto_size);

  google.maps.event.addDomListener(window, 'resize', centreMap);
}

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

// Attaches events to allow notification functionality to work
function checkNotifications() {
  try {
    var notificationData = JSON.parse( localStorage.getItem( 'valley.notification' ) );
    if ( notificationData !== null ) {
      if ($('.c-notification')[0].attr('id') !== notificationData.id) {
        localStorage.removeItem( 'valley.notification' );
        attachNotifications();
      }
    }
    else {
      attachNotifications();
    }
  }
  catch( e ) { }
}

// Attach the event for the click
function attachNotifications() {
  $('.c-notification')[0]
    //.slideDown()
    .addClass('is-notification-active')
    .attr('aria-expanded', 'true');
  valley.notificationActive = true;

  $('.js-notification-dismiss').on('click', function(e) {
    e.preventDefault();
    $('.c-notification')[0]
      .attr('aria-expanded', 'false')
      .removeClass('is-notification-active');

    var notificationDataToSet = {
      id: $('.c-notification')[0].attr('id'),
      hide: true,
    };
    localStorage.setItem( 'valley.notification', JSON.stringify( notificationDataToSet ) );
    valley.notificationActive = false;
  });
}

function addTests() {
  Modernizr.addTest('fontvariant', function() {
    var fontVariantLigatures = !!('fontVariantLigatures' in document.body.style);
    var fontFeatureSettings = !!('fontFeatureSettings' in document.body.style);

    return !!(fontVariantLigatures || fontFeatureSettings);
  });
}

// Side nav toggle
function sideNav() {
  $('.js-nav-toggle').on('click', function(e) {
    e.preventDefault();
    $('body').toggleClass('is-menu-active');
  });
}

// Check if sidenav is still showing on >60em windows
function checkSideNav() {
  if (Modernizr.mq('(min-width: 60em)')) {
    if ($('body').hasClass('is-menu-active')) {
      $('body').removeClass('is-menu-active');
    }
  }
}

function loadHomeSlider() {
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

  valley.homeSliderActive = true;
}

function responsiveIframes() {
  $('iframe').each(function(i, el) {
    $(el).wrap('<div class="o-ratio u-margin--md--double"/>');
  });
}

function downArrows() {
  $('.js-jump-down').on('click', function(e) {
    e.preventDefault();
    var parent = $(this).parent();

    $('html, body').animate({
      scrollTop: ( parent.next().offset().top - $('.c-header').height() )
    }, 1000);
  });
}

function checkHeaderPosition() {
  var scroll = $(window).scrollTop();
  var header = $('.c-header');
  var body = $('body');

  if ( body.hasClass( 'home' ) ) {
    if ( scroll > 150 && !header.hasClass( 'is-visible' ) ) {
      header.addClass( 'is-visible' );
    }
    if ( scroll < 150 && header.hasClass( 'is-visible' ) ) {
      header.removeClass( 'is-visible' );
    }
  }
}

function setMainLocation() {
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

    removeMainLocation();
  });
}

function removeMainLocation() {
  $('.js-remove-location').on('click', function(e) {
    e.preventDefault();

    Cookies.remove('vc_location_id');
    Cookies.remove('vc_location_name');

    $(this)
      .removeClass('js-remove-location')
      .addClass('js-set-location')
      .text('Set as my main location');

    setMainLocation();
  });
}

function checkMainLocation() {
  if ( $('.js-set-location').length !== 0 ) {
    var $this = $('.js-set-location');
    var id = parseInt($this.data('location-id'));
    var name = $this.data('location-name');

    if (typeof Cookies.get('vc_location_id') !== "undefined" && typeof Cookies.get('vc_location_name') !== "undefined") {
      if ( Cookies.get('vc_location_id') == id && Cookies.get('vc_location_name') == name ) {
        $this
          .removeClass('js-set-location')
          .addClass('js-remove-location')
          .text('Remove as my main location');

        removeMainLocation();
      }
    }
  }
}

// function loadEvents() {
//   $('.js-search-events').on('click', function(e) {
//     e.preventDefault();
//     searchEvents(1);
//   });

//   $('.js-reset-events').on('click', function(e) {
//     e.preventDefault();
//     $('select#location-select').val(0);
//     searchEvents(1);
//   });
// }

// function searchEvents(paged) {
//   if ( $('.js-events-container').length !== 0 ) {
//     var data = {
//       'action': 'load_events',
//       'location': $('select#location-select').val(),
//       'paged': ( paged ? paged : 1 ),
//     };

//     $.post(ajaxurl, data, function(response, status) {
//       console.log(status);
//       if ( status === "success" ) {
//         $('.js-events-container').html(response);
//       }
//     });
//   }
// }

$(function() {
  addTests();
  sideNav();
  checkSideNav();
  loadHomeSlider();
  responsiveIframes();
  downArrows();
  checkHeaderPosition();
  setMainLocation();
  removeMainLocation();
  checkMainLocation();
  // loadEvents();
  // searchEvents();

  valley.supports.objectFit = Modernizr.objectfit;
  valley.supports.fontVariantLigatures = Modernizr.fontvariant;

  var doc = document.documentElement;
  doc.setAttribute('data-useragent', navigator.userAgent);
});

$(window).load(function() {
  checkNotifications();
  valley.css.loaded = true;
  valley.js.loaded = true;
});

$(window).resize(function() {
  debounce(checkSideNav(), 250);
});

$(window).scroll(function() {
  debounce(checkHeaderPosition(), 500);
});
