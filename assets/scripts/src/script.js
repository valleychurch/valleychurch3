// Global variable for storing things
var valley = {
  supports: {
    objectFit: false,
    fontVariantLigatures: false,
  },
  css: {
    loaded: false,
    fromLocalStorage: false,
    fromAsync: false,
  },
  js: {
    loaded: false,
  },
  homeSliderActive: false,
  notificationActive: false
};

var map,
    mapOpts,
    mapStyle,
    mapStyled = new google.maps.StyledMapType(mapStyle, { name: "Styled" }),
    mapCentre = new google.maps.LatLng(53.733241, -2.662240),
    mapBounds,
    mapLocations,
    mapInfoWindow,
    mapMarker;

mapStyle = [
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
];

function centreMap() {
  google.maps.event.trigger(map, 'resize');
  map.setCenter(mapCentre);
  map.fitBounds(mapBounds);
}


// Load Typekit
try{Typekit.load({ async: true });}catch(e){}


// Obligatory debounce function
function debounce(func, wait, immediate) {
  var result;
  var timeout = null;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) result = func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) result = func.apply(context, args);
    return result;
  };
};

// Attaches events to allow notification functionality to work
function checkNotifications() {
  try {
    var notificationData = JSON.parse( localStorage.getItem( 'VCNotification' ) );
    if ( notificationData !== null ) {
      if ($('.c-notification').attr('id') !== notificationData.id) {
        localStorage.removeItem( 'VCNotification' );
        attachNotifications();
      }
    }
    else {
      attachNotifications();
    }
  }
  catch( e ) { }
};

// Attach the event for the click
function attachNotifications() {
  $('.c-notification')
    //.slideDown()
    .addClass('is-notification-active')
    .attr('aria-expanded', 'true');
  valley.notificationActive = true;

  $('.js-notification-dismiss').on('click', function(e) {
    e.preventDefault();
    $('.c-notification')
      .attr('aria-expanded', 'false')
      .removeClass('is-notification-active');

    var notificationDataToSet = {
      id: $('.c-notification').attr('id'),
      hide: true,
    };
    localStorage.setItem( 'VCNotification', JSON.stringify( notificationDataToSet ) );
    valley.notificationActive = false;
  });
};

function addTests() {
  Modernizr.addTest('objectfit', function() {
    return !!('objectFit' in document.documentElement.style);
  });

  Modernizr.addTest('fontvariant', function() {
    var fontVariantLigatures = !!('fontVariantLigatures' in document.body.style);
    var fontFeatureSettings = !!('fontFeatureSettings' in document.body.style);

    return !!(fontVariantLigatures || fontFeatureSettings);
  });
};

// Side nav toggle
function sideNav() {
  $('.js-nav-toggle').on('click', function(e) {
    e.preventDefault();
    $('body').toggleClass('is-menu-active');
  });
};

// Check if sidenav is still showing on >60em windows
function checkSideNav() {
  if (Modernizr.mq('(min-width: 60em)')) {
    if ($('body').hasClass('is-menu-active')) {
      $('body').removeClass('is-menu-active');
    }
  }
};

function loadHomeSlider() {
  var prevImg =
    '<img src="/wp-content/themes/valleychurch3/assets/images/dist/icon-prev.svg" width="100%" height="100%" class="prev-btn" />';

  var nextImg =
    '<img src="/wp-content/themes/valleychurch3/assets/images/dist/icon-next.svg" width="100%" height="100%" class="next-btn" />';

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

$(function() {
  addTests();
  sideNav();
  checkSideNav();
  loadHomeSlider();
  valley.supports.objectFit = Modernizr.objectFit;
  valley.supports.fontVariantLigatures = Modernizr.fontvariant;
});

$(window).load(function() {
  checkNotifications();
  valley.js.loaded = true;
})

$(window).resize(function() {
  debounce(checkSideNav(), 250);
});