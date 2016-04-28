<?php
add_shortcode( 'themeum_popular_post', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'category' 						=> '',
		'style' 						=> 'style1',
		'overlay' 						=> 'yes',
		'number' 						=> '6',
		'class' 						=> '',         
        'order'   						=> 'DESC',
        'post_type'        				=> 'posts',   
        'show_category'   				=> 'yes', 
        'show_author'   				=> 'no', 
        'show_date'   					=> 'yes',    
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
				'meta_key' => '_post_views_count',
    			'orderby' => 'meta_value_num',
		        'order' => $order,
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
 		}else{
 			echo "Please Enter a valid category name";
 			$args = 0;
 		}
 		}else{
			$args = array( 
				'meta_key' => '_post_views_count',
    			'orderby' => 'meta_value_num',
		        'order' => $order,
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
	 	}

		if ($style == 'style1') {

		    if(count($posts)>0){
		    	$output .= '<div class="highlights themeum-default-ul popular-items-wrap '.esc_attr($class).'">';
		    	$output .= '<div class="row">';
		    	$i=1;
			    foreach ($posts as $post): setup_postdata($post);

			    if($i==1){
			    	$output .= '<div class="highlights-item popular-items-wrap col-sm-12">';
			    	if ( has_post_thumbnail() ) {
					    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap '.esc_attr($overlay).'">';
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'destacado', array('class' => 'img-responsive destacado')).'</a>';
						
						$output .= '<div class="themeum-default-intro highlights-intro themeum-overlay">';	
						$output .= '<div class="themeum-overlay-inner">';
						if ( $show_category == 'yes'){
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
						}
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
						if ( $show_date == 'yes'){
							$output .= '<span class="entry-date"><i class="fa fa-calendar-o" style="margin-right: 5px;"></i>';
							$output .= get_the_date('d M Y');
							$output .= '</span>';	
						}		
						$output .= '</div>';//themeum-overlay-inner
						$output .= '</div>';//highlights-intro
						$output .= '</div>';//highlights-wrapper	
					}else {
						$output .= '<div class="themeum-default-wrapper highlights-wrapper">';
						$output .= '<div class="highlights-intro themeum-overlay-inner no-image">';
						if ( $show_category == 'yes'){
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
						}
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
						if ( $show_date == 'yes'){
							$output .= '<span class="entry-date"><i class="fa fa-calendar-o" style="margin-right: 5px;"></i>';
							$output .= get_the_date('d M Y');
							$output .= '</span>';	
						}		
						$output .= '</div>';//themeum-overlay-inner					
						$output .= '</div>';//highlights-wrapper
					}
					$output .= '</div>';    
					$output .= '<div class="clearfix"></div>'; 
			    }else {
				    $output .= '<div class="highlights-item popular-items-wrap col-sm-12">';
			    	if ( has_post_thumbnail() ) {
					    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap '.esc_attr($overlay).'">';
					    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'destacado', array('class' => 'img-responsive destacado')).'</a>';
						
						$output .= '<div class="themeum-default-intro highlights-intro themeum-overlay">';	
						$output .= '<div class="themeum-overlay-inner">';
						if ( $show_category == 'yes'){
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
						}
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
						if ( $show_date == 'yes'){
							$output .= '<span class="entry-date"><i class="fa fa-calendar-o" style="margin-right: 5px;"></i>';
							$output .= get_the_date('d M Y');
							$output .= '</span>';	
						}		
						$output .= '</div>';//themeum-overlay-inner
						$output .= '</div>';//highlights-intro
						$output .= '</div>';//highlights-wrapper	
					}else {
						$output .= '<div class="themeum-default-wrapper highlights-wrapper">';
						$output .= '<div class="highlights-intro themeum-overlay-inner no-image">';
						if ( $show_category == 'yes'){
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(', ');
							$output .= '</span>';
						}
						$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
						if ( $show_date == 'yes'){
							$output .= '<span class="entry-date"><i class="fa fa-calendar-o" style="margin-right: 5px;"></i>';
							$output .= get_the_date('d M Y');
							$output .= '</span>';	
						}		
						$output .= '</div>';//themeum-overlay-inner					
						$output .= '</div>';//highlights-wrapper
					}
					$output .= '</div>';    
					$output .= '<div class="clearfix"></div>'; 
				    
				}
				$i++;
			    endforeach;

			    wp_reset_postdata();   
			    $output .= '</div>';
			    $output .= '</div>';
			     
			}
		} elseif ($style == 'style2') {
		    if(count($posts)>0){
		    	$output .= '<ul class="themeum-default-ul popular-news-style2 '.$class.'">';
		    	$i=1;
			    foreach ($posts as $post): setup_postdata($post);



				    $output .= '<li class="popular-item popular-news-style2-item">';

				    $output .= '<div class="media">';
				    $output .= '<div class="popular-image pull-left">';
				    $output .= '<div class="themeum-overlay-wrap '.$overlay.'">';
				    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'post-into', array('class' => 'img-responsive')).'</a>';
				    $output .= '</div>';//image
				    $output .= '</div>';//image
				    
					$output .= '<div class="popular-news-intro media-body">';	
					if ( $show_category == 'yes'){
						$output .= '<span class="entry-category">';
						$output .= get_the_category_list(', ');
						$output .= '</span>';
					}
					$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
					$output .= '<p class="entry-textInto">'. wp_trim_words( get_the_content(), 18, "..." ) .'</p>';
					
					if ( $show_author == 'yes'){
						$output .= '<span class="author"><i class="fa fa-edit"></i>'.__('By ', 'themeum').''.get_the_author_link().'</span>';	
					}
					if ( $show_date == 'yes'){
						$output .= '<span class="entry-date"><i class="fa fa-calendar-o"></i>';
						$output .= get_the_date('d M Y');
						$output .= '</span>';	
					}		
					$output .= '</div>';//popular-intro
					$output .= '</div>';//popular-wrapper
					$output .= '</li>';

				$i++;
			    endforeach;

			    wp_reset_postdata();   
			    $output .= '</ul>';
			     
			}
		} else {
			$output .= 'Please select any Style';
		}

	return $output;

});

