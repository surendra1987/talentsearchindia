<?php
/*
  Plugin Name: Flipbox - Awesomes Flip Boxes Image Overlay
  Plugin URI: https://www.oxilab.org/downloads/flipbox-image-overlay/
  Description: Flipbox - Awesomes Flip Boxes Image Overlay is the most easiest Flip builder Plugin. Create multiple Flip or  Flipboxes  with this.
  Author: Biplob Adhikari
  Author URI: http://www.oxilab.org/
  Version: 2.1
 */
if (!defined('ABSPATH'))
    exit;

$oxilab_flip_box_version = '2.1';
define('oxilab_flip_box_url', plugin_dir_path(__FILE__));
define('OXILAB_FLIP_BOX_HOME', 'https://www.oxilab.org'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
define('OXILAB_FLIP_BOX', 'Flipbox - Image Overlay'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
// the name of the settings page for the license input to be displayed
define('OXILAB_FLIP_BOX_LICENSE_PAGE', 'oxilab-flip-box-license');
define('oxilab_flip_type', 'flip');

include oxilab_flip_box_url . 'public.php';
add_shortcode('oxilab_flip_box', 'oxilab_flip_box_shortcode');

function oxilab_flip_box_shortcode($atts) {
    extract(shortcode_atts(array('id' => ' ',), $atts));
    $styleid = $atts['id'];
    ob_start();
    oxilab_flip_box_shortcode_function($styleid, 'user');
    return ob_get_clean();
}

add_action('vc_before_init', 'oxilab_flip_box_VC_extension');
add_shortcode('oxilab_flip_box_VC', 'oxilab_flip_box_VC_shortcode');

function oxilab_flip_box_VC_shortcode($atts) {
    extract(shortcode_atts(array(
        'id' => ''
                    ), $atts));
    $styleid = $atts['id'];
    ob_start();
    oxilab_flip_box_shortcode_function($styleid, 'user');
    return ob_get_clean();
}

function oxilab_flip_box_VC_extension() {
    vc_map(array(
        "name" => __("Flip Boxes and Image Overlay"),
        "base" => "oxilab_flip_box_VC",
        "category" => __("Content"),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("ID"),
                "param_name" => "id",
                "description" => __("Input your Flip ID in input box")
            ),
        )
    ));
}

add_action('admin_menu', 'oxilab_flip_box_menu');

function oxilab_flip_box_user_capabilities() {
    $user_role = get_option('oxi_addons_user_permission');
    $role_object = get_role($user_role);
    $first_key = '';
    if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
        reset($role_object->capabilities);
        $first_key = key($role_object->capabilities);
    } else {
        $first_key = 'manage_options';
    }
    if (!current_user_can($first_key)) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
}

function oxilab_flip_box_menu() {
    $user_role = get_option('oxi_addons_user_permission');
    $role_object = get_role($user_role);
    $first_key = '';
    if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
        reset($role_object->capabilities);
        $first_key = key($role_object->capabilities);
    } else {
        $first_key = 'manage_options';
    }
    add_menu_page('Flip Box', 'Flip Box', $first_key, 'oxilab-flip-box-admin', 'oxilab_flip_box_home');
    add_submenu_page('oxilab-flip-box-admin', 'FLip Box ', 'FLip Box', $first_key, 'oxilab-flip-box-admin', 'oxilab_flip_box_home');
    add_submenu_page('oxilab-flip-box-admin', 'Create New', 'Create New', $first_key, 'oxilab-flip-box-admin-new', 'oxilab_flip_box_new');
    add_submenu_page('oxilab-flip-box-admin', 'Settings', 'Settings', 'manage_options', OXILAB_FLIP_BOX_LICENSE_PAGE, 'oxilab_flip_box_license_page');
    add_submenu_page('oxilab-flip-box-admin', 'Import Templates', 'Import Templates', $first_key, 'oxilab-flip-box-admin-import', 'oxilab_flip_box_import');
    add_submenu_page('oxilab-flip-box-admin', 'Shortcode Addons', 'Shortcode Addons', $first_key, 'oxilab-flip-box-admin-addons', 'oxilab_flip_box_addons');
}

function oxilab_flip_box_addons() {
    oxilab_flip_box_home_admin_style();
    wp_enqueue_style('Open+Sans', 'https://fonts.googleapis.com/css?family=Open+Sans');
    include oxilab_flip_box_url . 'admin/shortcode-addons.php';
}

function oxilab_flip_box_home() {
    oxilab_flip_box_home_admin_style();
    add_action('admin_enqueue_scripts', 'oxilab_flip_box_home_admin_style');
    include oxilab_flip_box_url . 'home.php';
}

function oxilab_flip_box_home_admin_style() {
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    wp_enqueue_script('oxilab-bootstrap-js', plugins_url('helper/bootstrap.min.js', __FILE__));
    wp_enqueue_style('oxilab-bootstrap', plugins_url('helper/bootstrap.min.css', __FILE__));
    wp_enqueue_style('oxilab-style', plugins_url('helper/admin.css', __FILE__));
    $jquery = 'jQuery(".iheu-admin-side-menu li:eq(0) a").addClass("active");';
    wp_add_inline_script('oxilab-bootstrap-js', $jquery);
}

