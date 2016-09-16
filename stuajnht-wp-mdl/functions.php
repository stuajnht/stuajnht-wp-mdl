<?php
function stuajnht_wp_mdl_scripts() {
	// MDL main script
	wp_register_script( 'material-script', 'https://code.getmdl.io/1.2.1/material.min.js', false, false, true );
	wp_enqueue_script( 'material-script' );

	// Wait for images - https://github.com/alexanderdickson/waitForImages
	// Fades in CSS background-url images when they're loaded
	wp_register_script( 'waitforimages', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.waitforimages/1.5.0/jquery.waitforimages.min.js', array ('jquery'), false, true );
	wp_enqueue_script( 'waitforimages' );

	// ThatsNotYoChild - http://www.impressivewebs.com/fixing-parent-child-opacity/
	// Preventing parent opacity of the card post images fading
	$thatsNotYoChild_script = get_template_directory_uri() . '/js/thatsNotYoChild.js';
	wp_register_script( 'ThatsNotYoChild', $thatsNotYoChild_script, false, false, true );
	wp_enqueue_script( 'ThatsNotYoChild' );

	// Adding in custom stuajnht-wp-mdl scripts
	$stuajnht_wp_mdl_script = get_template_directory_uri() . '/js/stuajnht-wp-mdl.js';
  wp_register_script( 'stuajnht-wp-mdl',  $stuajnht_wp_mdl_script, array ('jquery'), false, true);
	wp_enqueue_script( 'stuajnht-wp-mdl' );
}

add_action( 'wp_enqueue_scripts', 'stuajnht_wp_mdl_scripts' );

/**
 * Replacing the_excerpt [...] with a genuine ellipsis character
 */
function replace_excerpt_ellipsis($content) {
	return str_replace('[&hellip;]','&hellip;',$content);
}
add_filter('the_excerpt', 'replace_excerpt_ellipsis');

/**
 * Creating pagination links to show on home.php to aid in navigation
 *
 * Instead of just showing a next / previous link, show the available number
 * of pages so that the user can jump along quickly
 *
 * See: http://sgwordpress.com/teaches/how-to-add-wordpress-pagination-without-a-plugin/
 */
function pagination($pages = '', $range = 4) {  
  $showitems = ($range * 2)+1;

  global $paged;
  if (empty($paged)) $paged = 1;
    if ($pages == '') {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if(!$pages) {
        $pages = 1;
      }
    }
	
	/**
	<div class="container">
  <div class="pagination">
    <
    <span>1</span>
    <span>2</span>
    <span>3</span>
    <span>4</span>
    <span active>5</span>
    <span>6</span>
    <span>7</span>
    <span>8</span>
    <span>9</span>
  >
  </div>
</div>

<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
<form>
    <button formaction="http://stackoverflow.com">Go to stackoverflow!</button>
</form>
*/
	$buttonPrefix = '<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect pagination-item" formaction="';

  if (1 != $pages) {
    echo '<div class="pagination-container"><div class="pagination-items"><form>';

    // First and previous links
    if ($paged > 2 && $paged > $range+1 && $showitems < $pages) {
      echo $buttonPrefix.get_pagenum_link(1).'"><i class="zmdi zmdi-skip-previous"></i></button>';
    }
    if ($paged > 1 && $showitems < $pages) {
      echo $buttonPrefix.get_pagenum_link($paged - 1).'"><i class="zmdi zmdi-caret-left"></i></button>';
    }
 
    // Numbered links
    for ($i=1; $i <= $pages; $i++) {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
        if ($paged == $i) {
          echo '<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored pagination-item">'.$i."</button>";
        } else {
          echo $buttonPrefix.get_pagenum_link($i).'">'.$i."</button>";
	      }
      }
    }
 
    // Next and last links
    if ($paged < $pages && $showitems < $pages) {
      echo $buttonPrefix.get_pagenum_link($paged + 1).'"><i class="zmdi zmdi-caret-right"></i></button>';
    }
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
      echo $buttonPrefix.get_pagenum_link($pages).'"><i class="zmdi zmdi-skip-next"></i></button>';
    }

    echo '</form></div></div>';
  }
}

