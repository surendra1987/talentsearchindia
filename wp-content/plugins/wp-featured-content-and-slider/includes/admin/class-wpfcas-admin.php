<?php
/**
 * Admin Class
 *
 * Handles the admin functionality of plugin
 *
 * @package WP Featured Content and Slider
 * @since 1.2.8
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wpfcas_Admin {

	function __construct() {

		// Action to add admin menu
		add_action( 'admin_menu', array($this, 'wpfcas_register_menu'), 12 );

		// Admin Init Processes
		add_action( 'admin_init', array($this, 'wpfcas_admin_init_process') );
	}

	/**
	 * Function to add menu
	 * 
	 * @package WP Featured Content and Slider
	 * @since 1.2.8
	 */
	function wpfcas_register_menu() {
		
		// Plugin features menu
		add_submenu_page( 'edit.php?post_type='.WPFCAS_POST_TYPE, __('Upgrade to PRO - WP Featured Content and Slider', 'wp-featured-content-and-slider'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'wp-featured-content-and-slider').'</span>', 'edit_posts', 'wpfcas-premium', array($this, 'wpfcas_premium_page') );
		
		// Hire Us menu
		add_submenu_page( 'edit.php?post_type='.WPFCAS_POST_TYPE, __('Hire Us', 'wp-featured-content-and-slider'), '<span style="color:#2ECC71">'.__('Hire Us', 'wp-featured-content-and-slider').'</span>', 'edit_posts', 'wpfcas-hireus', array($this, 'wpfcas_hireus_page') );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package WP Featured Content and Slider
	 * @since 1.2.8
	 */
	function wpfcas_premium_page() {
		include_once( WPFCAS_DIR . '/includes/admin/settings/premium.php' );		
	}

	/**
	 * Hire Us Page Html
	 * 
	 * @package WP Featured Content and Slider
	 * @since 1.2.8
	 */
	function wpfcas_hireus_page() {
		include_once( WPFCAS_DIR . '/includes/admin/settings/hire-us.php' );
	}

	/**
	 * Function to notification transient
	 * 
	 * @package WP Featured Content and Slider
	 * @since 1.2.8
	 */
	function wpfcas_admin_init_process() {
		// If plugin notice is dismissed
	    if( isset($_GET['message']) && $_GET['message'] == 'wpfcas-plugin-notice' ) {
	    	set_transient( 'wpfcas_install_notice', true, 604800 );
	    }
	}
}

$wpfcas_Admin = new Wpfcas_Admin();