function themeum_all_cat_list_2(){
	$cat_lists = get_categories();
	$all_cat_list = array('All Category'=>'');
	foreach($cat_lists as $cat_list){
		$all_cat_list[$cat_list->cat_name] = $cat_list->cat_name;
	}
	return $all_cat_list;
}

function themeum_all_post_list_2(){
	$post_lists = get_posts();
	$all_post_list = array('All Posts'=>'');
	foreach($post_lists as $post_list){
		$all_post_list[$post_list->post_name] = $post_list->post_name;
	}
	return $all_post_list;
}

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Popular Post", "themeum"),
		"base" => "themeum_popular_post",
		'icon' => 'icon-thm-popular-post',
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
				"value" => themeum_all_cat_list_2(),
				),
				
			array(
				"type" => "dropdown",
				"heading" => __("Post Filter", "themeum"),
				"param_name" => "posts",
				"value" => themeum_all_post_list_2(),
				),	

			array(
				"type" => "textfield",
				"heading" => __("Number of items", "themeum"),
				"param_name" => "number",
				"value" => "",
				),			
				
			array(
				"type" => "dropdown",
				"heading" => __("Order", "themeum"),
				"param_name" => "order",
				"value" => array('Select'=>'','DESC'=>'DESC','ASC'=>'ASC'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Show Category", "themeum"),
				"param_name" => "show_category",
				"value" => array('Select'=>'','YES'=>'yes','NO'=>'no'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Show Author", "themeum"),
				"param_name" => "show_author",
				"value" => array('Select'=>'','YES'=>'yes','NO'=>'no'),
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Show Date", "themeum"),
				"param_name" => "show_date",
				"value" => array('Select'=>'','YES'=>'yes','NO'=>'no'),
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