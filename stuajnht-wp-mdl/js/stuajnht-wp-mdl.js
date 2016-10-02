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
   *
   * These numbers have been created by trial and error, but they seem to
   * give the best option. The feature image stays solid for a bit as the
   * user scrolls down (the '1.2 -' calculation) and fades out completley
   * to show the dominant colour before the bottom of the image reaches
   * the top of the window (the '* 0.85' calculation). I have no idea what
   * the '* 0.55' part does, but it works
   *
   * See: http://stackoverflow.com/a/25424921
   */
  $(window).scroll(function(i) {
    var scrollPosition = $(window).scrollTop();
    var featureImageBottom = $(window).height() * 0.55;
    $('#feature-image').css({'opacity': (1.2 - (scrollPosition / (featureImageBottom * 0.85)))});
  });
}(jQuery));