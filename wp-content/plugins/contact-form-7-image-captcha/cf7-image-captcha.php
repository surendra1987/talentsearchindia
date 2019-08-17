<?php
/**
 * Plugin Name:       Contact Form 7 Image Captcha
 * Plugin URI:        https://wordpress.org/plugins/contact-form-7-image-captcha/
 * Description:       Add a simple image captcha and Honeypot to contact form 7
 * Version:           3.1.0
 * Author:            KC Computing
 * Author URI:        https://profiles.wordpress.org/ktc_88
 * License:           GNU General Public License v2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       contact-form-7-image-captcha
 */

/*
 * RESOURCE HELP
 * http://stackoverflow.com/questions/17541614/use-thumbnail-image-instead-of-radio-button
 * http://jsbin.com/pafifi/1/edit?html,css,output
 * http://jsbin.com/nenarugiwe/1/edit?html,css,output
 */

/**
 * Add "Go Pro" action link to plugins table
 */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'cf7ic_plugin_action_links' );
function cf7ic_plugin_action_links( $links ) {
    return array_merge(
        array(
            'go-pro' => '<a href="http://kccomputing.net/downloads/contact-form-7-image-captcha-pro/">' . __( 'Go Pro', 'contact-form-7-image-captcha' ) . '</a>'
        ),
        $links
    );
}

/**
 * Load Textdomains
 */
add_action('plugins_loaded', 'cf7ic_load_textdomain');
function cf7ic_load_textdomain() {
    load_plugin_textdomain( 'contact-form-7-image-captcha', false, dirname( plugin_basename(__FILE__) ) . '/lang' );
}





// https://shellcreeper.com/how-to-create-admin-notice-on-plugin-activation/
if(function_exists( 'wpcf7cf_plugin_path' ) ) { // Run notice if Contact Form 7 Conditional Fields is active
    add_action( 'admin_notices', 'cf7ic_admin_activate_notice' );
}

// Register activation hook.
register_activation_hook( __FILE__, 'cf7ic_admin_notice_activation_hook' );

// Runs only when plugin is activated.
function cf7ic_admin_notice_activation_hook() {
    set_transient( 'cf7ic-admin-notice', true, 5 ); // Create transient data
}

function cf7ic_admin_activate_notice() {
    if( get_transient( 'cf7ic-admin-notice' ) ){ // Check transient, if available display notice
        $class = 'notice notice-info is-dismissible';
        $message = __( 'It appears you have <b>Contact Form 7 Conditional Fields</b> installed, due to compatibility issues with Contact Form 7 Image CAPTCHA, you will need to add <code>[hidden kc_captcha "kc_human"]</code> to the forms you <b>DO NOT</b> want the CAPTCHA to appear on.', 'contact-form-7-image-captcha' );
        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
        delete_transient( 'cf7ic-admin-notice' ); // Delete transient, only display this notice once.
    }
}




/**
 * Register/Enqueue CSS on initialization
 */
add_action('init', 'cf7ic_register_style');
function cf7ic_register_style() {
    wp_register_style( 'cf7ic_style', plugins_url('/style.css', __FILE__), false, '3.0.0', 'all');
}

/**
 * Add custom shortcode to Contact Form 7
 */
add_action( 'wpcf7_init', 'add_shortcode_cf7ic' );
function add_shortcode_cf7ic() {
    wpcf7_add_form_tag( 'cf7ic', 'call_cf7ic', true );
}

/**
 * cf7ic shortcode
 */
