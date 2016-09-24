<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title><?php wp_title('|',1,'right'); ?><?php bloginfo('name'); ?></title>

    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.teal-indigo.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,light,bolditalic&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">

		<?php wp_enqueue_script('jquery'); ?>
		<?php wp_head(); ?>
  </head>
  <body>
	
	<main class="mdl-layout__content">
    <!--<div class="page-content">-->
    <!-- Start main content -->