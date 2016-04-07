<?php 

//Reject if accessed directly
defined( 'BOP_PLUGIN_UPDATING' ) || die( 'Our survey says: ... X.' );

//Update (or install) script

//DB
global $wpdb;

//Guide: https://codex.wordpress.org/Creating_Tables_with_Plugins
//Check https://core.trac.wordpress.org/browser/trunk/src/wp-admin/includes/schema.php#L0 for example sql

/*
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE {$wpdb->PLUGIN_TEMPLATE_TABLE} (
		meta_id bigint(20) unsigned NOT NULL auto_increment,
		term_id bigint(20) unsigned NOT NULL default '0',
		meta_key varchar(255) default NULL,
		meta_value longtext,
		PRIMARY KEY  (meta_id),
		KEY term_id (term_id),
		KEY meta_key (meta_key($max_index_length))
	) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

unset( $sql, $charset_collate );
*/

//WP Cron

/*
$args = array();

if( wp_next_scheduled( 'my_old_hook', $args );

$args = array();

wp_schedule_event( time(), 'hourly', 'my_schedule_hook', $args );

unset( $args );
*/
