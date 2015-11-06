$(document).ready(function() {
  Modernizr.addTest('fontvariant', function() {
    var fontVariantLigatures = !!('fontVariantLigatures' in document.body.style);
    var fontFeatureSettings = !!('fontFeatureSettings' in document.body.style);

    return (fontVariantLigatures || fontFeatureSettings);
  });
});