function oxilab_flip_box_new() {
    oxilab_flip_box_new_admin_style();
    add_action('admin_enqueue_scripts', 'oxilab_flip_box_new_admin_style');
    if (!empty($_GET['styleid']) && is_numeric($_GET['styleid'])) {
        $id = $_GET['styleid'];
        global $wpdb;
        $table_name = $wpdb->prefix . 'oxi_div_style';
        $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d AND type = %s ", $id, oxilab_flip_type), ARRAY_A);
        if (empty($styledata)) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        oxilab_flip_box_media_scripts();
        wp_enqueue_script('oxilab-' . $styledata['style_name'] . '', plugins_url('jquery/' . $styledata['style_name'] . '.js', __FILE__));
        include oxilab_flip_box_url . 'helper/helper.php';
        include oxilab_flip_box_url . 'admin/' . $styledata['style_name'] . '.php';
        oxilab_flipbox_admin_drag_drop();
        add_action('wp_print_scripts', 'oxilab_flipbox_admin_drag_drop');
        wp_enqueue_script('YouTubePopUps', plugins_url('helper/YouTubePopUps.js', __FILE__));
        $jquery = 'setTimeout(function () {
                                        jQuery(".oxi-addons-tutorials").grtyoutube({autoPlay: true, theme: "light"});
                                    }, 500);';
        wp_add_inline_script('YouTubePopUps', $jquery);
    } else {
        include oxilab_flip_box_url . 'layouts/index.php';
    }
    $jquery = 'jQuery(".iheu-admin-side-menu li:eq(1) a").addClass("active");';
    wp_add_inline_script('oxilab-bootstrap', $jquery);
}

