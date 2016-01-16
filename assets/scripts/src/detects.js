function loadCSSFromStorage() {
  var c = localStorage.getItem('valley.css'), s, sc;
  if(c) {
    s = document.createElement('style');
    sc = document.getElementsByTagName('script')[0];
    s.innerHTML = c;
    s.setAttribute('data-loaded-from', 'local');
    sc.parentNode.insertBefore(s, sc);
    valley.css.loaded = true;
    valley.css.fromLocalStorage = true;
  }
}

function injectElement(e) {
  var sc = document.getElementsByTagName('script')[0];
  sc.parentNode.insertBefore(e, sc);
}

function inlineCss(c) {
  var s = document.createElement('style');
  s.innerHTML = c;
  s.setAttribute('data-loaded-from', 'ajax');
  injectElement(s)
}

function storeCSS(c) {
  Object.keys(localStorage).some(function(key) {
    if(key.match(/^valley.css/g)) {
      localStorage.remove(key);
      return true;
    }
    return false;
  });
  try {
    localStorage.setItem('valley.css', c);
  }
  catch(e) {}
}