function call_cf7ic( $tag ) {  
    $tag = new WPCF7_FormTag( $tag );
    $toggle = '';
    if($tag['raw_values']) {
        $toggle = $tag['raw_values'][0];
    }

    wp_enqueue_style( 'cf7ic_style' ); // enqueue css

    // Create an array to hold the image library
    $captchas = array(
        __( 'Heart', 'contact-form-7-image-captcha') => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M414.9 24C361.8 24 312 65.7 288 89.3 264 65.7 214.2 24 161.1 24 70.3 24 16 76.9 16 165.5c0 72.6 66.8 133.3 69.2 135.4l187 180.8c8.8 8.5 22.8 8.5 31.6 0l186.7-180.2c2.7-2.7 69.5-63.5 69.5-136C560 76.9 505.7 24 414.9 24z"></path></svg>',
        __( 'House', 'contact-form-7-image-captcha') => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M488 312.7V456c0 13.3-10.7 24-24 24H348c-6.6 0-12-5.4-12-12V356c0-6.6-5.4-12-12-12h-72c-6.6 0-12 5.4-12 12v112c0 6.6-5.4 12-12 12H112c-13.3 0-24-10.7-24-24V312.7c0-3.6 1.6-7 4.4-9.3l188-154.8c4.4-3.6 10.8-3.6 15.3 0l188 154.8c2.7 2.3 4.3 5.7 4.3 9.3zm83.6-60.9L488 182.9V44.4c0-6.6-5.4-12-12-12h-56c-6.6 0-12 5.4-12 12V117l-89.5-73.7c-17.7-14.6-43.3-14.6-61 0L4.4 251.8c-5.1 4.2-5.8 11.8-1.6 16.9l25.5 31c4.2 5.1 11.8 5.8 16.9 1.6l235.2-193.7c4.4-3.6 10.8-3.6 15.3 0l235.2 193.7c5.1 4.2 12.7 3.5 16.9-1.6l25.5-31c4.2-5.2 3.4-12.7-1.7-16.9z"></path></svg>',
        __( 'Star', 'contact-form-7-image-captcha')  => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg>',
        __( 'Car', 'contact-form-7-image-captcha')   => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M499.991 168h-54.815l-7.854-20.944c-9.192-24.513-25.425-45.351-46.942-60.263S343.651 64 317.472 64H194.528c-26.18 0-51.391 7.882-72.908 22.793-21.518 14.912-37.75 35.75-46.942 60.263L66.824 168H12.009c-8.191 0-13.974 8.024-11.384 15.795l8 24A12 12 0 0 0 20.009 216h28.815l-.052.14C29.222 227.093 16 247.997 16 272v48c0 16.225 6.049 31.029 16 42.309V424c0 13.255 10.745 24 24 24h48c13.255 0 24-10.745 24-24v-40h256v40c0 13.255 10.745 24 24 24h48c13.255 0 24-10.745 24-24v-61.691c9.951-11.281 16-26.085 16-42.309v-48c0-24.003-13.222-44.907-32.772-55.86l-.052-.14h28.815a12 12 0 0 0 11.384-8.205l8-24c2.59-7.771-3.193-15.795-11.384-15.795zm-365.388 1.528C143.918 144.689 168 128 194.528 128h122.944c26.528 0 50.61 16.689 59.925 41.528L391.824 208H120.176l14.427-38.472zM88 328c-17.673 0-32-14.327-32-32 0-17.673 14.327-32 32-32s48 30.327 48 48-30.327 16-48 16zm336 0c-17.673 0-48 1.673-48-16 0-17.673 30.327-48 48-48s32 14.327 32 32c0 17.673-14.327 32-32 32z"></path></svg>',
        __( 'Cup', 'contact-form-7-image-captcha')   => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M192 384h192c53 0 96-43 96-96h32c70.6 0 128-57.4 128-128S582.6 32 512 32H120c-13.3 0-24 10.7-24 24v232c0 53 43 96 96 96zM512 96c35.3 0 64 28.7 64 64s-28.7 64-64 64h-32V96h32zm47.7 384H48.3c-47.6 0-61-64-36-64h583.3c25 0 11.8 64-35.9 64z"></path></svg>',
        __( 'Flag', 'contact-form-7-image-captcha')  => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M349.565 98.783C295.978 98.783 251.721 64 184.348 64c-24.955 0-47.309 4.384-68.045 12.013a55.947 55.947 0 0 0 3.586-23.562C118.117 24.015 94.806 1.206 66.338.048 34.345-1.254 8 24.296 8 56c0 19.026 9.497 35.825 24 45.945V488c0 13.255 10.745 24 24 24h16c13.255 0 24-10.745 24-24v-94.4c28.311-12.064 63.582-22.122 114.435-22.122 53.588 0 97.844 34.783 165.217 34.783 48.169 0 86.667-16.294 122.505-40.858C506.84 359.452 512 349.571 512 339.045v-243.1c0-23.393-24.269-38.87-45.485-29.016-34.338 15.948-76.454 31.854-116.95 31.854z"></path></svg>',
        __( 'Key', 'contact-form-7-image-captcha')   => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z"></path></svg>',
        __( 'Truck', 'contact-form-7-image-captcha') => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z"></path></svg>',
        __( 'Tree', 'contact-form-7-image-captcha')  => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M377.33 375.429L293.906 288H328c21.017 0 31.872-25.207 17.448-40.479L262.79 160H296c20.878 0 31.851-24.969 17.587-40.331l-104-112.003c-9.485-10.214-25.676-10.229-35.174 0l-104 112.003C56.206 134.969 67.037 160 88 160h33.21l-82.659 87.521C24.121 262.801 34.993 288 56 288h34.094L6.665 375.429C-7.869 390.655 2.925 416 24.025 416H144c0 32.781-11.188 49.26-33.995 67.506C98.225 492.93 104.914 512 120 512h144c15.086 0 21.776-19.069 9.995-28.494-19.768-15.814-33.992-31.665-33.995-67.496V416h119.97c21.05 0 31.929-25.309 17.36-40.571z"></path></svg>',
        __( 'Plane', 'contact-form-7-image-captcha') => '<svg width="50px" height="50px" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M472 200H360.211L256.013 5.711A12 12 0 0 0 245.793 0h-57.787c-7.85 0-13.586 7.413-11.616 15.011L209.624 200H99.766l-34.904-58.174A12 12 0 0 0 54.572 136H12.004c-7.572 0-13.252 6.928-11.767 14.353l21.129 105.648L.237 361.646c-1.485 7.426 4.195 14.354 11.768 14.353l42.568-.002c4.215 0 8.121-2.212 10.289-5.826L99.766 312h109.858L176.39 496.989c-1.97 7.599 3.766 15.011 11.616 15.011h57.787a12 12 0 0 0 10.22-5.711L360.212 312H472c57.438 0 104-25.072 104-56s-46.562-56-104-56z"></path></svg>',
    );

    $choice = array_rand( $captchas, 3);
    foreach($choice as $key) {
        $choices[$key] = $captchas[$key];
    }

    // Pick a number between 0-2 and use it to determine which array item will be used as the answer
    $human = rand(0,2);

    if($toggle == 'toggle') {
        $style = 'style="display: none;"';
        add_action('wp_footer', 'cf7ic_toggle');            
    } else { 
        $style = '';
    }

    $output = ' 
    <span class="captcha-image" '.$style.'>
        <span class="cf7ic_instructions">';
            $output .= __('Please prove you are human by selecting the ', 'contact-form-7-image-captcha');
            $output .= '<span> '.$choice[$human].'</span>';
            $output .= __('.', 'contact-form-7-image-captcha').'</span>';
        $i = -1;
        foreach($choices as $title => $image) {
            $i++;
            if($i == $human) { $value = "kc_human"; } else { $value = "bot"; };
            $output .= '<label><input type="radio" name="kc_captcha" value="'. $value .'" />'. $image .'</label>';
        }
    $output .= '
    </span>
    <span style="display:none">
        <input type="text" name="kc_honeypot">
    </span>';

    return '<span class="wpcf7-form-control-wrap kc_captcha"><span class="wpcf7-form-control wpcf7-radio">'.$output.'</span></span>';
}

