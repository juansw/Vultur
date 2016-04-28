<?php

add_shortcode( 'themeum_smart_link', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 					=> '',
		'image' 					=> '',
		'texto'						=> '',
		'btn_url' 					=> '',
		'height' 					=> '150px',
		'class'						=> '',
		'style'   					=> 'style1',
		), $atts));

		$style = '';
		$style2 = '';
		$src_image   = wp_get_attachment_image_src($image, 'blog-full');
		if ($height)
		{
			$style .= 'height:'.(int)$height.'px;';		
		}
		if ($src_image)
		{
			$style .= 'background-image:url('.esc_url($src_image[0]).'); background-repeat: no-repeat; background-size: cover;';	
		}	

		$output = '';

	    $output .= '<div class="themeum-smart-link '.esc_attr($class).'" style="'.$style.'">';
		if ($title)
		{
			$output .= '<div class="smart-link-title pull-left">' . esc_attr($title) . '</div>';
		}
		if ($btn_url)
		{
			$output .= '<div class="pull-right" style="'.$style1.'"><a class="btn-smar-link" href="' . esc_url($btn_url) . '"><i class="fa fa-chevron-right"></i></a></div>';
		}	
		$output .= '<div class="clearfix"></div>';	
		$output .= '</div>';
		//$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
		//$output .= '<p class="entry-textHome smartLink">Cupim brisket shank, prosciutto porchetta kevin jowl ham hock frankfurter chuck...</p>';
		//$output .= '<i class="fa fa-eye viewsHome">'.'</i>';	

		if ($height)
		{
			$style2 = 'line-height:'.(int)$height.'px;';		
		}	

		if ($src_image)
		{
			$style .= 'background-image:url('.esc_url($src_image[0]).'); background-repeat: no-repeat; background-size: cover;';	
		}	

		$output = '';

	    $output .= '<div class="themeum-smart-link themeum-overlay-wrap yes '.esc_attr($class).'" style="'.$style.'">';
		if ($title)
		{
			$output .= '<div class="smart-link-title pull-left">' . esc_attr($title) . '</div>';
		}
		if ($btn_url)
		{
			$output .= '<a class="btn-smar-link" href="' . esc_url($btn_url) . '"><div class="pull-right" style="'.$style2.'"><i class="fa fa-chevron-right" style="color:#000!important;"></i></div></a>';
		}	
		$output .= '<div class="clearfix"></div>';	
		$output .= '</div>';
		//$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
		$output .= '<p class="entry-textHome smartLink">'. wp_trim_words( esc_attr($texto), 18, "..." ) .'</p>';
		//$output .= '<i class="fa fa-eye viewsHome">'.'</i>';
		//$output .= '<div class="post-views post-' . $post_id . ' entry-meta colorView">
							   //' . ($options['display_style']['icon'] && $icon_class !== '' ? $icon : '') . '
							   //' . ($options['display_style']['text'] ? '<span class="post-views-label">' . $label . ' </span>' : '') . '
							   //<span class="post-views-count">' . number_format_i18n( pvc_get_post_views( $post->ID )) . '</span>
							   //</div>';		

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Smart Link", "themeum"),
	"base" => "themeum_smart_link",
	'icon' => 'icon-thm-smart-link',
	"class" => "",
	"description" => __("Call to action shortcode.", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(
		
		array(
				"type" => "dropdown",
				"heading" => __("Style", "themeum"),
				"param_name" => "style",
				"value" => array('Select'=>'','Style 1'=>'style1','Style 2'=>'style2'),
			),
			
		array(
			"type" => "attach_image",
			"heading" => __("Background Image", "themeum"),
			"param_name" => "image",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Title", "themeum"),
			"param_name" => "title",
			"value" => ""
			),
			
		array(
			"type" => "textfield",
			"heading" => __("Descripción", "themeum"),
			"param_name" => "texto",
			"value" => "",
			),
				
		array(
			"type" => "textfield",
			"heading" => __("Button Url", "themeum"),
			"param_name" => "btn_url",
			"value" => ""
			),

		array(
			"type" => "textfield",
			"heading" => __("Button Height Ex. 150px", "themeum"),
			"param_name" => "height",
			"value" => "",
			),


		array(
			"type" => "textfield",
			"heading" => __("Class", "themeum"),
			"param_name" => "class",
			"value" => ""
			),		

		)
	));
}