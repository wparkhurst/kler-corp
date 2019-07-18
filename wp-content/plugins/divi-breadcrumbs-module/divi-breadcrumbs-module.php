<?php
/*
Plugin Name: Divi Breadcrumbs Module
Plugin URI:  https://divibreadcrumbs.com/
Description: This plugin adds a Divi Builder Module which generates breadcrumb navigation menus. Each breadcrumb nav is highly customizable to suit every style imaginable.
Version:     2.0.0
Author:      CODECRATER
Author URI:  https://divicake.com/author/codecrater/
Text Domain: dcsbcm_Divi_Breadcrumbs_Module
Domain Path: /languages
*/


if ( ! function_exists( 'mfe_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 2.0.0
 */
function mfe_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/DiviBreadcrumbsModule.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';
}
add_action( 'divi_extensions_init', 'mfe_initialize_extension' );
endif;