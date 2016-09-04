<?php 
/*
Plugin Name: Plugin Template
Description: A template to copy and make plugins from
Version:     0.1.0
Author:      The Bop
Author URI:  http://thebop.biz
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: plugin-template
*/

/*
 * Plugin Template Version: 1.0.0
 */

//Reject if accessed directly
defined( 'ABSPATH' ) || die( 'Our survey says: ... X.' );



//NOTE: REMEMBER TO REPLACE PLUGIN_TEMPLATE and plugin-template in all files

$wp_version_min_requirement = '4.4';
$php_version_min_requirement = '5.6';

/**
 * Get a path relative to the root of this plugin or relative to a given file path
 * 
 * @since 0.1.0
 * 
 * @param string $path - The path from the relative root.
 * @param bool/string $relative_file - The alternative filepath to use as the relative root.
 * @return string - The filepath.
 */
function plugin_template_plugin_path( $path = '', $relative_file = false ){
	$path = implode( DIRECTORY_SEPARATOR, explode( '/', ltrim( $path, '/' ) ) );
	$return  = '';
	if( $relative_file === false ){
		$return = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $path;
	}else{
		$return = dirname( $relative_file ) . DIRECTORY_SEPARATOR . $path;
	}
	return $return;
}

/**
 * Echos the error message when system requirements aren't met
 * 
 * @since 0.1.0
 * 
 * @return void.
 */
function _plugin_template_requirements_error(){
	global $wp_version_min_requirement, $php_version_min_requirement;
	?>
	<div class="notice notice-error">
		<p><?php printf( __( 'Error: This plugin requires WordPress v%s or higher (current: %s) and PHP v%s or higher (current: %s). You must be up to date or this plugin will only give this message and nothing more.', 'plugin-template' ), $wp_version_min_requirement, $GLOBALS['wp_version'], $php_version_min_requirement, phpversion() ); ?></p>
	</div>
	<?php
}

if ( version_compare( $GLOBALS['wp_version'], $wp_version_min_requirement, '<' ) || version_compare( phpversion(), $php_version_min_requirement, '<' ) ) {
	
	//throw error and end plugin declarations and processes.
	add_action( 'admin_notices', '_plugin_template_requirements_error' );
	
	//leave file (avoid syntax conflicts with earlier php/wp versions)
	return;
	
}else{
	
	require_once( plugin_template_plugin_path( 'plugin-keeping.php' ) );
	
	/* Let's get started! */
	require_once( plugin_template_plugin_path( 'plugin.php' ) );
	
}
