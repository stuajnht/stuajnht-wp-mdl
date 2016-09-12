(function($) {
  "use strict";

  $(document).ready(function() {
    // Setting up all background images to fade in upon load
    $('.mdl-card__title').waitForImages(function() {
      // All descendant images have loaded, now slide up.
      console.log("hi");
      $(this).fadeOut(10000);
    });
  });
}(jQuery));