function oxilab_flipbox_admin_drag_drop() {
    wp_enqueue_script('oxilab_flipbox-drap-drop', plugins_url('helper/drag-drop.js', __FILE__));
    wp_localize_script('oxilab_flipbox-drap-drop', 'oxilab_flipbox_drag_drop_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}

function oxilab_flip_box_new_admin_style() {
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    wp_enqueue_style('Open+Sans', 'https://fonts.googleapis.com/css?family=Open+Sans');
    wp_enqueue_style('oxilab-admin', plugins_url('helper/admin.css', __FILE__));
    wp_enqueue_style('oxilab-bootstrap', plugins_url('helper/bootstrap.min.css', __FILE__));
    wp_enqueue_style('oxilab-flip-box', plugins_url('public/style.css', __FILE__));
    wp_enqueue_script('jquery');
    wp_enqueue_script('oxilab-bootstrap', plugins_url('helper/bootstrap.min.js', __FILE__));
    wp_enqueue_script('oxilab-font-select', plugins_url('helper/font-select.js', __FILE__));
    wp_enqueue_script('oxilab-color', plugins_url('helper/minicolors.js', __FILE__));
    wp_enqueue_style('oxilab-color', plugins_url('helper/minicolors.css', __FILE__));
    wp_enqueue_style('animation', plugins_url('public/animation.css', __FILE__));
    wp_enqueue_script('oxilab-animation', plugins_url('public/animation.js', __FILE__));
    wp_enqueue_script('jquery.bootstrap-growl', plugins_url('helper/jquery.bootstrap-growl.js', __FILE__));
    wp_enqueue_script('oxilab-vendor', plugins_url('helper/vendor.js', __FILE__));
}

function oxilab_flip_box_media_scripts() {
    wp_enqueue_media();
    wp_register_script('oxilab_flip_box_media_scripts', plugins_url('helper/media-uploader.js', __FILE__));
    wp_enqueue_script('oxilab_flip_box_media_scripts');
}

function oxilab_flip_box_import() {
    include oxilab_flip_box_url . 'layouts/import-style.php';
    oxilab_flip_box_import_admin_style();
    add_action('admin_enqueue_scripts', 'oxilab_flip_box_import_admin_style');
    $jquery = 'jQuery(".iheu-admin-side-menu li:eq(2) a").addClass("active");';
    wp_add_inline_script('oxilab-bootstrap', $jquery);
}

function oxilab_flip_box_import_admin_style() {
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    wp_enqueue_style('Open+Sans', 'https://fonts.googleapis.com/css?family=Open+Sans');
    wp_enqueue_style('oxilab-admin', plugins_url('helper/admin.css', __FILE__));
    wp_enqueue_style('oxilab-bootstrap', plugins_url('helper/bootstrap.min.css', __FILE__));
    wp_enqueue_style('oxi-accordions-show', plugins_url('public/style.css', __FILE__));
    wp_enqueue_script('jquery');
    wp_enqueue_script('oxilab-bootstrap', plugins_url('helper/bootstrap.min.js', __FILE__));
    wp_enqueue_style('animation', plugins_url('public/animation.css', __FILE__));
    wp_enqueue_script('oxilab-animation', plugins_url('public/animation.js', __FILE__));
}

function oxilab_flip_box_special_charecter($data) {
    $data = html_entity_decode($data);
    $data = do_shortcode($data, $ignore_html = false);
    return $data;
}

function oxilab_flip_box_admin_special_charecter($data) {
    $data = str_replace('\\\\"', '&quot;', $data);
    $data = str_replace('\\\"', '&quot;', $data);
    $data = str_replace('\\"', '&quot;', $data);
    $data = str_replace('\"', '&quot;', $data);
    $data = str_replace('"', '&quot;', $data);
    $data = str_replace('\\\\&quot;', '&quot;', $data);
    $data = str_replace('\\\&quot;', '&quot;', $data);
    $data = str_replace('\\&quot;', '&quot;', $data);
    $data = str_replace('\&quot;', '&quot;', $data);
    $data = str_replace("\\\\'", '&apos;', $data);
    $data = str_replace("\\\'", '&apos;', $data);
    $data = str_replace("\\'", '&apos;', $data);
    $data = str_replace("\'", '&apos;', $data);
    $data = str_replace("\\\\&apos;", '&apos;', $data);
    $data = str_replace("\\\&apos;", '&apos;', $data);
    $data = str_replace("\\&apos;", '&apos;', $data);
    $data = str_replace("\&apos;", '&apos;', $data);
    $data = str_replace("'", '&apos;', $data);
    $data = str_replace('<', '&lt;', $data);
    $data = str_replace('>', '&gt;', $data);
    $data = sanitize_text_field($data);
    return $data;
}

function oxilab_flip_box_font_icon($data) {
    $fadata = get_option('oxi_addons_font_awesome');
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    if ($fadata == 'yes') {
        wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    }
    $files = '<i class="' . $data . ' oxi-icons"></i>';
    return $files;
}

function oxilab_flip_box_font_familly_charecter($data) {
    wp_enqueue_style('' . $data . '', 'https://fonts.googleapis.com/css?family=' . $data . '');
    $data = str_replace('+', ' ', $data);
    $data = explode(':', $data);
    return '"' . $data[0] . '"';
}

function oxilab_flip_box_admin_image($id) {
    return WP_PLUGIN_URL . '/image-hover-effects-ultimate-visual-composer/layouts/image/' . $id;
}

function oxilab_flipbox_admin_ajax_data() {
    check_ajax_referer('oxilab_flipbox_ajax_data', 'security');
    $list_order = sanitize_text_field($_POST['list_order']);
    $list = explode(',', $list_order);
    global $wpdb;
    $table_list = $wpdb->prefix . 'oxi_div_list';
    foreach ($list as $value) {
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_list WHERE id = %d ", $value), ARRAY_A);
        $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (styleid, type, files, css) VALUES (%d, %s, %s, %s)", array($data['styleid'], $data['type'], $data['files'], $data['css'])));
        $redirect_id = $wpdb->insert_id;
        if ($redirect_id == 0) {
            die();
        }
        if ($redirect_id != 0) {
            $wpdb->query($wpdb->prepare("DELETE FROM $table_list WHERE id = %d", $value));
        }
    }
    die();
}

add_action('wp_ajax_oxilab_flipbox_admin_ajax_data', 'oxilab_flipbox_admin_ajax_data');

function oxilab_flipbox_admin_style_layouts($styledata, $listdata) {
    include_once oxilab_flip_box_url . 'public/' . $styledata['style_name'] . '.php';
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    wp_enqueue_style('oxilab-flip-box', plugins_url('public/style.css', __FILE__));
    wp_enqueue_style('animation', plugins_url('public/animation.css', __FILE__));
    wp_enqueue_script('oxilab-animation', plugins_url('public/animation.js', __FILE__));
    $stylefunctionmane = 'oxilab_flip_box_shortcode_function_' . $styledata['style_name'] . '';
    $stylefunctionmane($styledata['id'], 'user', explode('|', $styledata['css']), $listdata);
}

function oxilab_flip_box_custom_post_type_icon() {
    ?>
    <style type='text/css' media='screen'>
        #adminmenu #toplevel_page_oxilab-flip-box-admin  div.wp-menu-image:before {
            content: "\f169";
        }
    </style>
    <?php
}

add_action('admin_head', 'oxilab_flip_box_custom_post_type_icon');
register_activation_hook(__FILE__, 'oxilab_flip_box_install');

function oxilab_flip_box_install() {
    global $wpdb;
    global $oxilab_flip_box_version;

    $table_name = $wpdb->prefix . 'oxi_div_style';
    $table_list = $wpdb->prefix . 'oxi_div_list';
    $table_import = $wpdb->prefix . 'oxi_div_import';
    $charset_collate = $wpdb->get_charset_collate();
    $sql1 = "CREATE TABLE $table_name (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                type varchar(50) NOT NULL,
                style_name varchar(40) NOT NULL,
                css text,
		PRIMARY KEY  (id)
	) $charset_collate;";

    $sql2 = "CREATE TABLE $table_list (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                styleid mediumint(6) NOT NULL,
                type varchar(50),
                files text,
                css text,
		PRIMARY KEY  (id)
	) $charset_collate;";
    $sql3 = "CREATE TABLE $table_import (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                type varchar(50) NOT NULL,
                name int(5) NOT NULL,                
		PRIMARY KEY  (id),
                UNIQUE unique_index (type, name)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql1);
    dbDelta($sql2);
    dbDelta($sql3);
    add_option('oxilab_flip_box_version', $oxilab_flip_box_version);
    $fawesome = '5.3.1||https://use.fontawesome.com/releases/v5.3.1/css/all.css';
    add_option('oxi_addons_font_awesome_version', $fawesome);
    $wpdb->query("INSERT INTO {$table_import} (name, type) VALUES
        (1, 'flip'),
        (2, 'flip'),
        (3, 'flip'),
        (4, 'flip'),
        (5, 'flip')");
    set_transient('_Oxilab_flip_box_welcome_activation_redirect', true, 30);
}

add_action('admin_init', 'Oxilab_flip_box_welcome_activation_redirect');

function Oxilab_flip_box_welcome_activation_redirect() {
    if (!get_transient('_Oxilab_flip_box_welcome_activation_redirect')) {
        return;
    }
    delete_transient('_Oxilab_flip_box_welcome_activation_redirect');
    if (is_network_admin() || isset($_GET['activate-multi'])) {
        return;
    }
    wp_safe_redirect(add_query_arg(array('page' => 'oxilab-flip-box-welcome'), admin_url('index.php')));
}

