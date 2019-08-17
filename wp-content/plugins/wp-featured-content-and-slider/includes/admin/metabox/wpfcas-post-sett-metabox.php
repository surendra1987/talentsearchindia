<?php
/**
 * Handles Featured Content Post Setting Metabox HTML
 *
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

// Getting saved values
$featured_icon 	= get_post_meta( $post->ID, 'wpfcas_slide_icon', true );
$read_more_link = get_post_meta( $post->ID, 'wpfcas_slide_link', true );
?>

<table class="form-table wpfcas-post-sett-table">
	<tbody>

		<tr valign="top">
			<th>
				<label for="wpfcas-icon"><?php _e('Featured Content Icon', 'wp-featured-content-and-slider'); ?></label>
			</th>
			<td>
				<input type="text" value="<?php echo esc_attr($featured_icon); ?>" class="large-text wpfcas-icon" id="wpfcas-icon" name="wpfcas_slide_icon" /><br/>
				<span class="description"><?php _e('For example : fa fa-bluetooth-b', 'wp-featured-content-and-slider'); ?></span><br/>
				<span class="description"><?php _e('Get icon class details : <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank"> Font Awesome</a>', 'wp-featured-content-and-slider'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th>
				<label for="wpfcas-more-link"><?php _e('Read More Link', 'wp-featured-content-and-slider'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo esc_attr($read_more_link); ?>" class="large-text wpfcas-more-link" id="wpfcas-more-link" name="wpfcas_slide_link" /><br/>
				<span class="description"><?php _e('Enter read more link. You can add external link also. ie http://www.google.com', 'wp-featured-content-and-slider'); ?></span>
			</td>
		</tr>

	</tbody>
</table><!-- end .wtwp-tstmnl-table -->