<?php get_header();

/**
 * Gets a random number for the cell width
 *
 * To size the cells on the page in a semi-random order, a cell width
 * of either 4, 5, 6, 7, 8, 12 is chosen. As the MDL uses a grid of
 * 12 columns, the random number picked has an equal (of 12 - number),
 * which is shown below:
 *   4 => 4 or 8
 *   5 => 7
 *   6 => 6
 *   7 => 5
 *   8 => 4
 *   12 (on its own row)
 *
 * To get this to work, tis function generates a random number between
 * 0 and 5 (for each item in the list above) or if $decider is passed,
 * then either 4 or 8 is returned to fix a problem where an initial
 * cell width of 4 leads to ambiguity of what could fill the remaining
 * row space
 *
 * @param bool $decider Should we generate a position for the array
 *                      or to break row ambiguity
 * @returns int The width of the 1st cell on the row
 */
function getCellColumnWidth($decider = false) {
  if ($decider) {
    // Returns either 4 or 8, depending on a random choice
    return (rand(0, 1) ? 4 : 8);
  } else {
    // Return a number for the position of $cellColumnWidthArray
    return rand(0, 5);
  }
}
$cellColumnWidthArray = array(4, 5, 6, 7, 8, 12);
$cellColumnWidth = 0;

?>

<div class="mdl-grid">
  <?php if (have_posts()) : while (have_posts()) : the_post();
  
  // Deciding the width of the cell
  if ($cellColumnWidth == 0) {
    // We have used up all of the available cells for the row,
    // so get a new number for the first cell
    $currentCellWidth = $cellColumnWidthArray[getCellColumnWidth()];
    $cellColumnWidth = 12 - $currentCellWidth;
  } else {
    // The first cell was 4, so choose either 4 or 8 for the
    // remaining cells on the row
    if ($cellColumnWidth == 8) {
      $currentCellWidth = getCellColumnWidth(true);
      $cellColumnWidth = $cellColumnWidth - $currentCellWidth;
    } else {
      // Set the $currentCellWidth to be whatever is left from
      // the first cell on the row
      $currentCellWidth = $cellColumnWidth;
      $cellColumnWidth = 0;
    }
  }
  
  ?>
  <!-- Cell -->
    <div id="mdl-cell--post-<?php the_id(); ?>" class="mdl-cell mdl-cell--<?php echo $currentCellWidth; ?>-col mdl-cell--4-col-phone mdl-card mdl-shadow--4dp">
      <div id="mdl-card__post__background-color-<?php the_id(); ?>" class="mdl-card__title"<?php
              // Setting the background colour to the the dominant colour
              // of the post image, so there is something to show while
              // the image itself loads
              if (has_post_thumbnail()) {
                // Before we attempt to get a dominant colour, make sure that
                // the Dominant_Colors_Lazy_Loading plugin is active
                if (class_exists('Dominant_Colors_Lazy_Loading')) {
                  echo " style=\"background-color: #"
                  . get_post_meta( get_post_thumbnail_id(), 'dominant_color', true )
                  . ';"';
                }
              } else {
                // There isn't a feature image for this post, so get the dominant
                // colour of the "placeholder" image. The image chosen is based on the
                // first character of a MD5 hash of the post title
                echo " style=\"background-color: "
                  . getFeatureImagePlaceholderColour(getFeatureImagePlaceholder(the_title('', '', false)), $dominantColours)
                  . ';"';
              }
           ?>>
      </div>
      <div id="mdl-card__post__feature-image-<?php the_id(); ?>" class="mdl-card__title mdl-card__title-overlay__feature-image"<?php
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
      <div id="mdl-card__title-post__title-text-<?php the_id(); ?>" class="mdl-card__title mdl-card__title-overlay__title-text">
        <h2 class="mdl-card__title-text"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </div>
      <div class="mdl-card__supporting-text">
        Posted on <?php the_date(get_option('date_format')); ?>
      </div>
      <div class="mdl-card__supporting-text">
        <?php the_excerpt(); ?>
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php the_permalink(); ?>">
            Read More
          </a>
      </div>
    </div>
  <!-- End Cell -->
  <?php endwhile; else : ?>
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Well, this isn't quite right&hellip;</h2>
      </div>
      <div class="mdl-card__supporting-text">
        I'm sorry. I looked everywhere I could, but there doesn't seem to be any posts. Perhaps a friendly email to the webmaster may get things rolling?
      </div>
    </div>
  <?php endif; ?>
</div>

<?php
if (function_exists('pagination')) {
  echo '<div class="mdl-grid">';
  pagination($additional_loop->max_num_pages);
  echo '</div>';
}
?>

<?php get_footer(); ?>