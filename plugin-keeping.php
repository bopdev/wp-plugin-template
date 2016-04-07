<?php 

//Reject if accessed directly
defined( 'ABSPATH' ) || die( 'Our survey says: ... X.' );


//Name any additional tables in the database (take care with multisite)
/*
global $wpdb;
$wpdb->PLUGIN_TEMPLATE_TABLE = $wpdb->prefix . 'PLUGIN_TEMPLATE_TABLE';
*/


/* Activation hook 
 * 
 * Uses the database to determine the version number and checks against
 * the current code version number. It then runs through all outstanding
 * update scripts in order of version number. If this is a fresh
 * install, it will run through all the update scripts (consider the
 * first update script as an install script).
 */
register_activation_hook( plugin_template_plugin_path( 'init.php' ), function(){
	
	define( 'BOP_PLUGIN_ACTIVATING', true );
	
	$db_version = get_site_option( 'PLUGIN_TEMPLATE_version', '0.0.0', false );
	$pd = get_plugin_data( plugin_template_plugin_path( 'init.php' ), false, false );
	
	if( version_compare( $db_version, $pd['Version'], '<' ) ){
		
		if( $handle = opendir( plugin_template_plugin_path( 'updates' ) ) ){
			
			$updates = array();
			
			while( false !== ( $entry = readdir( $handle ) ) ){
				if( $entry != '.' && $entry != '..' ) {
					if( version_compare( $db_version, $entry, '<' ) ){
						$updates[] = $entry;
					}
					
				}
			}
			
			if( ! empty( $updates ) ){
				
				define( 'BOP_PLUGIN_UPDATING', true );
				
				usort( $updates, 'version_compare' );
				
				foreach( $updates as $update ){
					require_once( plugin_template_plugin_path( "updates/{$update}/update.php" ) );
				}
				
			}
			
			closedir($handle);
			
		}
		
		update_option( 'PLUGIN_TEMPLATE_version', $pd['Version'], false );
	}
} );


/** Deactivation hook
 * 
 * Runs deactivate.php
 * 
 */
register_deactivation_hook( __FILE__, function(){
	
	define( 'BOP_PLUGIN_DEACTIVATING', true );
	
	require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'deactivate.php' );
} );


/* Set up translations */
add_action( 'plugins_loaded', function(){
    load_plugin_textdomain( 'plugin-template', false, basename( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR );
} );
