<?php

/**
 * This file provides the navigation bar for the website. It is
 * written as a separate file, and not in the header.php file,
 * as subtle differences need to take place in the navbar depending
 * on what site page it is used. Some examples of changes are:
 *  - single.php: Navbar will cover the feature image
 *  - home.php: Navbar will be above the blogroll 
 *
 * These changes that are needed are set via options before this
 * file is called on the template pages. These options are set in
 * an array (navbarOptions) that is then called by various functions
 * in this file. A list of these options are below:
 *  - coverFeatureImage bool:
 *        If a class should be appended to the header tag to overlay
 *        the feature image on post (single.php) pages
 */

/**
 * Adding additional classes to the navigation bar header tag
 *
 * Based on the options that are set in the navbarOptions array,
 * the classes created for the header tag are added or removed
 *
 * @param $navbarOptions array The options that have been set for the navbar
 * @return string A list of classes that are to be set in the header tag
 */
function headerTagOptions($navbarOptions) {
	$headerTagClasses = '';

	if (array_key_exists('coverFeatureImage', $navbarOptions) && $navbarOptions['coverFeatureImage']) {
		$headerTagClasses .= ' mdl-layout__header--transparent mdl-layout__header--seamed mdl-layout__header--cover-feature-image';
	}

	return $headerTagClasses;
}

?>
	<!-- Start navigation bar -->
	<div class="mdl-layout mdl-js-layout mdl-layout--no-desktop-drawer-button">
		<header class="mdl-layout__header mdl-layout__header--scroll <?php echo headerTagOptions($navbarOptions); ?>">
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<span class="mdl-layout-title">Title</span>
				<!-- Add spacer, to align navigation to the right -->
				<div class="mdl-layout-spacer"></div>
				<!-- Navigation -->
				<nav class="mdl-navigation">
					<a class="mdl-navigation__link" href="">Link</a>
					<a class="mdl-navigation__link" href="">Link</a>
					<a class="mdl-navigation__link" href="">Link</a>
					<a class="mdl-navigation__link" href="">Link</a>
				</nav>
			</div>
		</header>
		<div class="mdl-layout__drawer">
			<span class="mdl-layout-title">Title</span>
			<nav class="mdl-navigation">
				<a class="mdl-navigation__link" href="">Link</a>
				<a class="mdl-navigation__link" href="">Link</a>
				<a class="mdl-navigation__link" href="">Link</a>
				<a class="mdl-navigation__link" href="">Link</a>
			</nav>
		</div>