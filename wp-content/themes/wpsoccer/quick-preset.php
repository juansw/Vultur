<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $themeum_options;

$output = '';


	$link_color = esc_attr($themeum_options['link-color']);

if(isset($themeum_options['custom-preset-en']) && $themeum_options['custom-preset-en']) {

	if(isset($link_color)){
		$output .= '#main-menu .sub-menu li.active, #main-menu .nav>li>ul li:hover,#main-menu .nav>li.nav-myacount a,
		.wpcf7-form-control.wpcf7-submit,#comments .form-submit #submit,#navigation .navbar-header .navbar-toggle,
		
		.themeum-pagination .pagination>.active>a, .themeum-pagination .pagination>.active>a:focus, 
		.themeum-pagination .pagination>.active>a:hover, .themeum-pagination .pagination>.active>span, 
		.themeum-pagination .pagination>.active>span:focus, .themeum-pagination .pagination>.active>span:hover,
		.themeum-pagination .pagination>li>a:focus, .themeum-pagination .pagination>li>a:hover, .themeum-pagination .pagination>li>span:focus, 
		.themeum-pagination .pagination>li>span:hover,
		
		.highlights-intro .entry-category a,.popular-news-intro .entry-category a,.themeum-title .icon-bar,
		.gallery-controll .flex-direction-nav a,.gallery-controll-thumb .flex-direction-nav a,.breaking-news-title h2,
		#main-menu .nav .signup-signin a,.poll-submit,.player-share ul li a:hover,.match-comment-login,.point-table-head,.fixture-teams-list h3.fixture-title,
		.player-name-inner .more,.fixture-teams-list h3.fixture-title,.highlights-style2-item .entry-category a,
		.themeum-featured-control a,.player-carousel-control a,.themeum-smart-link .pull-right:hover,
		.flexslider .slides.gallery-thumb-image li:hover,.breaking-news-title h2:before,
		.latest-team .latest-team-a, .latest-team .latest-team-b,.goal-timeline ul.goal-timeline1:after,.goal-timeline ul.goal-timeline2:after,
		.honours-intro .pull-left, .btn.btn-style, #main-menu .nav>li.signup-signin>a:focus,.widget .tagcloud a,
		.entry-blog-meta ul li.category a,#sign-form form input.btn-block, .themeum-register, .themeum-reg,.slider2-title,.nav.club-details-tab-nav>li>a:after,
		.home-btn,.post-navigation .previous-post a, .post-navigation .next-post a,.woocommerce .product-thumbnail-outer .add_to_cart_button,
		.woocommerce .widget_price_filter .price_slider_amount .button,.woocommerce-page .widget_price_filter .price_slider_amount .button,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce-product-search input[type=submit],
		.product-thumbnail-outer-inner span.product-cat a,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, 
		.woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce input.button,
		.woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce-page nav.woocommerce-pagination ul li span.current,
		.woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current,
		.woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover,
		.woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
		.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:focus,
		.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus,.woocommerce .woocommerce-info,
		#navigation .woocommerce.widget_shopping_cart .buttons > a.wc-forward,.cart-has-products{ background-color: '. esc_attr($link_color) .';}';
		
		$output .= 'a,a:focus, sup.featured-post,.widget ul li a:hover, #footer .widget a:hover,.themeum-person .social-icon a:hover, #mobile-menu ul li:hover > a,
		#featured-ideas a:hover,#popular-ideas .details h4 a:hover,#popular-ideas .details .entry-meta a:hover,
		#mobile-menu ul li:hover > a, #mobile-menu ul li.active > a,#featured-ideas .navigation li.active a,


		.featured-wrap .share-btn, .match-detail-league-title,.themeum-social-button ul li a:hover,.themeum-recent-result-inner .clubnames .pull-right,
		#main-menu .nav>li.active>a,.themeum-video-post-wrapper:hover i,.themeum-default-intro .entry-title a:hover,.themeum-player .player-name a:hover,
		.highlights-style2-item h3 a:hover,.all-highlights-style2-item h3 a:hover,.themeum-featured-item h3 a:hover,
		.popular-news-intro .entry-title a:hover,.themeum-video-post-item-style2 .entry-title a:hover,
		#menu-secondary-menu.nav>li>a:focus, #menu-secondary-menu.nav>li>a:hover,.slider2-time,.slider2-counter,.home-search form#searchform:hover i,
		.home-search form#searchform:hover input::-webkit-input-placeholder,#navigation .woocommerce ul.cart_list li a{ color: '. esc_attr($link_color) .'; }';

		$output .= '.form-control:focus,.themeum-video-post-wrapper:hover i,.latest-team .latest-team-a:after,.latest-team .latest-team-b:before,
		.entry-blog-meta,.woocommerce div.product:hover .product-thumbnail-outer-inner,.woocommerce .woocommerce-message,
		.woocommerce.widget_shopping_cart .total,.woocommerce-page.widget_shopping_cart .total,.woocommerce .widget_shopping_cart .total,
		.woocommerce-page .widget_shopping_cart .total,.woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total{ border-color: '. esc_attr($link_color) .'; }';

		$output .= '.slider2-carousel-indicators-inner li.active,.slider2-carousel-indicators .nano > .nano-pane > .nano-slider{ background-color: rgba('.themeum_hex2rgb($link_color).',.65); }';
	}
}

if(isset($themeum_options['custom-preset-en']) && $themeum_options['custom-preset-en']) {
	
	if(isset($themeum_options['hover-color'])){
		$output .= 'a:hover, .widget.widget_rss ul li a{ color: '.esc_attr($themeum_options['hover-color']) .'!important; }';
		$output .= '.wpcf7-form-control.wpcf7-submit:hover,#main-menu .nav>li.nav-myacount a:hover,.wpb_tour_next_prev_nav a:hover,
		#navigation .navbar-header .navbar-toggle:hover, #navigation .navbar-header .navbar-toggle:focus,

		#main-menu .nav .signup-signin a:hover,.poll-submit:hover,.widget .tagcloud a:hover,#main-menu .nav>li.signup-signin>a:hover,a.home-btn:hover,
		.post-navigation .previous-post a:hover, .post-navigation .next-post a:hover,.woocommerce .product-thumbnail-outer .add_to_cart_button:hover,
		.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.product-thumbnail-outer-inner span.product-cat a:hover,
		.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
		.woocommerce a.button:hover,.woocommerce input.button:hover{ background: '.esc_attr($themeum_options['hover-color']) .'; }';
	}
}

echo $output;