<?php
/**
 * Template specific functions
 *
 * @package wp-job-openings
 * @version 1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_awsm_jobs_template_path' ) ) {
	function get_awsm_jobs_template_path( $slug, $dir_name = false ) {
		return AWSM_Job_Openings::get_template_path( "{$slug}.php", $dir_name );
	}
}

if ( ! function_exists( 'awsm_jobs_query' ) ) {
	function awsm_jobs_query( $shortcode_atts = array() ) {
		$args  = AWSM_Job_Openings::awsm_job_query_args( array(), $shortcode_atts );
		$query = new WP_Query( $args );
		return $query;
	}
}

if ( ! function_exists( 'awsm_jobs_view' ) ) {
	function awsm_jobs_view() {
		return AWSM_Job_Openings::get_job_listing_view();
	}
}

if ( ! function_exists( 'awsm_jobs_view_class' ) ) {
	function awsm_jobs_view_class( $class = '' ) {
		$view_class = AWSM_Job_Openings::get_job_listing_view_class();
		if ( ! empty( $class ) ) {
			$view_class = trim( $view_class . ' ' . $class );
		}
		printf( 'class="%s"', esc_attr( $view_class ) );
	}
}

if ( ! function_exists( 'awsm_jobs_data_attrs' ) ) {
	function awsm_jobs_data_attrs( $attrs = array(), $shortcode_atts = array() ) {
		$content = '';
		$attrs   = array_merge( AWSM_Job_Openings::get_job_listing_data_attrs( $shortcode_atts ), $attrs );
		if ( ! empty( $attrs ) ) {
			foreach ( $attrs as $name => $value ) {
				if ( ! empty( $value ) ) {
					$content .= sprintf( ' data-%s="%s"', esc_attr( $name ), esc_attr( $value ) );
				}
			}
		}
		echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'awsm_job_content_class' ) ) {
	function awsm_job_content_class( $class = '' ) {
		$content_class = 'awsm-job-single-wrap' . AWSM_Job_Openings::get_job_details_class();
		if ( ! empty( $class ) ) {
			$content_class .= ' ' . $class;
		}
		printf( 'class="%s"', esc_attr( $content_class ) );
	}
}

if ( ! function_exists( 'is_awsm_job_expired' ) ) {
	function is_awsm_job_expired( $hard_check = true ) {
		$is_expired = get_post_status() === 'expired';
		if ( $hard_check === false ) {
			$is_expired = $is_expired && get_option( 'awsm_jobs_expired_jobs_content_details' ) === 'content';
		}
		return $is_expired;
	}
}

if ( ! function_exists( 'get_awsm_job_details' ) ) {
	function get_awsm_job_details() {
		return array(
			'id'        => get_the_ID(),
			'title'     => get_the_title(),
			'permalink' => get_permalink(),
		);
	}
}

if ( ! function_exists( 'awsm_job_expiry_details' ) ) {
	function awsm_job_expiry_details( $before = '', $after = '' ) {
		$expiry_details = AWSM_Job_Openings::get_job_expiry_details( get_the_ID(), get_post_status() );
		if ( ! empty( $expiry_details ) ) {
			echo $before . $expiry_details . $after; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

if ( ! function_exists( 'awsm_job_spec_content' ) ) {
	function awsm_job_spec_content( $pos ) {
		AWSM_Job_Openings::display_specifications_content( get_the_ID(), $pos );
	}
}

if ( ! function_exists( 'awsm_job_listing_spec_content' ) ) {
	function awsm_job_listing_spec_content( $job_id, $awsm_filters, $listing_specs ) {
		echo AWSM_Job_Openings::get_specifications_content( $job_id, false, $awsm_filters, array( 'specs' => $listing_specs ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'awsm_job_more_details' ) ) {
	function awsm_job_more_details( $link, $view ) {
		$more_dtls_link = sprintf( '<div class="awsm-job-more-container"><%1$s class="awsm-job-more"%3$s>%2$s <span></span></%1$s></div>', ( $view === 'grid' ) ? 'span' : 'a', esc_html__( 'More Details', 'wp-job-openings' ), ( $view === 'grid' ) ? '' : ' href="' . esc_url( $link ) . '"' );
		echo apply_filters( 'awsm_jobs_listing_details_link', $more_dtls_link, $view ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'awsm_jobs_load_more' ) ) {
	function awsm_jobs_load_more( $query, $shortcode_atts = array() ) {
		$loadmore = isset( $shortcode_atts['loadmore'] ) && $shortcode_atts['loadmore'] === 'no' ? false : true;
		if ( $loadmore ) :
			$max_num_pages = $query->max_num_pages;
			$paged         = ( $query->query_vars['paged'] ) ? $query->query_vars['paged'] : 1;
			if ( $max_num_pages > 1 && $paged < $max_num_pages ) : ?>
					<div class="awsm-load-more-main">
						<a href="#" class="awsm-load-more awsm-load-more-btn" data-page="<?php echo esc_attr( $paged ); ?>"><?php esc_html_e( 'Load more...', 'wp-job-openings' ); ?></a>
					</div>
					<?php
			endif;
		endif;
	}
}

if ( ! function_exists( 'awsm_no_jobs_msg' ) ) {
	function awsm_no_jobs_msg() {
		$msg = get_option( 'awsm_default_msg', __( 'We currently have no job openings', 'wp-job-openings' ) );
		echo esc_html( $msg );
	}
}

if ( ! function_exists( 'awsm_jobs_expired_msg' ) ) {
	function awsm_jobs_expired_msg( $before = '', $after = '' ) {
		$msg = esc_html__( 'Sorry! This job is expired.', 'wp-job-openings' );
		echo $before . $msg . $after; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'awsm_job_form_submit_btn' ) ) {
	function awsm_job_form_submit_btn() {
		$text     = apply_filters( 'awsm_application_form_submit_btn_text', __( 'Submit', 'wp-job-openings' ) );
		$res_text = apply_filters( 'awsm_application_form_submit_btn_res_text', __( 'Submitting..', 'wp-job-openings' ) );
		?>
		<input type="submit" name="form_sub" id="awsm-application-submit-btn" value="<?php echo esc_attr( $text ); ?>" data-response-text="<?php echo esc_attr( $res_text ); ?>" />
		<?php
	}
}

if ( ! function_exists( 'awsm_jobs_archive_title' ) ) {
	function awsm_jobs_archive_title() {
		if ( is_archive() ) {
			the_archive_title( '<h1 class="page-title awsm-jobs-archive-title">', '</h1>' );
		}
	}
}
add_action( 'before_awsm_jobs_listing', 'awsm_jobs_archive_title' );

if ( ! function_exists( 'awsm_jobs_single_title' ) ) {
	function awsm_jobs_single_title() {
		the_title( '<h1 class="entry-title awsm-jobs-single-title">', '</h1>' );
	}
}
add_action( 'before_awsm_jobs_single_content', 'awsm_jobs_single_title' );
