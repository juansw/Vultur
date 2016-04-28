<?php

add_shortcode( 'themeum_video_post', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'category' 						=> '',
		'number' 						=> '6',
		'overlay' 						=> 'yes',
		'column' 						=> '6',
		'class' 						=> '',
        'order_by'  					=> 'date',          
        'style'   						=> 'style1',      
        'order'   						=> 'DESC',      
		), $atts));

 	global $post;
	
 	$output     = '';
 	$posts= 0;
  	if (isset($category) && $category!='') {
 		$idObj 	= get_category_by_slug( $category );
 		
 		if (isset($idObj) && $idObj!='') {
			$idObj 	= get_category_by_slug( $category );
			$cat_id = $idObj->term_id;

			$args = array( 
		    	'category' => $cat_id,
		        'orderby' => $order_by,
		        'order' => $order,
		        'meta_key' => 'thm_video',
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
 		}else{
 			echo "Please Enter a valid category name";
 			$args = 0;
 		}
 		}else{
			$args = array( 
		        'orderby' => $order_by,
		        'order' => $order,
		        'meta_key' => 'thm_video',
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
	 	}

		if ($style == 'style1') {

		    if(count($posts)>0){

		    	$output .= '<div class="themeum-video-post themeum-default-ul '.$class.'">';
			    foreach ($posts as $post): setup_postdata($post);

				    $output .= '<div class="themeum-video-post-item">';
				    if ( has_post_thumbnail() ) {	
					    $output .= '<div class="themeum-default-wrapper themeum-video-post-wrapper themeum-overlay-wrap '.$overlay.'">';
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'video-thumb', array('class' => 'vc_gitem-zone img-responsive img-video')).'<i class="fa fa-play"></i></a>';
						$output .= '<div class="themeum-default-intro themeum-video-post-intro themeum-overlay">';	
						$output .= '<div class="themeum-overlay-inner">';
						//$output .= '<span class="entry-category blockCategory videoOneCategory">';
						//$output .= get_the_category_list(', ');
						//$output .= '</span>';
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. wp_trim_words( get_the_title(), 4, "..." ) .'</a></h3>';		
						$output .= '</div>';//themeum-overlay-inner
						$output .= '</div>';//highlights-intro
						$output .= '</div>';//highlights-wrapper
					} else {
						$output .= '<div class="themeum-default-wrapper themeum-video-post-wrapper themeum-overlay-wrap no-image">';
						$output .= '<a href="'.get_permalink().'"><i class="fa fa-play"></i></a>';
					    $output .= '<div class="themeum-default-intro themeum-video-post-intro themeum-overlay">';	
						$output .= '<div class="themeum-overlay-inner">';
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. wp_trim_words( get_the_title(), 4, "..." ) .'</a></h3>';		
						$output .= '</div>';//themeum-overlay-inner
						$output .= '</div>';//highlights-intro
						$output .= '</div>';//highlights-wrapper
					}

					$output .= '</div>';

			    endforeach;

			    wp_reset_postdata();  
			     
			    $output .= '</div>'; //end-themeum-video-post-style1
			}
		} elseif ($style == 'style2') {
		    if(count($posts)>0){

		    	$output .= '<div class="themeum-video-post-style2 '.$class.'">';
		    	
				$j=1;
				$x=0;
		    	$total_post = count($posts);
		    	$difference = 12/$column;
			    foreach ($posts as $post): setup_postdata($post);

			    	if( $j==1 || $x == $difference ){
			    		$output .= '<div class="row">';	
			    		$x=0;
			    	}
			    	
				    $output .= '<div class="col-md-'.$column.' col-sm-12">';
				    $output .= '<div class="themeum-video-post-item themeum-video-post-item-style2" style="margin-top: 15px!important">';
				    if ( has_post_thumbnail() ) {	
					    $output .= '<div class="themeum-default-wrapper themeum-video-post-wrapper themeum-video-post-wrapper-style2 themeum-overlay-wrap '.esc_attr($overlay).'">';
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'video-thumb', array('class' => 'vc_gitem-zone img-responsive img-video')).'<i class="fa fa-play"></i></a>';
						$output .= '</div>';//highlights-wrapper
					} else {
					    $output .= '<div class="themeum-default-wrapper themeum-video-post-wrapperInitial themeum-video-post-wrapper-style2 themeum-overlay-wrap no-image">';
					    $output .= '<a href="'.get_permalink().'"><i class="fa fa-play"></i></a>';
						$output .= '</div>';//highlights-wrapper
					}
					$output .= '<span class="entry-category blockCategory">';
					$output .= get_the_category_list(', ');
					$output .= '</span>';
					$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. wp_trim_words( get_the_title(), 5, "..." ) .'</a></h3>';
					$output .= '<p class="entry-textHome">'. wp_trim_words( get_the_content(), 18, "..." ) .'</p>';
					$output .= '<i class="fa fa-eye viewsHome">'.'</i>';
					$output .= '<div class="post-views post-' . $post_id . ' entry-meta colorView">
							   ' . ($options['display_style']['icon'] && $icon_class !== '' ? $icon : '') . '
							   ' . ($options['display_style']['text'] ? '<span class="post-views-label">' . $label . ' </span>' : '') . '
							   <span class="post-views-count">' . number_format_i18n( pvc_get_post_views( $post->URL ) ) . '</span>
							   </div>';		
					$output .= '</div>';// style2
					$output .= '</div>';//col

					if( $x == ($difference-1) || $total_post == $j ){
						$output .= '</div>'; //row
						
					}
					$x++;
					$j++;
					
			    endforeach;

			    wp_reset_postdata();   
			    
			    $output .= '</div>'; //end-themeum-video-post-style2
			}
		} else {
			$output .= 'Please select any Style';
		}
	return $output;

});

