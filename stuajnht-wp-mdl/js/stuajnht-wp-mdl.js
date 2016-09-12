(function($) {
  "use strict";

  $(document).ready(function() {
    // Setting up all background images to fade in upon load
    $('.mdl-card__title').waitForImages({
      each: function() {
        // All descendant images have loaded, now slide up.
        console.log("hi");
        $(this).fadeOut(10000);
      },
      waitForAll: true
    });
    
    // Preventing parent opacity of the card post images fading
    // any child classes: http://www.impressivewebs.com/fixing-parent-child-opacity/
    thatsNotYoChild('mdl-card__title');
  });
}(jQuery));