/**
 * Custom validator
 */
function cf7ic_check_if_spam( $result, $tag ) {
    $tag = new WPCF7_Shortcode( $tag );
    $kc_val1 = isset( $_POST['kc_captcha'] ) ? trim( $_POST['kc_captcha'] ) : '';   // Get selected icon value
    $kc_val2 = isset( $_POST['kc_honeypot'] ) ? trim( $_POST['kc_honeypot'] ) : ''; // Get honeypot value

    if(!empty($kc_val1) && $kc_val1 != 'kc_human' ) {
        $tag->name = "kc_captcha";
        $result->invalidate( $tag, __('Please select the correct icon.', 'contact-form-7-image-captcha') );
    }
    if(empty($kc_val1) ) {
        $tag->name = "kc_captcha";
        $result->invalidate( $tag, __('Please select an icon.', 'contact-form-7-image-captcha') );
    }
    if(!empty($kc_val2) ) {
        $tag->name = "kc_captcha";
        $result->invalidate( $tag, wpcf7_get_message( 'spam' ) );
    }
    return $result;
}


if(function_exists( 'wpcf7cf_plugin_path' ) ) {
    add_filter('wpcf7_validate','cf7ic_check_if_spam', 99, 2); // If "Contact Form 7 – Conditional Fields" plugin is installed and active
} else {
    add_filter('wpcf7_validate_cf7ic','cf7ic_check_if_spam', 10, 2);
}


// Add Contact Form Tag Generator Button
add_action( 'wpcf7_admin_init', 'cf7ic_add_tag_generator', 55 );

function cf7ic_add_tag_generator() {
    $tag_generator = WPCF7_TagGenerator::get_instance();
    $tag_generator->add( 'cf7ic', __( 'Image Captcha', 'contact-form-7-image-captcha' ),
        'cf7ic_tag_generator', array( 'nameless' => 1 ) );
}

function cf7ic_tag_generator( $contact_form, $args = '' ) {
    $args = wp_parse_args( $args, array() ); ?>
    <div class="control-box">
        <fieldset>
            <legend>Coming soon to <a href="http://kccomputing.net/downloads/contact-form-7-image-captcha-pro/" target="_blank">Contact Form 7 Image Captcha Pro</a>, edit the styling directly from this box.</legend>
        </fieldset>
    </div>
    <div class="insert-box">
        <input type="text" name="cf7ic" class="tag code" readonly="readonly" onfocus="this.select()" />
        <div class="submitbox">
            <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
        </div>
    </div>
<?php
}


function cf7ic_toggle(){
    echo '<script type="text/javascript">
        jQuery(document).ready(function(){
        jQuery("body").on("focus", "form.wpcf7-form", function(){ 
                jQuery(".captcha-image").show();
            });
        })
    </script>';
};