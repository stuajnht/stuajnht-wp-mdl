<?php get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<div class="single-post__feature-image__container">
  <div class="single-banner__feature-image"<?php
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
  <div class="single-banner__feature-image"<?php
    // Setting the card post image to that of the blog post
    if (has_post_thumbnail()) {
      // Note: This seems hacky. The "the_post_thumbnail_url()" always seems to
      //       echo out the output, so can't be saved into a variable. Creating
      //       the background-image url around it is the only way to get it to work
      echo " style=\"background-image: url('";
        the_post_thumbnail_url();
      echo "');\"";
    } else {
      // A feature image hasn't been included in the post, so to avoid
      // the cards looking a bit weird / empty, include a "placeholder"
      // image included in this theme. The image chosen is based on the
      // first character of a MD5 hash of the post title
      echo " style=\"background-image: url('"
        . get_template_directory_uri() . '/images/post-thumbnails/'. getFeatureImagePlaceholder(the_title('', '', false)) . '.jpg'
        . "');\"";
    }
    ?>>
  </div>
</div>

<?php
endwhile; endif;

get_footer(); ?>