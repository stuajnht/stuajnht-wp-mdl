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
  <div id="feature-image" class="single-banner__feature-image"<?php
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
  <div class="mdl-grid single-banner__feature-image">
    <div class="single-banner__feature-image__title-container">
      <div class="single-banner__feature-image__title-background"></div>
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <div class="mdl-cell mdl-cell--8-col single-banner__feature-image__title-text">
          <h2><?php the_title(); ?></h2>
        </div>
        <div class="mdl-cell mdl-cell--4-col mdl-cell--hide-tablet mdl-cell--hide-phone single-banner__feature-image__title-meta">
          <div class="mdl-grid single-banner__feature-image__title-meta__content">
            <div class="mdl-cell mdl-cell--9-col">
              <?php
              // Displaying category links
              $separator = ', ';
              $output = '';
              $categories = get_the_category();
              if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                  $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                }
              }

              // Displaying tag links
              $tags = get_the_tags();
              if ($tags) {
                foreach($tags as $tag) {
                  $output .= '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts tagged with %s', 'textdomain' ), $tag->name ) ) . '">' . esc_html( $tag->name ) . '</a>' . $separator;
                }
                $output = rtrim($output, $separator);
                echo $output . '<br>';
              } ?>
              Published: <?php the_date(get_option('date_format')); ?><br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<main class="mdl-layout__content">
  <div class="page-content">
    <div class="mdl-grid mdl-color--grey-200">
      <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
      <div class="mdl-color--white mdl-shadow--4dp mdl-color-text--grey-800 mdl-cell mdl-cell--8-col single-post__page-content">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</main>
<?php
endwhile; endif;

get_footer(); ?>