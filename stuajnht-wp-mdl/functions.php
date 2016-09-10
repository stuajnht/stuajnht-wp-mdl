<?php
function stuajnht_wp_mdl_scripts() {
	// MDL main script
	wp_register_script( 'material-script', 'https://code.getmdl.io/1.2.1/material.min.js', false, false, true );
	wp_enqueue_script( 'material-script' );
}

add_action( 'wp_enqueue_scripts', 'stuajnht_wp_mdl_scripts' );

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