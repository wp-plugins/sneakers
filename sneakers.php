<?php
/*

Plugin Name: Sneakers CSS3 Collapsible Panels
Version: 1.0
Author URI:
Plugin URI: http://webtechforce.com/sneakers/
Description:  Simply add visually appealing Collapsible Panels in any direction of screen w/o use jQuery. Supports shortcode, custom colors, 12 different location on screen.
Author: Gangesh Matta

*/


define ('SNEAKERS_VERSION', '1.0');
define( 'SNEAKERS_URL', plugin_dir_url( __FILE__ ) );
define ('SNEAKERS_DIR', plugin_dir_path( __FILE__ )  );
define( 'SNEAKERS_BASENAME', plugin_basename( __FILE__ ) );

add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( 'init.php' );
    }
}


require_once('inc/metaboxes.php');

function sneaker_function() {
    
	 global $post;
	 
	 $list_sneakers = get_post_meta( $post->ID, '_cmb_post_multicheckbox', false );
	 	
	 $args = array( 'post_type' => 'sneaker');

	 $myposts = get_posts( $args );


foreach ( $myposts as $post1 ) : setup_postdata( $post1 ); 
	
	 $disp='';
      

 $text1 = get_post_meta( $post1->ID, '_cmb_test_image', true );
 $position = get_post_meta( $post1->ID, '_cmb_area_radio', true ); 
 $text2 = get_post_meta($post1->ID, '_cmb_test_textsmall', true);
 $content_font_color = get_post_meta($post1->ID, '_cmb_content_font_color', true);
 $shortcode =  get_post_meta($post1->ID, '_cmb_test_shortcode', true);
$strip_color = get_post_meta($post1->ID, '_cmb_strip_color', true);
$font_color = get_post_meta($post1->ID, '_cmb_font_color', true);
$strip_icon = get_post_meta($post1->ID, '_cmb_strip_icon', true);
$strip_icon_color = get_post_meta($post1->ID, '_cmb_strip_icon_color', true);
$post_types = get_post_meta( $post1->ID, '_cmb_postype_multicheckbox', false );
$front_page = get_post_meta( $post1->ID, '_cmb_front_checkbox', true );
$align_var = '_cmb_alignment_'.$position;
$alignment = get_post_meta( $post1->ID, $align_var, true );

 

if($strip_color) { } else { $strip_color= 'blue'; }
if($content_font_color) {} else { $content_font_color = "#333"; }		
	  
	  $disp.= '<div class="collapsible-container test ' .$strip_color. ' '  . $position .'side sneak-'.$position. '-' .$alignment.' "> 
            
            
            
								
                	<input name="collapsible-'.$post1->ID.'" type="checkbox" id="collapsible-'.$post1->ID.'" />
					<label for="collapsible-'.$post1->ID.'" style="color:'.$font_color.'"><i style="color:'.$strip_icon_color.'" class="fa '.$strip_icon.'"></i>' . $post1->post_title . '</label>
					<article   style="font-color:'.$content_font_color.'!important; background-image:url('.$text1.'); background-size: 100%; background-repeat:no-repeat; background-color:'.$text2.'" class="collapsible-panel sneak">';

	$disp.= '<p>' . get_the_content();
	if($position) { 	$disp.= do_shortcode( $shortcode ); }

	$disp.= ' </p>  </article>    </div>';

	 if(in_array(get_post_type(), $post_types) && !is_front_page()) 
		 {	 
			echo $disp; 
		}

	  elseif(in_array ($post1->ID, $list_sneakers))
		 {	
		  echo $disp; 
		  }
	  elseif($front_page =="on" && is_front_page() ) 
		  {
		  echo $disp;
		  }
	else	  
		  {}

	 endforeach; 

	 wp_reset_postdata();



	 
	// var_dump ( $text );

}
add_action('wp_footer', 'sneaker_function', 100);

function head_code()
{

$render_here = '<!--[if lt IE 9]>
<script src="'. SNEAKERS_DIR. '/js/html5.js" type="text/javascript"></script>
<![endif]-->
<!--[if lte IE 8]>
	<style> .collapsible-container { display: none} </style>
	<script src="'. SNEAKERS_DIR. 'js/html5.js"></script><![endif]-->

<!--[if IE 6]>
<style> .collapsible-container { display: none} </style>
<![endif]-->
<!--[if IE 7]>
<style> .collapsible-container { display: none} </style>
<![endif]-->';

echo $render_here;

}
add_action('wp_head', 'head_code', 100);

function sneakers_style() {
	wp_enqueue_style( 'sneakers-stlye', SNEAKERS_URL. 'sneakers.css' );
}

add_action( 'wp_enqueue_scripts', 'sneakers_style' );



function sneakers_admin_load_scripts($hook) {
    if( $hook != 'post.php' && $hook != 'post-new.php' ) 
        return;
 
    wp_enqueue_script( 'sneakers-js', SNEAKERS_URL."/js/sneaker.js" );
}

add_action('admin_enqueue_scripts', 'sneakers_admin_load_scripts');


add_action('init', 'register_my_sneakers');

function register_my_sneakers() {

register_post_type('sneaker', array(
'label' => 'Sneakers',
'description' => '',
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'capability_type' => 'post',
'map_meta_cap' => true,
'hierarchical' => false,
'rewrite' => array('slug' => 'sneaker', 'with_front' => true),
'query_var' => true,
'exclude_from_search' => true,

'supports' => array('title','editor','custom-fields','revisions'),
'labels' => array (
  'name' => 'Sneakers',
  'singular_name' => 'Sneaker',
  'menu_name' => 'Sneakers',
  'add_new' => 'Add Sneaker',
  'add_new_item' => 'Add New Sneaker',
  'edit' => 'Edit',
  'edit_item' => 'Edit Sneaker',
  'new_item' => 'New Sneaker',
  'view' => 'View Sneaker',
  'view_item' => 'View Sneaker',
  'search_items' => 'Search Sneakers',
  'not_found' => 'No Sneakers Found',
  'not_found_in_trash' => 'No Sneakers Found in Trash',
  'parent' => 'Parent Sneaker',
)
) ); }