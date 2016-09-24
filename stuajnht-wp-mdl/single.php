<?php get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<div class="single-post__feature-image__container">
  <div class="single-banner__feature-image" <?php
    // Setting the background colour to the the dominant colour
    // of the post image, so there is something to show while
    // the image itself loads
    if (has_post_thumbnail()) {
      // Before we attempt to get a dominant colour, make sure that
      // the Dominant_Colors_Lazy_Loading plugin is active
      if (class_exists( 'Dominant_Colors_Lazy_Loading')) {
        echo " style=\"background-color: #"
             . get_post_meta( get_post_thumbnail_id(), 'dominant_color', true )
             . ';" ';
      }
    } else {
      // There isn't a feature image for this post, so get the dominant
      // colour of the "placeholder" image. The image chosen is based on the
      // first character of a MD5 hash of the post title
      echo " style=\"background-color: "
           . getFeatureImagePlaceholderColour(getFeatureImagePlaceholder(the_title('', '', false)), $dominantColours)
           . ';" ';
    }
    ?>>
  </div>
</div>

<?php
endwhile; endif;

get_footer(); ?>