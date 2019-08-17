<?php
function wpfcas_featuredc_shortcode( $atts) {

	extract(shortcode_atts(array(
		'limit' 				=> '',
		'post_type' 			=> WPFCAS_POST_TYPE,
		'taxonomy'				=> WPFCAS_CAT,
		'grid' 					=> '',
		'cat_id' 				=> '',
		'design' 				=> '',
		'fa_icon_color' 		=> '',
		'image_style' 			=> '',
		'show_content' 			=> '',
		'display_read_more' 	=> '',
		'content_words_limit' 	=> '',
	), $atts));

	$post_type 	= (!empty($post_type))	? $post_type	: WPFCAS_POST_TYPE;
	$taxonomy 	= (!empty($taxonomy))	? $taxonomy		: WPFCAS_CAT;
	$grid		= ( !empty( $grid ) && is_numeric($grid) && $grid <= 4 ) ? intval( $grid ) : 1;

	// Define limit
	if( $limit ) { 
		$posts_per_page = $limit;
             
	} else {
		$posts_per_page = '-1';
	}
	
	if( $cat_id ) { 
		 $cat = $cat_id; 
	} else {
		$cat = '';
	}
	
	if( $fa_icon_color ) { 
		 $faIconcolor = $fa_icon_color; 
	} else {
		$faIconcolor = '#3ab0e2';
	}
	
	if( $grid ) { 
		 $perrow = $grid; 
	} else {
		$perrow = '12';
	}
	
	if( $image_style ) { 
		 $imagestyle = $image_style; 
	} else {
		$imagestyle = 'square';
	}
	
	if( $design ) { 
		$designfc = $design; 
	} else {
		$designfc = 'design-1';
	}
	
	if( $display_read_more ) { 
		$displayreadMore = $display_read_more; 
	} else {
		$displayreadMore = 'true';
	}
	 if( $content_words_limit ) { 
        $words_limit = $content_words_limit; 
    } else {
        $words_limit = '50';
    }
	 if( $show_content ) { 
        $showContent = $show_content; 
    } else {
        $showContent = 'true';
    }

	$args = array ( 
            'post_type'      => $post_type, 
            'orderby'        => 'post_date', 
            'order'          => 'DESC',
            'posts_per_page' => $posts_per_page,
           );

	if($cat != "") {
					$args['tax_query'] = array(
											array(
													'taxonomy' 	=> $taxonomy,
													'field' 	=> 'term_id',
													'terms' 	=> $cat
												));
    }
	
	$query = new WP_Query($args);

	ob_start();
?>
	<div class="featured-content-list <?php echo $designfc; ?>">
		<?php $count = 0;
			while ($query->have_posts()) : $query->the_post();		
				$count++;

				$css_class = 'featured-content';
				$css_class .= ( $count % $grid  == 1 ) ? ' first' : '';

				if($perrow == 2){
						$per_row = 6;
					}
					else if($perrow == 3){
						$per_row = 4;	
					}
					else if($perrow == 4){
						$per_row = 3;
					}
					else if($perrow == 1){
						$per_row = 12;
					}
					 else{
                        $per_row = $perrow;
                    }
					$class = 'wp-medium-'.$per_row.' wpcolumns';			

			switch ($designfc) {
				 case "design-1":
					include('designs/design-1.php');
					break;
				 case "design-2":
					include('designs/design-2.php');
					break;
				case "design-3":
					include('designs/design-3.php');
					break;
				case "design-4":
					include('designs/design-4.php');
					break;
				 default:	
						include('designs/design-1.php');
			}

		endwhile; ?>
	</div>

	<?php wp_reset_postdata();

	return ob_get_clean();
}

add_shortcode('featured-content', 'wpfcas_featuredc_shortcode');