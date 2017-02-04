<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package ForRITZ
 * @subpackage Two
 * @since ForRITZ Theme 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php 
		wp_title( '|', true, 'right' ); 
		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description )echo " | $site_description";
	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body id="site" <?php body_class(); ?>>
	<div id="page" class="container site">
		<header id="masthead" class="site-header" role="banner">
			<hgroup>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php
				/** Loading WordPress Custom Menu  **/
				wp_nav_menu( array(
					'menu'            => 'main-menu',
					'container' => false,
					'menu_class'      => 'nav nav-tabs',
					'fallback_cb'     => '',
					'menu_id' => 'main-menu',
					'walker' => new The_Bootstrap_Nav_Walker()
					) ); ?>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->

		<div id="main" class="container-fluid wrapper">
			<div class="row-fluid">