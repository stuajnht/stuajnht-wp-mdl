(function($) {
  "use strict";

  $(document).ready(function() {
    // Setting up all background images to fade in upon load
    $('.mdl-card__title').waitForImages({
      each: function() {
        // All descendant images have loaded, now fade in
        $(this).hide().fadeIn(1000);
      },
      waitForAll: true
    });

    // Preventing parent opacity of the card post images fading
    // any child classes: http://www.impressivewebs.com/fixing-parent-child-opacity/
    $('.mdl-card__title').each(function() {
      //thatsNotYoChild(this.id);
    });
  });
  
  /**
   * Fading the feature image on posts and pages when the page is
   * scrolled down
   * See: http://stackoverflow.com/a/25424921
   */
  $(window).scroll(function(i) {
    var scrollPosition = $(window).scrollTop();
    var featureImageBottom = $(window).height() * 0.55;
    // If the WordPress admin bar is in place, we need to add that to the
    // scroll position so the image remains centered. We also need to double
    // the height of the bar, as the number is halved later on
    var wpadminbarHeight = 0;
    if ($("#wpadminbar").length > 0) {
      wpadminbarHeight = ($("#wpadminbar").height() * 2);
    }
    //$('#feature-image').css({'top': .5 * (scrollPosition + wpadminbarHeight)});
    $('#feature-image').css({'opacity': ((featureImageBottom * 0.8) - scrollPosition) / 100});
  });
}(jQuery));