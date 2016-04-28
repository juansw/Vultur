<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Register post type Club
 * @author Themeum
 * @return void
 */
function themeum_post_type_club(){
	$labels = array(
		'name'                	=> _x( 'Riders Ranking', 'Club', 'themeum-soccer' ),
		'singular_name'       	=> _x( 'Riders', 'Club', 'themeum-soccer' ),
		'menu_name'           	=> __( 'Riders Ranking', 'themeum-soccer' ),
		'parent_item_colon'   	=> __( 'Parent Club:', 'themeum-soccer' ),
		'all_items'           	=> __( 'All Riders', 'themeum-soccer' ),
		'view_item'           	=> __( 'View Rider', 'themeum-soccer' ),
		'add_new_item'        	=> __( 'Add New Rider', 'themeum-soccer' ),
		'add_new'             	=> __( 'New Rider', 'themeum-soccer' ),
		'edit_item'           	=> __( 'Edit Rider', 'themeum-soccer' ),
		'update_item'         	=> __( 'Update Rider', 'themeum-soccer' ),
		'search_items'        	=> __( 'Search Rider', 'themeum-soccer' ),
		'not_found'           	=> __( 'No article found', 'themeum-soccer' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-soccer' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> true,
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> 'dashicons-groups',
		'supports'           	=> array( 'title','editor','thumbnail' )
		);

	register_post_type('club',$args);

}

add_action('init','themeum_post_type_club');


/**
 * View Message When Club
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_club_update_message( $messages ){
	
	global $post, $post_ID;

	$message['club'] = array(
		0 => '',
		1 => sprintf( __('Rider updated. <a href="%s">View Rider</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-soccer' ),
		3 => __('Custom field deleted.', 'themeum-soccer' ),
		4 => __('Rider updated.', 'themeum-soccer' ),
		5 => isset($_GET['revision']) ? sprintf( __('Rider restored to revision from %s', 'themeum-soccer' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Rider published. <a href="%s">View Rider</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Rider saved.', 'themeum-soccer' ),
		8 => sprintf( __('Rider submitted. <a target="_blank" href="%s">Preview Rider</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Rider scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Rider</a>', 'themeum-soccer' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Rider draft updated. <a target="_blank" href="%s">Preview Rider</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}
add_filter( 'post_updated_messages', 'themeum_club_update_message' );