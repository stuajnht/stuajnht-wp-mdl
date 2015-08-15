<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.2/material.blue-green.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">

		<title><?php wp_title('|',1,'right'); ?><?php bloginfo('name'); ?></title>

		<?php wp_enqueue_script("jquery"); ?>
		<?php wp_head(); ?>
	</head>
	<body class="mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
		