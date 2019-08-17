<?php
/*
Plugin Name:  Stylish Box
Plugin URI:   https://wordpress.org/plugins/stylish-box
Description:  Choose from 8 stitched bordered boxes with shadows, full responsiveness, styled in pure CSS for your WordPress Content.
Version:      20171017
Author:       nath4n
Author URI:   http://thinknesia.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /languages
*/

/* Add Stylish Box CSS */
wp_enqueue_style( 'stylish-box-style', PLUGINS_URL('stylish-box-style.css', __FILE__ ));

function stylish_box_styling_me( $content ) {
	/* Read settings */
	$settings = maybe_unserialize(get_option('stylish-box-settings'));
	
	if ($settings == 'shadow1'){
		?>
		<div class="wrap-stylish">
		  <div class="box box1 shadow1">
			<div class="dashed"><?php return $content; ?></div>
		  </div>
		</div>
		<?php
	} elseif ($settings == 'shadow2'){
		?>
		<div class="wrap-stylish">
		  <div class="box box2 shadow2">
			<div class="dashed"><?php return $content; ?></div>
		  </div>
		</div>
		<?php
	} elseif ($settings == 'shadow3'){
		?>
		<div class="wrap-stylish">
		  <div class="box box3 shadow3">
			<div class="dashed"><?php return $content; ?></div>
		  </div>
		</div>
		<?php
	} elseif ($settings == 'shadow4'){
		?>
		<div class="wrap-stylish">
		  <div class="box box4 shadow4">
			<div class="dashed"><?php return $content; ?></div>
		  </div>
		</div>
		<?php
	} elseif ($settings == 'shadow5'){
		?>
		<div class="wrap-stylish">
		  <div class="box box5 shadow5">
			<div class="dashed"><?php return $content; ?></div>
		  </div>
		</div>
		<?php
	} elseif ($settings == 'shadow6'){
		?>
		<div class="wrap-stylish">
		  <div class="box box6 shadow6">
			<div class="dashed"><?php return $content; ?></div>
		  </div>
		</div>
		<?php
	} elseif ($settings == 'shadow7'){
		?>
		<div class="wrap-stylish">
		  <div class="box box7 shadow7">
			<div class="dashed"><?php return $content; ?></div>
		  </div>
		</div>
		<?php
	} elseif ($settings == 'shadow8'){
		?>
		<div class="wrap-stylish">
		  <div class="box box8 shadow8">
			<div class="dashed"><?php return $content; ?></div>
		  </div>
		</div>
	<?php
	}
}
add_action( 'the_content', 'stylish_box_styling_me', 3 );

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'stylish_box_install');
function stylish_box_install() {
	/* Set to Default */
	$settings = maybe_unserialize(get_option('stylish-box-settings'));
	if(empty($settings)){ 
		$settings = "shadow1"; 
	}
	update_option("stylish-box-settings", maybe_serialize($settings));
}

if ( is_admin() ){
	/* Call the html code */
	add_action('admin_menu', 'stylish_box_admin_menu');	

	function stylish_box_admin_menu() {
		add_options_page('Stylish Box', 
		'Stylish Box', 
		'administrator',
		'stylish-box', 
		'stylish_box_setting_page');
	}
}

function stylish_box_admin_enqueue(){
	/* Dont forget to add JQuery */
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'prefix-style' , plugins_url( 'style-admin.css' , __FILE__ ));
}
add_action('admin_enqueue_scripts', 'stylish_box_admin_enqueue', 3);

function stylish_box_setting_page() {
	/* Save Changes */
	if ( current_user_can( 'manage_options' ) ) {
		if (isset($_POST['update']) && check_admin_referer( 'stylish-box-nonce' )) {			
			update_option("stylish-box-settings", sanitize_text_field($_POST["stylish-box"]) );
			$message.="Updated";
		}
    }
	/* Read settings */
	$settings = maybe_unserialize(get_option('stylish-box-settings'));
	?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#<?php echo $settings; ?>").attr('checked', true);
	});		
	</script>

	<div class="wrap">
        <h2>Stylish Box Configuration</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<?php wp_nonce_field( 'stylish-box-nonce' ); ?>
			<div class="wrap-stylish"></div>
            <table class='wp-list-table widefat fixed'>
				<tr>
					<td style="text-align: left;font: bold 12px/30px Georgia, serif;">Select your box style : </td>
				</tr>
				<tr>					
					<td>
						<label><input type="radio" name="stylish-box" value="shadow1" id="shadow1">Shadow 1</label><br>
						<label><input type="radio" name="stylish-box" value="shadow2" id="shadow2">Shadow 2</label><br>
						<label><input type="radio" name="stylish-box" value="shadow3" id="shadow3">Shadow 3</label><br>
						<label><input type="radio" name="stylish-box" value="shadow4" id="shadow4">Shadow 4</label><br>
						<label><input type="radio" name="stylish-box" value="shadow5" id="shadow5">Shadow 5</label><br>
						<label><input type="radio" name="stylish-box" value="shadow6" id="shadow6">Shadow 6</label><br>
						<label><input type="radio" name="stylish-box" value="shadow7" id="shadow7">Shadow 7</label><br>
						<label><input type="radio" name="stylish-box" value="shadow8" id="shadow8">Shadow 8</label><br>
					</td>
				</tr>		
            </table>
            <input type='submit' name="update" value='Save Change' class='button'>
        </form>
    </div>
	<?php
}
?>