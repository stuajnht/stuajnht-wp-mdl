<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.blue-green.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animsition/3.5.2/css/animsition.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">

		<title><?php wp_title('|',1,'right'); ?><?php bloginfo('name'); ?></title>

		<?php wp_enqueue_script("jquery"); ?>
		<?php wp_head(); ?>
	</head>
	<body class="mdl-color--grey-100 mdl-color-text--grey-700 mdl-base animsition" data-animsition-in="fade-in" data-animsition-in-duration="1000">
		<!-- Navigation header and drawer -->
		<div class="mdl-layout mdl-js-layout mdl-layout--overlay-drawer-button">
			<!-- Header -->
			<header class="mdl-layout__header">
				<div class="mdl-layout-icon"></div>
				<div class="mdl-layout__header-row">
					<!-- Blog title -->
					<span class="mdl-layout-title"><?php bloginfo('name'); ?></span>
					<!-- Add spacer, to align navigation to the right -->
					<div class="mdl-layout-spacer"></div>
					<!-- Navigation links -->
					<nav class="mdl-navigation">
						<!-- WP generated links -->
						<?php
							$pages = get_pages(array('parent' => 0, 'hierarchical' => 0));
							foreach ($pages as $page) {
								echo '<a class="mdl-navigation__link" href="'.get_page_link( $page->ID ).'">'.$page->post_title.'</a>';
							}
						?>
						<!-- End WP generated links -->
					</nav>
				</div>
			</header>
			<!-- End header -->
			<!-- Drawer -->
			<div class="mdl-layout__drawer">
				<span class="mdl-layout-title"><?php bloginfo('name'); ?></span>
				<!-- Navigation links -->
				<nav class="mdl-navigation">
					<!-- WP generated links -->
					<?php
						$pages = get_pages(array('parent' => 0, 'hierarchical' => 0));
						foreach ($pages as $page) {
							echo '<a class="mdl-navigation__link" href="'.get_page_link( $page->ID ).'">'.$page->post_title.'</a>';
						}
					?>
					<!-- End WP generated links -->
				</nav>
			</div>
			<!-- End drawer -->
			<!-- End navigation header and drawer -->