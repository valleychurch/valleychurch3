"use strict";
/**
 * Global variable for storing bits of information and resuables
 */
var valley = {
  version: '3.1.2',
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

function centreMap() {
  google.maps.event.trigger(map, 'resize');
  map.setCenter(mapCentre);
  map.fitBounds(mapBounds);
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
    mapMarker;

mapStyle = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];


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
    $(el).wrap('<div class="o-ratio"/>');
  });
}

$(function() {
  addTests();
  sideNav();
  checkSideNav();
  loadHomeSlider();
  responsiveIframes();
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
