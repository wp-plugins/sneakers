<?php 

function content_area_metaboxes( $meta_boxes ) {
    $prefix = '_cmb_'; // Prefix for all fields
    $meta_boxes['test_metabox'] = array(
        'id' => 'test_metabox',
        'title' => 'Content Area',
        'pages' => array('sneaker'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Background image',
    'desc' => 'Upload an image or enter an URL.',
    'id' => $prefix . 'test_image',
    'type' => 'file',
    'save_id' => false, // save ID using true
    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
            ),
				
			array(
				'name'    => __( 'Background color', 'cmb' ),
				'desc'    => __( '', 'cmb' ),
				'id'      => $prefix . 'test_textsmall',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
				array(
				'name'    => __( 'Font color', 'cmb' ),
				'desc'    => __( '', 'cmb' ),
				'id'      => $prefix . 'content_font_color',
				'type'    => 'colorpicker',
				'default' => '#333'
			),
			
        )
    );

    return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'content_area_metaboxes' );


function strip_metaboxes( $meta_boxes ) {
    $prefix = '_cmb_'; // Prefix for all fields
    $meta_boxes['test6_metabox'] = array(
        'id' => 'test6_metabox',
        'title' => 'Strip Design',
        'pages' => array('sneaker'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
           		array(
    'name' => 'Select Strip Color',
    'desc' => '',
    'id' => $prefix . 'strip_color',
    'type' => 'select',
    'options' => array(
        array('name' => 'Green', 'value' => 'green'),
        array('name' => 'Blue', 'value' => 'blue'),
        array('name' => 'Orange', 'value' => 'orange'),
	    array('name' => 'Grey', 'value' => 'grey'),
        array('name' => 'Dark', 'value' => 'dark'),
		array('name' => 'Pink', 'value' => 'pink')
    )
),
			array(
    'name' => 'Font color',
    'desc' => '',
    'id' => $prefix . 'font_color',
    'type' => 'colorpicker',
	'default' => '#333'
),

      		array(
    'name' => 'Font-Awesome icon code',
    'desc' => '<a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Find icon codes</a>',
    'id' => $prefix . 'strip_icon',
    'type' => 'text_medium'
),
	
		array(
    'name' => 'Icon color',
    'desc' => '',
    'id' => $prefix . 'strip_icon_color',
   'type' => 'colorpicker',
	'default' => '#333'
),

	)
	   );

    return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'strip_metaboxes' );


function shortcode_metaboxes( $meta_boxes ) {
    $prefix = '_cmb_'; // Prefix for all fields
    $meta_boxes['test5_metabox'] = array(
        'id' => 'shortcode_metabox',
        'title' => 'Add Shortcode',
        'pages' => array('sneaker'), // post type
        'context' => 'side',
        'priority' => 'low',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            				array(
    'name' => '',
    'desc' => '',
    'std' => '',
    'id' => $prefix . 'test_shortcode',
    'type' => 'textarea_code'
),
        )
    );

    return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'shortcode_metaboxes' );


function cmb_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type' => 'post',
        'numberposts' => 10,
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}




function sneakers_display_metaboxes( $meta_boxes ) {
    $prefix = '_cmb_'; // Prefix for all fields
    $meta_boxes['test1_metabox'] = array(
        'id' => 'test1_metabox',
        'title' => 'Sneaker(s)',
        'pages' => array('post','page'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name'    => 'Select Sneakers',
                'desc'    => '',
                'id'      => $prefix . 'post_multicheckbox',
                'type'    => 'multicheck',
                'options' => cmb_get_post_options( array( 'post_type' => 'sneaker', 'numberposts' => -1 ) ),
            ),
        )
    );

    return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'sneakers_display_metaboxes' );



function cmb_get_post_types(){

$args = array(
 'exclude_from_search' => false,
 'show_ui' => true
);

$post_options = array();
$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'

$post_types = get_post_types( $args, $output, $operator ); 


foreach ( $post_types  as $post_type ) {

if($post_type == 'attachment') { }

else {
    $post_options[$post_type] =  $post_type ;
}
}

return $post_options;
}




function display_area_metaboxes( $meta_boxes ) {
    $prefix = '_cmb_'; // Prefix for all fields
    $meta_boxes['test2_metabox'] = array(
        'id' => 'test3_metabox',
        'title' => 'Display Area',
        'pages' => array('sneaker'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
		
	array(
				'name' => __( 'Front Page', 'cmb' ),
				'desc' => __( '', 'cmb' ),
				'id'   => $prefix . 'front_checkbox',
				'type' => 'checkbox',
			),

		array(
                'name'    => 'Select Post-type(s)',
                'desc'    => '',
                'id'      => $prefix . 'postype_multicheckbox',
                'type'    => 'multicheck',
                'options' => cmb_get_post_types(),
            ),
		
		
		array(
    'name' => 'Select Display Area',
    'desc' => '',
    'id' => $prefix . 'area_radio',
    'type' => 'radio_inline',
    'options' => array(
           
        array('name' => 'Top', 'value' => 'top'),
        array('name' => 'Right', 'value' => 'right'),
        array('name' => 'Bottom', 'value' => 'bottom'),
        array('name' => 'Left', 'value' => 'left'),
    ) 
),
		 
array(
    'name' => 'Alignment',
    'desc' => '',
    'id' => $prefix . 'alignment_top',
    'type' => 'radio_inline',
    'options' => array(
        array('name' => 'Left', 'value' => 'left'),
        array('name' => 'Center', 'value' => 'center'),
		array('name' => 'Right', 'value' => 'right')                      
    )
	),

array(
    'name' => 'Alignment',
    'desc' => '',
    'id' => $prefix . 'alignment_right',
    'type' => 'radio_inline',
    'options' => array(
        array('name' => 'Top', 'value' => 'top'),
        array('name' => 'Center', 'value' => 'center'),
		array('name' => 'Bottom', 'value' => 'bottom')                      
    ) 
),


array(
    'name' => 'Alignment',
    'desc' => '',
    'id' => $prefix . 'alignment_bottom',
    'type' => 'radio_inline',
    'options' => array(
        array('name' => 'Left', 'value' => 'left'),
        array('name' => 'Center', 'value' => 'center'),
		array('name' => 'Right', 'value' => 'right')                      
  ) 
), 

		array(
    'name' => 'Alignment',
    'desc' => '',
    'id' => $prefix . 'alignment_left',
    'type' => 'radio_inline',
    'options' => array(
        array('name' => 'Top', 'value' => 'top'),
        array('name' => 'Center', 'value' => 'center'),
		array('name' => 'Bottom', 'value' => 'bottom')                     
   
		)

),


)
    );

    return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'display_area_metaboxes' );