function themeum_get_cat(){
	$cat_lists = get_categories();
	$all_cat_list = array('All Category'=>'');
	foreach($cat_lists as $cat_list){
		$all_cat_list[$cat_list->cat_name] = $cat_list->cat_name;
	}
	return $all_cat_list;
}

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Video Post", "themeum"),
		"base" => "themeum_video_post",
		'icon' => 'icon-thm-video_post',
		"class" => "",
		"description" => __("Widget Title Heading", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(				

			array(
				"type" => "dropdown",
				"heading" => __("Style", "themeum"),
				"param_name" => "style",
				"value" => array('Select'=>'','Style 1'=>'style1','Style 2'=>'style2'),
			),	

			array(
				"type" => "dropdown",
				"heading" => __("Image Overlay", "themeum"),
				"param_name" => "overlay",
				"value" => array('Select'=>'','YES'=>'yes','NO'=>'no'),
			),				

			array(
				"type" => "dropdown",
				"heading" => __("Category Filter", "themeum"),
				"param_name" => "category",
				"value" => themeum_get_cat(),
				),	

			array(
				"type" => "textfield",
				"heading" => __("Number of items", "themeum"),
				"param_name" => "number",
				"value" => "",
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Select Column", "themeum"),
				"param_name" => "column",
				"value" => array('Select'=>'','Column 2'=>'6','Column 3'=>'4','Column 4'=>'3','Column 1'=>'12'),
				),			

			array(
				"type" => "dropdown",
				"heading" => __("OderBy", "themeum"),
				"param_name" => "order_by",
				"value" => array('Select'=>'','Date'=>'date','Title'=>'title','Modified'=>'modified','Author'=>'author','Random'=>'rand'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Order", "themeum"),
				"param_name" => "order",
				"value" => array('Select'=>'','DESC'=>'DESC','ASC'=>'ASC'),
				),							

			array(
				"type" => "textfield",
				"heading" => __("Custom Class", "themeum"),
				"param_name" => "class",
				"value" => "",
				),	

			)

		));
}