add_action('admin_menu', 'Oxilab_flip_box_welcome_pages');

function Oxilab_flip_box_welcome_pages() {
    add_dashboard_page(
            'Welcome To Flipbox - Awesomes Flip Boxes Image Overlay', 'Welcome To Flipbox - Awesomes Flip Boxes Image Overlay', 'read', 'oxilab-flip-box-welcome', 'oxilab_flip_box_welcome'
    );
}

function oxilab_flip_box_welcome() {
    wp_enqueue_style('oxilab-flip-box-welcome', plugins_url('helper/admin-welcome.css', __FILE__));
    ?>
    <div class="wrap about-wrap">
        <h1>Welcome to Flipbox - Awesomes Flip Boxes Image Overlay</h1>
        <div class="about-text">
            Thank you for choosing Flipbox - Awesomes Flip Boxes Image Overlay - the most friendly WordPress Flipbox - Awesomes Flip Boxes Image Overlay Plugins. Here's how to get started.
        </div>
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active">
                Getting Started		
            </a>
        </h2>
        <div class="feature-section">
            <h3>Creating Your Flip</h3>
            <p>Flipbox - Awesomes Flip Boxes Image Overlay makes it easy to create Flip Boxes  in WordPress. You can follow the video tutorial on the right or read our how to 
                <a href="https://www.oxilab.org/docs/flip-boxes-and-image-overlay/getting-started/installing-for-the-first-time/" target="_blank" rel="noopener">Create your Flip Boxes guide</a>.					</p>
            <p>But in reality, the process is so intuitive that you can just start by going to <a href="<?php echo admin_url(); ?>admin.php?page=oxilab-flip-box-admin-new">New Flip Boxes</a>.				</p>
            </br>
            </br>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/OaLL0DNUHWA" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
        </div>
        <div class="feature-section">
            <h3>See all Flipbox - Awesomes Flip Boxes Image Overlay Features</h3>
            <p>Flipbox - Awesomes Flip Boxes Image Overlay is easy to use and extremely powerful. We have tons of helpful features that allows us to give you everything you need on Flip Boxes.</p>
            <p>1. Awesome Live Preview Panel</p>
            <p>1. Can Customize with Our Settings</p>
            <p>1. Easy to USE & Builtin Integration for popular Page Builder</p>
            <p><a href="https://www.oxilab.org/downloads/flipbox-image-overlay/" target="_blank" rel="noopener" class="iheu-image-features-button button button-primary">See all Features</a></p>
        </div>
        <div class="feature-section">
            <h3>Have any Bugs or Suggestion</h3>
            <p>Your suggestions will make this plugin even better, Even if you get any bugs on Flipbox - Awesomes Flip Boxes Image Overlay so let us to know, We will try to solved within few hours</p>
            <p><a href="https://www.oxilab.org/contact-us" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Contact Us</a>
                <a href="https://wordpress.org/plugins/image-hover-effects-ultimate-visual-composer/" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Support Forum</a></p>

        </div>
    </div>
    <?php
}

add_action('admin_head', 'oxilab_flip_box_welcome_remove_menus');

function oxilab_flip_box_welcome_remove_menus() {
    remove_submenu_page('index.php', 'oxilab-flip-box-welcome');
}

include( dirname(__FILE__) . '/Plugin_Updater.php' );

function oxilab_flip_box_plugin_updater() {
    $license_key = trim(get_option('oxilab_flip_box_license_key'));
    // retrieve our license key from the DB
    // setup the updater
    $oxilab_flip_box_updater = new OXILAB_FLIP_BOX_Plugin_Updater(OXILAB_FLIP_BOX_HOME, __FILE__, array(
        'version' => '2.1', // current version number
        'license' => $license_key, // license key (used get_option above to retrieve from DB)
        'item_name' => OXILAB_FLIP_BOX, // name of this plugin
        'author' => 'Biplob Adhikari', // author of this plugin
        'beta' => false
            )
    );
}

$status = get_option('oxilab_flip_box_license_status');
if ($status == 'valid') {
    add_action('admin_init', 'oxilab_flip_box_plugin_updater', 0);
}

/* * **********************************
 * the code below is just a standard
 * options page. Substitute with
 * your own.
 * *********************************** */

