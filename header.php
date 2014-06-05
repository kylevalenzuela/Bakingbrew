<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Baking Brew
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="logo">
			<div class="logo-icon"></div>
			<div class="logo-text">
				
			</div>
		</div>
		<div class="search">
			<?php get_search_form(); ?>
		</div>

		<nav id="nav" class="navigation" role="navigation">
			<?php wp_nav_menu(array(
				'menu'=>'main nav',
				'link_before'    => '
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	  viewBox="0 0 98.004 100" enable-background="new 0 0 98.004 100" class="wheatstock" xml:space="preserve">
<path d="M45.248,97.137l-1.357-13.664c0-1.257,1.602-0.144,3.623-0.144l0,0c2.005,0,3.626-1.113,3.626,0.144l0,0l-1.136,13.326
	C50.004,99.709,45.248,98.523,45.248,97.137z"/>
<path class="wheat-rotate" d="M39.431,52.654c-9.954-4.499-9.144-11.582-9.144-11.582c-1.256,2.5,1.416,24.309,11.79,24.309
	C46.719,65.381,50.62,57.68,39.431,52.654z"/>
<path class="wheat-rotate" d="M39.431,37.244c-9.954-4.485-9.144-11.568-9.144-11.568c-1.256,2.494,1.416,24.31,11.79,24.31
	C46.719,49.985,50.62,42.283,39.431,37.244z"/>
<path class="wheat-rotate" d="M39.431,22.297c-9.954-4.466-9.144-11.562-9.144-11.562c-1.256,2.5,1.416,24.296,11.79,24.296
	C46.719,35.031,50.62,27.349,39.431,22.297z"/>
<path class="wheat-rotate-r" d="M53.233,65.381c10.374,0,13.033-21.809,11.79-24.309c0,0,0.804,7.083-9.155,11.582
	C44.691,57.68,48.579,65.381,53.233,65.381z"/>
<path class="wheat-rotate" d="M39.431,68.434c-9.954-4.498-9.144-11.58-9.144-11.58c-1.256,2.5,1.416,24.309,11.79,24.309
	C46.719,81.162,50.62,73.46,39.431,68.434z"/>
<path  class="wheat-rotate-r" d="M53.233,81.162c10.374,0,13.033-21.809,11.79-24.309c0,0,0.804,7.082-9.155,11.58C44.691,73.46,48.579,81.162,53.233,81.162
	z"/>
<path class="wheat-rotate-r" d="M53.233,49.985c10.374,0,13.033-21.815,11.79-24.31c0,0,0.804,7.083-9.155,11.568
	C44.691,42.283,48.579,49.985,53.233,49.985z"/>
<path class="wheat-rotate-r" d="M53.233,35.031c10.374,0,13.033-21.796,11.79-24.296c0,0,0.804,7.096-9.155,11.562
	C44.691,27.349,48.579,35.031,53.233,35.031z"/>
<path d="M48.375,23.462C59.381,23.462,47.771,0,47.771,0C46.371,2.207,37.374,23.462,48.375,23.462z"/>
</svg><h4 class="nav-text">
',
				'link_after'    => '</h4>
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	  viewBox="0 0 98.004 100" enable-background="new 0 0 98.004 100" class="wheatstock" xml:space="preserve">
<path d="M45.248,97.137l-1.357-13.664c0-1.257,1.602-0.144,3.623-0.144l0,0c2.005,0,3.626-1.113,3.626,0.144l0,0l-1.136,13.326
	C50.004,99.709,45.248,98.523,45.248,97.137z"/>
<path class="wheat-rotate" d="M39.431,52.654c-9.954-4.499-9.144-11.582-9.144-11.582c-1.256,2.5,1.416,24.309,11.79,24.309
	C46.719,65.381,50.62,57.68,39.431,52.654z"/>
<path class="wheat-rotate" d="M39.431,37.244c-9.954-4.485-9.144-11.568-9.144-11.568c-1.256,2.494,1.416,24.31,11.79,24.31
	C46.719,49.985,50.62,42.283,39.431,37.244z"/>
<path class="wheat-rotate" d="M39.431,22.297c-9.954-4.466-9.144-11.562-9.144-11.562c-1.256,2.5,1.416,24.296,11.79,24.296
	C46.719,35.031,50.62,27.349,39.431,22.297z"/>
<path class="wheat-rotate-r" d="M53.233,65.381c10.374,0,13.033-21.809,11.79-24.309c0,0,0.804,7.083-9.155,11.582
	C44.691,57.68,48.579,65.381,53.233,65.381z"/>
<path class="wheat-rotate" d="M39.431,68.434c-9.954-4.498-9.144-11.58-9.144-11.58c-1.256,2.5,1.416,24.309,11.79,24.309
	C46.719,81.162,50.62,73.46,39.431,68.434z"/>
<path  class="wheat-rotate-r" d="M53.233,81.162c10.374,0,13.033-21.809,11.79-24.309c0,0,0.804,7.082-9.155,11.58C44.691,73.46,48.579,81.162,53.233,81.162
	z"/>
<path class="wheat-rotate-r" d="M53.233,49.985c10.374,0,13.033-21.815,11.79-24.31c0,0,0.804,7.083-9.155,11.568
	C44.691,42.283,48.579,49.985,53.233,49.985z"/>
<path class="wheat-rotate-r" d="M53.233,35.031c10.374,0,13.033-21.796,11.79-24.296c0,0,0.804,7.096-9.155,11.562
	C44.691,27.349,48.579,35.031,53.233,35.031z"/>
<path d="M48.375,23.462C59.381,23.462,47.771,0,47.771,0C46.371,2.207,37.374,23.462,48.375,23.462z"/>
</svg>
'
			)); ?>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="page-wrap">