/**
 * Registering support for feature images (post thumbnails) for blog posts
 */
add_theme_support( 'post-thumbnails' );

/**
 * Generates a feature image to show if one has not been set, based on
 * the title of the post
 *
 * If a feature image hasn't been included with the post, to prevent an
 * empty space appearing on the website, a "placeholder" image is chosen
 * based on the first character of a MD5 hash of the post title
 *
 * @param string $postTitle The title of the post to generate the image from
 * @returns string An hexadecimal character generated from the post title
 */
function getFeatureImagePlaceholder($postTitle = "stuajnht") {
	return substr(md5($postTitle), 0, 1);
}

/**
 * Gets the dominant colour for the default feature image placeholders
 * so the background colour can be set
 *
 * A value of "d" is given as default text, as this is the first MD5
 * character for the default getFeatureImagePlaceholder parameter
 *
 * These values have been pre-calculated from the default images using
 * color thief (http://lokeshdhakar.com/projects/color-thief/). The key
 * of the array is the hex character of the placeholder image. To prevent
 * the constant construction and descruction of this array, it is created
 * and stored outside the function and passed by reference
 *
 * @param string $placeholderImageName The hexadecimal character to get
 *                                     the colour of
 * @param array $dominantColoursArray A reference to the array of the
 *                                    dominant colours of placeholder images
 * @returns string A rgb representation of the dominant colour
 */
function getFeatureImagePlaceholderColour($placeholderImageName = "d", $dominantColoursArray) {
	return $dominantColoursArray[$placeholderImageName];
}
$dominantColours = array(
  "0" => "rgb(245, 126, 6)",
  "1" => "rgb(207, 46, 44)",
  "2" => "rgb(251, 178, 223)",
  "3" => "rgb(236, 242, 44)",
  "4" => "rgb(170, 179, 224)",
  "5" => "rgb(7, 215, 80)",
  "6" => "rgb(197, 217, 88)",
	"7" => "rgb(251, 198, 40)",
	"8" => "rgb(4, 67, 65)",
	"9" => "rgb(136, 42, 168)",
	"a" => "rgb(181, 218, 163)",
	"b" => "rgb(219, 58, 55)",
	"c" => "rgb(116, 206, 248)",
	"d" => "rgb(97, 60, 177)",
	"e" => "rgb(246, 156, 33)",
	"f" => "rgb(245, 185, 57)"
);

/**
 * Registering menu locations for the theme
 *
 * The available menus for this theme are:
 *  - Footer Main Menu: Links to pages on this site
 *  - Footer Social Menu: Links to external sites you have accounts on
 */
add_action( 'init', 'stuajnht_wp_mdl_menus' );

function stuajnht_wp_mdl_menus() {
	register_nav_menus(
		array(
			'footer-main-menu' => __( 'Footer Main Menu' ),
			'footer-social-menu' => __( 'Footer Social Menu' ),
		)
	);
}

/**
 * Creating a custom menu walker class, so that the footer social
 * menu can have icons for the links
 *
 * This is based on the Walder_Nav_Menu class in the wp-includes
 * folder, but modified to create custom social icons, using Material
 * Design Iconic Font social icons, instead of the name of the link
 *
 * See: http://stackoverflow.com/a/12251157
 */
class stuajnht_wp_mdl_walker_nav_footer_social_Menu extends Walker_Nav_Menu {
  function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param array  $args  An array of arguments.
		 * @param object $item  Menu item data object.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * The social icon buttons need to have a class of mdl-mini-footer__social-btn
		 */
		$class_names = ' class="mdl-mini-footer__social-btn"';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<button' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of wp_nav_menu() arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title, and creates a social icon from the name
		 *
		 * @since 4.4.0
		 *
		 * @param string icon The menu item's icon.
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of wp_nav_menu() arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$icon = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
		$icon = '<i class="mdl-mini-footer__social-btn-icon zmdi zmdi-hc-3x zmdi-' . strtolower($icon) . '"></i>';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $icon . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</button>\n";
  }
}