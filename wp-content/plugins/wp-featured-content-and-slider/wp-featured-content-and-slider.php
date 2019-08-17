<?php
/**
 * Plugin Name: WP Featured Content and Slider
 * Plugin URI: https://www.wponlinesupport.com/plugins/
 * Text Domain: wp-featured-content-and-slider
 * Domain Path: /languages/
 * Description: Easy to add and display what features your company, product or service offers, using our shortcode OR template code. Also work with Gutenberg shortcode block.
 * Author: WP OnlineSupport
 * Version: 1.3.3
 * Author URI: https://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author WP OnlineSupport
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( !defined( 'WPFCAS_VERSION' ) ) {
	define( 'WPFCAS_VERSION', '1.3.3' ); // Version of plugin
}
if( !defined( 'WPFCAS_DIR' ) ) {
	define( 'WPFCAS_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPFCAS_URL' ) ) {
	define( 'WPFCAS_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPFCAS_POST_TYPE' ) ) {
	define( 'WPFCAS_POST_TYPE', 'featured_post' ); // Plugin post type
}
if( !defined( 'WPFCAS_CAT' ) ) {
	define( 'WPFCAS_CAT', 'wpfcas-category' ); // Plugin category
}

add_action('plugins_loaded', 'wp_wpfcas_load_textdomain');
function wp_wpfcas_load_textdomain() {
	load_plugin_textdomain( 'wp-featured-content-and-slider', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpfcas_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpfcas_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */
function wpfcas_install() {

	// Deactivate free version
	if( is_plugin_active('wp-featured-content-and-slider-pro/wp-featured-content-and-slider.php') ) {
		add_action('update_option_active_plugins', 'wpfcas_deactivate_premium_version');
	}
}

/**
 * Deactivate free plugin
 * 
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */
function wpfcas_deactivate_premium_version() {
	deactivate_plugins('wp-featured-content-and-slider-pro/wp-featured-content-and-slider.php', true);
}

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */
function wpfcas_uninstall() {
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */
function wpfcas_admin_notice() {

	global $pagenow;

	// If PRO plugin is active and free plugin exist
	$dir                = WP_PLUGIN_DIR . '/wp-featured-content-and-slider-pro/wp-featured-content-and-slider.php';
	$notice_link        = add_query_arg( array('message' => 'wpfcas-plugin-notice'), admin_url('plugins.php') );
	$notice_transient   = get_transient( 'wpfcas_install_notice' );

	if ( $notice_transient == false &&  $pagenow == 'plugins.php' && file_exists($dir) && current_user_can( 'install_plugins' ) ) {
		echo '<div class="updated notice" style="position:relative;">
				<p>
					<strong>'.sprintf( __('Thank you for activating %s', 'wp-featured-content-and-slider'), 'WP Featured Content and Slider').'</strong>.<br/>
					'.sprintf( __('It looks like you had PRO version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'wp-featured-content-and-slider'), '<strong>(<em>WP Featured Content and Slider PRO</em>)</strong>' ).'
				</p>
				<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
			</div>';      
	}
}
add_action( 'admin_notices', 'wpfcas_admin_notice');

/**
 * Function to get unique value number
 * 
 * @package WP Featured Content and Slider
 * @since 1.2.1
 */
function wpfcas_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

add_action( 'wp_enqueue_scripts','wpfcas_style_css' );
function wpfcas_style_css() {
	
	wp_register_style( 'wpfcas-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), WPFCAS_VERSION );
	wp_enqueue_style( 'wpfcas-font-awesome' );
	
	wp_enqueue_style( 'wpfcas_style',  WPFCAS_URL. 'assets/css/featured-content-style.css', array(), WPFCAS_VERSION );	
	wp_enqueue_style( 'wpfcas_slick_style',  WPFCAS_URL. 'assets/css/slick.css', array(), WPFCAS_VERSION);
	
		// Registring slick slider script
	if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
		wp_register_script( 'wpos-slick-jquery', WPFCAS_URL.'assets/js/slick.min.js', array('jquery'), WPFCAS_VERSION, true );		
	}
	
}

require_once( 'includes/featured-content-functions.php' );
require_once( 'templates/featured-content-template.php' );
require_once( 'templates/featured-content-slider-template.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( WPFCAS_DIR . '/includes/admin/wpfcas-how-it-work.php' );
}

//Admin Class
require_once( WPFCAS_DIR . '/includes/admin/class-wpfcas-admin.php' );

/* Plugin Wpos Analytics Data Starts */
function wpos_analytics_anl35_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'			=> 35,
							'file'			=> plugin_basename( __FILE__ ),
							'name'			=> 'WP Featured Content and Slider',
							'slug'			=> 'wp-featured-content-and-slider',
							'type'			=> 'plugin',
							'menu'			=> 'edit.php?post_type=featured_post',
							'text_domain'	=> 'wp-featured-content-and-slider',
							'promotion'		=> array(
													'bundle' => array(
															'name'	=> 'Download FREE 50+ Plugins, 10+ Themes and Dashboard Plugin',
															'desc'	=> 'Download FREE 50+ Plugins, 10+ Themes and Dashboard Plugin',
															'file'	=> 'https://www.wponlinesupport.com/latest/wpos-free-50-plugins-plus-12-themes.zip'
														)
													),
							'offers'		=> array(
													'trial_premium' => array(
														'image'	=> 'http://analytics.wponlinesupport.com/?anylc_img=35',
														'link'	=> 'http://analytics.wponlinesupport.com/?anylc_redirect=35',
														'desc'	=> 'Or start using the plugin from admin menu',
													)
												),
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl35_load();
/* Plugin Wpos Analytics Data Ends */