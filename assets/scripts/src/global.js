// Global variable for storing things
var valley = {
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

// Run this as soon as possible for quick loading!
loadCSSFromStorage('3.0.0');

/**
 * Most of this taken from the amazing work of Patrick Hamann and The Guardian team
 * https://github.com/guardian/frontend/blob/9c071adf6a1b9238362be85210cdad05c6a53955/common/app/views/fragments/loadCss.scala.html
 */

function loadCSSFromStorage(v) {
  var c = localStorage.getItem('valley.css.' + v), s, sc;
  if(c) {
    s = document.createElement('style');
    sc = document.getElementsByTagName('script')[0];
    s.innerHTML = c;
    s.setAttribute('data-loaded-from', 'local');
    sc.parentNode.insertBefore(s, sc);
    valley.css.loaded = true;
    valley.css.fromLocalStorage = true;
    valley.css.version = v;
  }
}

function loadCSSWithAjax(c, v) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', c);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if(xhr.status === 200) {
        inlineCSS(xhr.responseText, v);
        storeCSS(xhr.responseText, v);
      };
    } else {
      // console.log("XHR readyState !== 4");
      // loadCSSWithLink(c);
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

function inlineCSS(c, v) {
  var s = document.createElement('style');
  s.innerHTML = c;
  s.setAttribute('data-loaded-from', 'ajax');
  injectElement(s);
  valley.css.loaded = true;
  valley.css.fromAsync = true;
  valley.css.version = v;
}

function storeCSS(c, v) {
  Object.keys(localStorage).some(function(key) {
    if(key.match(/^valley.css/g)) {
      localStorage.removeItem(key);
      return true;
    }
    return false;
  });
  try {
    localStorage.setItem('valley.css.' + v, c);
  }
  catch(e) {}
}