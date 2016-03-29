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


//Reject if accessed directly
defined( 'ABSPATH' ) || die( 'Our survey says: ... X.' );



//NOTE: REMEMBER TO REPLACE PLUGIN_TEMPLATE and plugin-template in all files


//Check if system is up to scratch.
function _plugin_template_requirements_error(){
	?>
	<div class="notice notice-error">
		<p><?php _e( 'Error: This plugin requires WordPress v4.4 or higher (current: ' . $GLOBALS['wp_version'] . ') and PHP v5.6 or higher (current: ' . phpversion() . '). You must be up to date or this plugin will only give this message and nothing more.', 'plugin-template' ); ?></p>
	</div>
	<?php
}

if ( version_compare( $GLOBALS['wp_version'], '4.4.0', '<' ) || version_compare( phpversion(), '5.6.0', '<' ) ) {
	
	//throw error and end plugin declarations and processes.
	add_action( 'admin_notices', '_plugin_template_requirements_error' );
	
	//leave file (avoid syntax conflicts with earlier php/wp versions)
	return;
	
}else{
	
	require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'plugin-keeping.php' );
	
	/* Let's get started! */
	require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'plugin.php' );
	
}
