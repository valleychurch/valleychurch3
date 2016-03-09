/**
 * Global variable for storing bits of information and resuables
 */
var valley = {
  version: '3.0.4',
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
            //storeCSS(xhr.responseText, valley.version);
          }
        };
      }
    }
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