function oxilab_flip_box_license_page() {
    $license = get_option('oxilab_flip_box_license_key');
    $status = get_option('oxilab_flip_box_license_status');
    global $wp_roles;
    $roles = $wp_roles->get_names();
    $saved_role = get_option('oxi_addons_user_permission');
    $fontawvr = get_option('oxi_addons_font_awesome_version');
    $fontawesomevr = array(
        array('name' => '5.7.2', 'url' => '5.7.2||https://use.fontawesome.com/releases/v5.7.2/css/all.css'),
        array('name' => '5.7.1', 'url' => '5.7.1||https://use.fontawesome.com/releases/v5.7.1/css/all.css'),
        array('name' => '5.7.0', 'url' => '5.7.0||https://use.fontawesome.com/releases/v5.7.0/css/all.css'),
        array('name' => '5.6.3', 'url' => '5.6.3||https://use.fontawesome.com/releases/v5.6.3/css/all.css'),
        array('name' => '5.6.0', 'url' => '5.6.0||https://use.fontawesome.com/releases/v5.6.0/css/all.css'),
        array('name' => '5.5.0', 'url' => '5.5.0||https://use.fontawesome.com/releases/v5.5.0/css/all.css'),
        array('name' => '5.4.1', 'url' => '5.4.1||https://use.fontawesome.com/releases/v5.4.1/css/all.css'),
        array('name' => '5.3.1', 'url' => '5.3.1||https://use.fontawesome.com/releases/v5.3.1/css/all.css'),
        array('name' => '5.2.0', 'url' => '5.2.0||https://use.fontawesome.com/releases/v5.2.0/css/all.css'),
        array('name' => '5.1.1', 'url' => '5.1.1||https://use.fontawesome.com/releases/v5.1.1/css/all.css'),
        array('name' => '5.1.0', 'url' => '5.1.0||https://use.fontawesome.com/releases/v5.1.0/css/all.css'),
        array('name' => '5.0.13', 'url' => '5.0.13||https://use.fontawesome.com/releases/v5.0.13/css/all.css'),
        array('name' => '5.0.12', 'url' => '5.0.12||https://use.fontawesome.com/releases/v5.0.12/css/all.css'),
        array('name' => '5.0.10', 'url' => '5.0.10||https://use.fontawesome.com/releases/v5.0.10/css/all.css'),
        array('name' => '5.0.9', 'url' => '5.0.9||https://use.fontawesome.com/releases/v5.0.9/css/all.css'),
        array('name' => '5.0.8', 'url' => '5.0.8||https://use.fontawesome.com/releases/v5.0.8/css/all.css'),
        array('name' => '5.0.6', 'url' => '5.0.6||https://use.fontawesome.com/releases/v5.0.6/css/all.css'),
        array('name' => '5.0.4', 'url' => '5.0.4||https://use.fontawesome.com/releases/v5.0.4/css/all.css'),
        array('name' => '4.7.0', 'url' => '4.7.0||https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'),
    );
    ?>

    <div class="wrap">
        <?php if ($status !== false && $status == 'valid') { ?>
            <div class="updated">
                <p>Thank you to Active our Plugins. Kindly wait 2-3 minute to get update notification if you using free or older version. Once you get notification please update.</p>
            </div>
        <?php }
        ?>
        <h2><?php _e('User Settings'); ?></h2>
        <p>Settings for Responsive Tabs with Accordions.</p>
        <form method="post" action="options.php">
            <table class="form-table">
                <?php settings_fields('oxi-addons-flip-settings-group'); ?>
                <?php do_settings_sections('oxi-addons-flip-settings-group'); ?>
                <tbody>
                    <tr valign="top">
                        <td scope="row">Who Can Edit?</td>
                        <td>
                            <select name="oxi_addons_user_permission">
                                <?php foreach ($roles as $key => $role) { ?>
                                    <option value="<?php echo $key; ?>" <?php selected($saved_role, $key); ?>><?php echo $role; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <label class="description" for="oxi_addons_user_permission"><?php _e('Select the Role who can manage This Plugins.'); ?> <a target="_blank" href="https://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table">Help</a></label>
                        </td>
                    </tr>                        
                    <tr valign="top">
                        <td scope="row">Font Awesome Support</td>
                        <td>
                            <input type="radio" name="oxi_addons_font_awesome" value="yes" <?php checked('yes', get_option('oxi_addons_font_awesome'), true); ?>>YES
                            <input type="radio" name="oxi_addons_font_awesome" value="" <?php checked('', get_option('oxi_addons_font_awesome'), true); ?>>No
                        </td>
                        <td>
                            <label class="description" for="oxi_addons_font_awesome"><?php _e('Load Font Awesome CSS at shortcode loading, If your theme already loaded select No for faster loading'); ?></label>
                        </td>
                    </tr> 
                    <tr valign="top">
                        <td scope="row">Font Awesome Version?</td>
                        <td>
                            <select name="oxi_addons_font_awesome_version">
                                <?php foreach ($fontawesomevr as $value) { ?>
                                    <option value="<?php echo $value['url']; ?>" <?php selected($fontawvr, $value['url']); ?>><?php echo $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <label class="description" for="oxi_addons_font_awesome_version"><?php _e('Select Your Font Awesome version, Which are using into your sites so Its will not conflict your Icons'); ?></label>
                        </td>
                    </tr>  
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
        <br>
        <br>
        <br>
        <h2><?php _e('Product License Activation'); ?></h2>
        <p>Activate your copy to get direct plugin updates and official support.</p>
        <form method="post" action="options.php">

            <?php settings_fields('oxilab_flip_box_license'); ?>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php _e('License Key'); ?>
                        </th>
                        <td>
                            <input id="oxilab_flip_box_license_key" name="oxilab_flip_box_license_key" type="text" class="regular-text" value="<?php esc_attr_e($license); ?>" />
                            <label class="description" for="oxilab_flip_box_license_key"><?php _e('Enter your license key'); ?></label>
                        </td>
                    </tr>
                    <?php if (!empty($license)) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e('Activate License'); ?>
                            </th>
                            <td>
                                <?php if ($status !== false && $status == 'valid') { ?>
                                    <span style="color:green;"><?php _e('active'); ?></span>
                                    <?php wp_nonce_field('oxilab_flip_box_nonce', 'oxilab_flip_box_nonce'); ?>
                                    <input type="submit" class="button-secondary" name="oxilab_flip_box_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
                                    <?php
                                } else {
                                    wp_nonce_field('oxilab_flip_box_nonce', 'oxilab_flip_box_nonce');
                                    ?>
                                    <input type="submit" class="button-secondary" name="oxilab_flip_box_license_activate" value="<?php _e('Activate License'); ?>"/>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php submit_button(); ?>

        </form>
        <?php
    }

    function oxi_addons_plugin_flip_settings() {
        //register our settings
        register_setting('oxi-addons-flip-settings-group', 'oxi_addons_user_permission');
        register_setting('oxi-addons-flip-settings-group', 'oxi_addons_font_awesome');
        register_setting('oxi-addons-flip-settings-group', 'oxi_addons_font_awesome_version');
    }

    add_action('admin_init', 'oxi_addons_plugin_flip_settings');

    function oxilab_flip_box_register_option() {
        // creates our settings in the options table
        register_setting('oxilab_flip_box_license', 'oxilab_flip_box_license_key', 'oxilab_flip_box_sanitize_license');
    }

    add_action('admin_init', 'oxilab_flip_box_register_option');

    function oxilab_flip_box_sanitize_license($new) {
        $old = get_option('oxilab_flip_box_license_key');
        if ($old && $old != $new) {
            delete_option('oxilab_flip_box_license_status'); // new license has been entered, so must reactivate
        }
        return $new;
    }

    /*     * **********************************
     * this illustrates how to activate
     * a license key
     * *********************************** */

    function oxilab_flip_box_activate_license() {

        // listen for our activate button to be clicked
        if (isset($_POST['oxilab_flip_box_license_activate'])) {

            // run a quick security check
            if (!check_admin_referer('oxilab_flip_box_nonce', 'oxilab_flip_box_nonce'))
                return; // get out if we didn't click the Activate button
// retrieve the license from the database
            $license = trim(get_option('oxilab_flip_box_license_key'));
            // data to send in our API request
            $api_params = array(
                'edd_action' => 'activate_license',
                'license' => $license,
                'item_name' => urlencode(OXILAB_FLIP_BOX), // the name of our product in EDD
                'url' => home_url()
            );

            // Call the custom API.
            $response = wp_remote_post(OXILAB_FLIP_BOX_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

            // make sure the response came back okay
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

                if (is_wp_error($response)) {
                    $message = $response->get_error_message();
                } else {
                    $message = __('An error occurred, please try again.');
                }
            } else {

                $license_data = json_decode(wp_remote_retrieve_body($response));

                if (false === $license_data->success) {

                    switch ($license_data->error) {

                        case 'expired' :

                            $message = sprintf(
                                    __('Your license key expired on %s.'), date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
                            );
                            break;

                        case 'revoked' :

                            $message = __('Your license key has been disabled.');
                            break;

                        case 'missing' :

                            $message = __('Invalid license.');
                            break;

                        case 'invalid' :
                        case 'site_inactive' :

                            $message = __('Your license is not active for this URL.');
                            break;

                        case 'item_name_mismatch' :

                            $message = sprintf(__('This appears to be an invalid license key for %s.'), OXILAB_FLIP_BOX);
                            break;

                        case 'no_activations_left':

                            $message = __('Your license key has reached its activation limit.');
                            break;

                        default :

                            $message = __('An error occurred, please try again.');
                            break;
                    }
                }
            }

            // Check if anything passed on a message constituting a failure
            if (!empty($message)) {
                $base_url = admin_url('admin.php?page=' . OXILAB_FLIP_BOX_LICENSE_PAGE);
                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

                wp_redirect($redirect);
                exit();
            }

            // $license_data->license will be either "valid" or "invalid"

            update_option('oxilab_flip_box_license_status', $license_data->license);
            wp_redirect(admin_url('admin.php?page=' . OXILAB_FLIP_BOX_LICENSE_PAGE));
            exit();
        }
    }

    add_action('admin_init', 'oxilab_flip_box_activate_license');
    /*     * *********************************************
     * Illustrates how to deactivate a license key.
     * This will decrease the site count
     * ********************************************* */

    function oxilab_flip_box_deactivate_license() {

        // listen for our activate button to be clicked
        if (isset($_POST['oxilab_flip_box_license_deactivate'])) {

            // run a quick security check
            if (!check_admin_referer('oxilab_flip_box_nonce', 'oxilab_flip_box_nonce'))
                return; // get out if we didn't click the Activate button 
// retrieve the license from the database
            $license = trim(get_option('oxilab_flip_box_license_key'));
            // data to send in our API request
            $api_params = array(
                'edd_action' => 'deactivate_license',
                'license' => $license,
                'item_name' => urlencode(OXILAB_FLIP_BOX), // the name of our product in EDD
                'url' => home_url()
            );
            // Call the custom API.
            $response = wp_remote_post(OXILAB_FLIP_BOX_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));
            // make sure the response came back okay
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
                if (is_wp_error($response)) {
                    $message = $response->get_error_message();
                } else {
                    $message = __('An error occurred, please try again.');
                }
                $base_url = admin_url('admin.php?page=' . OXILAB_FLIP_BOX_LICENSE_PAGE);
                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

                wp_redirect($redirect);
                exit();
            }
            // decode the license data
            $license_data = json_decode(wp_remote_retrieve_body($response));
            // $license_data->license will be either "deactivated" or "failed"
            if ($license_data->license == 'deactivated') {
                delete_option('oxilab_flip_box_license_status');
            }
            wp_redirect(admin_url('admin.php?page=' . OXILAB_FLIP_BOX_LICENSE_PAGE));
            exit();
        }
    }

    add_action('admin_init', 'oxilab_flip_box_deactivate_license');
    /*     * **********************************
     * this illustrates how to check if
     * a license key is still valid
     * the updater does this for you,
     * so this is only needed if you
     * want to do something custom
     * *********************************** */

    function oxilab_flip_box_check_license() {
        global $wp_version;
        $license = trim(get_option('oxilab_flip_box_license_key'));
        $api_params = array(
            'edd_action' => 'check_license',
            'license' => $license,
            'item_name' => urlencode(OXILAB_FLIP_BOX),
            'url' => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post(OXILAB_FLIP_BOX_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

        if (is_wp_error($response))
            return false;

        $license_data = json_decode(wp_remote_retrieve_body($response));

        if ($license_data->license == 'valid') {
            echo 'valid';
            exit;
            // this license is still valid
        } else {
            echo 'invalid';
            exit;
            // this license is no longer valid
        }
    }

    /**
     * This is a means of catching errors from the activation method above and displaying it to the customer
     */
    function oxilab_flip_box_admin_notices() {
        if (isset($_GET['sl_activation']) && !empty($_GET['message'])) {

            switch ($_GET['sl_activation']) {

                case 'false':
                    $message = urldecode($_GET['message']);
                    ?>
                    <div class="error">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php
                    break;

                case 'true':
                default:
                    break;
            }
        }
    }

    add_action('admin_notices', 'oxilab_flip_box_admin_notices');

    include( dirname(__FILE__) . '/helper/widget.php' );

    function oxilab_flip_box_admin_head() {
        $second = '<div class="oxilab-admin-wrapper ">
                        <ul class="oxilab-admin-menu iheu-admin-side-menu">  
                            <li><a href="' . admin_url('admin.php?page=oxilab-flip-box-admin') . '">Flip Box</a></li>
                            <li><a href="' . admin_url('admin.php?page=oxilab-flip-box-admin-new') . '">New Effects</a></li>
                            <li><a href="' . admin_url('admin.php?page=oxilab-flip-box-admin-import') . '">Add templates</a></li>
                            <li><a href="' . admin_url('admin.php?page=oxilab-flip-box-license') . '">Settings</a></li>
                        </ul>
                    </div> ';
        if (is_plugin_active('shortcode-addons/index.php')) {
            echo '<div class="oxilab-admin-wrapper">
                        <ul class="oxilab-admin-menu">  
                            <li><a class="active" href="' . admin_url('admin.php?page=oxi-addons') . '">Shortcode Addons</a></li>
                            <li><a href="' . admin_url('admin.php?page=oxi-addons-import') . '">Import Addons</a></li>
                            <li><a href="' . admin_url('admin.php?page=oxi-addons-import-data') . '">Import Style</a></li>
                            <li><a href="' . admin_url('admin.php?page=oxi-addons-settings') . '">Addons Settings</a></li>
                        </ul>
                    </div> ';
            echo $second;
        } else {
            echo $second;
        }
        $status = get_option('oxilab_flip_box_license_status');

        echo '<div class="oxilab-admin-wrapper"> <div class="oxilab-admin-row"><div class="oxilab-admin-notifications">
            <h3>
                <span class="dashicons dashicons-flag"></span> 
                Notifications
            </h3>
            <p></p>
            <div class="oxilab-admin-notifications-holder">
                <div class="oxilab-admin-notifications-alert">
                    <p>Thank you for using Flipbox - Awesomes Flip Boxes Image Overlay. I Just wanted to see if you have any questions or concerns about my plugins. If you do, Please do not hesitate to <a href="https://wordpress.org/plugins/image-hover-effects-ultimate-visual-composer/#new-post">file a bug report</a>. ';
        if (is_plugin_active('shortcode-addons/index.php')) {
            echo '</p>';
        } else {
            echo 'You can also try <a target="_blank" href="https://wordpress.org/plugins/shortcode-addons/">Shortcode Addons</a> All in one package for Wordpress sites.</p>';
        }
        if ($status != 'valid') {
            echo '<p>By the way, did you know we also have a <a href="https://www.oxilab.org/downloads/flipbox-image-overlay/">Premium Version</a>? It offers lots of options with automatic update. It also comes with 16/5 personal support.</p>';
        }

        echo ' <p>Thanks Again!</p>
                    <p></p>                      
                </div>                        
            </div>
            <p></p>
        </div> 
        <p></p>
        </div> 
        </div> ';
        if ($status != 'valid') {
            $jquery = 'jQuery(".oxilab-vendor-color").each(function (index, value) {                             
                            jQuery(this).parent().siblings(".col-sm-6.col-form-label").append(" <span class=\"oxi-pro-only\">Pro</span>");
                            var datavalue = jQuery(this).val();
                            jQuery(this).attr("oxivalue", datavalue);
                        });
                        jQuery(".oxilab-admin-font").each(function (index, value) {
                            jQuery(this).parent().siblings(".col-sm-6.col-form-label").append(" <span class=\"oxi-pro-only\">Pro</span>");
                            var datavalue = jQuery(this).val();
                            jQuery(this).attr("oxivalue", datavalue);
                        });
                        jQuery("#custom-css").each(function (index, value) {
                            var dataid = jQuery(this).attr("id");
                            jQuery("." + dataid).append(" <span class=\"oxi-pro-only\">Pro Only</span>");
                            var datavalue = jQuery(this).val();
                            jQuery(this).attr("oxivalue", datavalue);
                        });
                        jQuery("#oxi-addons-flip-style").submit(function () {
                            jQuery(".oxilab-vendor-color").each(function (index, value) {
                                var datavalue = jQuery(this).attr("oxivalue");
                                jQuery(this).val(datavalue);
                            });
                            jQuery(".oxilab-admin-font").each(function (index, value) {
                                var datavalue = jQuery(this).attr("oxivalue");
                                jQuery(this).val(datavalue);
                            });
                            jQuery("#custom-css").each(function (index, value) {
                                jQuery(this).val("");
                            });
                        });';
            wp_add_inline_script('oxilab-bootstrap', $jquery);
        }
    }

    add_action('admin_init', 'oxilab_flip_box_nobug');

    function oxilab_flip_box_check_installation_date() {
        $nobug = "";
        $nobug = get_option('oxilab_flip_box_nobug');
        if ($nobug != 'already') {
            $install_date = get_option('oxilab_flip_box_activation_date');
            if (empty($install_date)) {
                $now = strtotime("now");
                add_option('oxilab_flip_box_activation_date', $now);
            }
            $past_date = strtotime('-7 days');
            if ($past_date >= $install_date) {
                add_action('admin_notices', 'oxilab_flip_box_display_admin_notice');
            }
        }
    }

    function oxilab_flip_box_nobug() {
        $nobug = "";
        if (isset($_GET['oxilab_flip_box_nobug'])) {
            $nobug = esc_attr($_GET['oxilab_flip_box_nobug']);
        }
        if ('already' == $nobug) {
            add_option('oxilab_flip_box_nobug', $nobug);
        } elseif ('later' == $nobug) {
            $now = strtotime("now");
            update_option('oxilab_flip_box_activation_date', $now);
        }
    }

    add_action('admin_init', 'oxilab_flip_box_check_installation_date');

    function oxilab_flip_box_display_admin_notice() {

        // Review URL - Change to the URL of your plugin on WordPress.org
        $reviewurl = 'https://wordpress.org/plugins/image-hover-effects-ultimate-visual-composer/';

        $nobugurl = get_admin_url() . '?oxilab_flip_box_nobug=later';
        $nobugurl2 = get_admin_url() . '?oxilab_flip_box_nobug=already';

        echo '<div class="updated">';
        echo '<p></p>';

        printf(__('<p>Hey, You’ve using <strong>Flipbox - Awesomes Flip Boxes Image Overlay </strong> more than 1 week – that’s awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress? Just to help us spread the word and boost our motivation.!
                     </p>
                    <p><a href=%s target="_blank"><strong>Ok, you deserve it</strong></a></p>
                    <p><a href=%s><strong>Nope, maybe later</strong></a> </p>
                    <p><a href=%s><strong>I already did</strong></a> </p>'), $reviewurl, $nobugurl, $nobugurl2);
        echo '<p></p>';
        echo "</div>";
    }

    function FlipBoxesImageAdFAData($data) {
        $val = '';
        $faversion = get_option('oxi_addons_font_awesome_version');
        $faversion = explode('||', $faversion);
        $ftawversion = $faversion[0];
        if ($data == 'facebook') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-facebook';
            } else {
                $val .= 'fab fa-facebook-f';
            }
        } elseif ($data == 'twitter') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-twitter';
            } else {
                $val .= 'fab fa-twitter';
            }
        } elseif ($data == 'youtube') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-youtube-play';
            } else {
                $val .= 'fab fa-youtube';
            }
        } elseif ($data == 'ambulance') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-ambulance';
            } else {
                $val .= 'fas fa-ambulance';
            }
        } elseif ($data == 'adn') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-adn';
            } else {
                $val .= 'fab fa-adn';
            }
        } elseif ($data == 'github') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-github-alt';
            } else {
                $val .= 'fab fa-github';
            }
        } elseif ($data == 'book') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-address-book-o';
            } else {
                $val .= 'fas fa-address-book';
            }
        } elseif ($data == 'plus') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-plus-circle';
            } else {
                $val .= 'fas fa-plus-circle';
            }
        } elseif ($data == 'cogs') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-cog';
            } else {
                $val .= 'fas fa-cogs';
            }
        } elseif ($data == 'file') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-files-o';
            } else {
                $val .= 'fas fa-file';
            }
        } elseif ($data == 'users') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-users';
            } else {
                $val .= 'fas fa-users';
            }
        } elseif ($data == 'tickets') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-ticket';
            } else {
                $val .= 'fas fa-ticket-alt';
            }
        } elseif ($data == 'fa-balance-scale') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-balance-scale';
            } else {
                $val .= 'fas fa-balance-scale';
            }
        } elseif ($data == 'fa-bandcamp') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-bandcamp';
            } else {
                $val .= 'fab fa-bandcamp';
            }
        } elseif ($data == 'fa-copyright') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-copyright';
            } else {
                $val .= 'fas fa-copyright';
            }
        } elseif ($data == 'fa-arrow-right') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-arrow-right';
            } else {
                $val .= 'fas fa-arrow-right';
            }
        } elseif ($data == 'fa-bug') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-bug';
            } else {
                $val .= 'fas fa-bug';
            }
        }
        return $val;
    }

    function FlipBoxesImageAdFontAwesome($data) {
        $faversion = get_option('oxi_addons_font_awesome_version');
        $faversion = explode('||', $faversion);
        wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
        $data = FlipBoxesImageAdFAData($data);
        return oxilab_flip_box_font_icon($data);
    }
    