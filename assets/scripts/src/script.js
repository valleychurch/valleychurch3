// Global variable for storing things
var VC = {
  siteActive: false,
  supports: {
    objectFit: false,
    fontVariantLigatures: false,
  }
};


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
    var notificationData = JSON.parse( localStorage.getItem( 'notification' ) );
    if ( notificationData !== null ) {
      if ($('.c-notification').attr('id') !== notificationData.id) {
        localStorage.removeItem( 'notification' );
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
  $('.c-notification').show();
  $('.js-notification-dismiss').on('click', function(e) {
    e.preventDefault();
    $('.c-notification').slideUp(function() {
      var notificationDataToSet = {
        id: $(this).attr('id'),
        hide: true,
      };
      localStorage.setItem( 'notification', JSON.stringify( notificationDataToSet ) );
    });
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

$(function() {
  addTests();
  checkNotifications();
  VC.siteActive = true;
  VC.supports.objectFit = Modernizr.objectFit;
  VC.supports.fontVariantLigatures = Modernizr.fontvariant;
});