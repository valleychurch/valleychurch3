$(document).ready(function() {
  Modernizr.addTest('fontvariant', function() {
    return !!('fontVariantLigatures' in document.body.style);
  })
});