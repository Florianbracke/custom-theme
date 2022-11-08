<?php
/*--------------------------------------------------------------------------------------*\
| Enqueue ALL js and css files
| https://wordpress.stackexchange.com/questions/276890/how-to-enqueue-every-script-in-a-folder-automatically/276897
\*--------------------------------------------------------------------------------------*/
function enqueue_my_scripts(){

    foreach( glob( get_template_directory(). '/assets/js/*.js' ) as $file ) {
 		$filename = substr($file, strrpos($file, '/') + 1);
        wp_enqueue_script( $filename, get_template_directory_uri().'/assets/js/'.$filename);
    }

    // foreach( glob( get_template_directory(). '/css/*.css' ) as $file ) {
 	// 	$filename = substr($file, strrpos($file, '/') + 1);
    //     wp_enqueue_style( $filename, get_template_directory_uri().'/css/'.$filename);
    // }

}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');


/*--------------------------------------------------------------------------------------*\
| Custom Theme Colors
\*--------------------------------------------------------------------------------------*/
function wiz_color_palette() {

		// Add support for a custom color scheme.
		add_theme_support( 'editor-color-palette', array(
            
			array(
				'name'  => __( 'Black'),
				'slug'  => 'black',
				'color' => '#1D1D1D',
			),
        	array(
				'name'  => __( 'Lighter Black'),
				'slug'  => 'lighter black',
				'color' => '#575757',
			),
			array(
				'name'  => __( 'Accent Black'),
				'slug'  => 'accent black',
				'color' => '#260818',
			),
        	array(
				'name'  => __( 'Gray'),
				'slug'  => 'Gray',
				'color' => '#343A40',
			),
			array(
				'name'  => __( 'Lighter Gray'),
				'slug'  => 'lighter gray',
				'color' => '#f0f0f0',
			),
			array(
				'name'  => __( 'White'),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'Dark Yellow'),
				'slug'  => 'dark yellow',
				'color' => '#FFBA00',
			),
			array(
				'name'  => __( 'Yellow'),
				'slug'  => 'Yellow',
				'color' => '#E5B217',
			),
			array(
				'name'  => __( 'Salmon'),
				'slug'  => 'Salmon',
				'color' => '#FF8366',
			),
			array(
				'name'  => __( 'Dark Salmon'),
				'slug'  => 'dark salmon',
				'color' => '#D34727',
			),
			array(
				'name'  => __( 'Light Salmon'),
				'slug'  => 'light salmon',
				'color' => '#EF8A6E',
			),
			array(
				'name'  => __( 'Brown'),
				'slug'  => 'brown',
				'color' => '#4D300B',
			),
			array(
				'name'  => __( 'Deep Brown'),
				'slug'  => 'deep brown',
				'color' => '#522E00',
			),

		) );

}
add_action( 'after_setup_theme', 'wiz_color_palette' );


/*--------------------------------------------------------------------------------------*\
| Add Class To Body
\*--------------------------------------------------------------------------------------*/
add_filter( 'body_class', function( $classes ) {
	$slug = get_post_field( 'post_name', get_post() );
    return array_merge( $classes, array( $slug ) );
} );


/*--------------------------------------------------------------------------------------*\
| Add FAQ-block
\*--------------------------------------------------------------------------------------*/

function my_acf_init_block_types() {

    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => '...',
            'title'             => __('...'),
            'description'       => __('A custom ... block'),
            'render_template'   => 'template-parts/blocks/block.php',
            'category'          => '...',
            'icon'              => 'admin-comments',
            'keywords'          => array( '...', '...', '...'),
        ));
    }
}
add_action('acf/init', 'my_acf_init_block_types');



/*--------------------------------------------------------------------------------------*\
| Add ACF-OPTIONSPAGE
\*--------------------------------------------------------------------------------------*/
function ACF_optionspage() {

	if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_636a22febcae7',
			'title' => 'Options page',
			'fields' => array(
				array(
					'key' => 'field_636a243b64401',
					'label' => 'Gegevens',
					'name' => 'gegevens',
					'type' => 'group',
					'instructions' => 'Vul hier de gegevens van je bedrijf in. Dit wordt aan de klanten getoont.',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layout' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_636a244d64402',
							'label' => 'Email',
							'name' => 'email',
							'type' => 'email',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
						),
						array(
							'key' => 'field_636a245464403',
							'label' => 'Telefoon nummer',
							'name' => 'telefoon_nummer',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_636a246c64404',
							'label' => 'Straat + nummer',
							'name' => 'straat_nummer',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_636a248164405',
							'label' => 'Gemeente + postcode',
							'name' => 'gemeente_postcode',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_636a258c8634f',
							'label' => 'Naam bedrijf',
							'name' => 'naam_bedrijf',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_636a23b4a16cf',
							'label' => 'Maatschappelijke zetel',
							'name' => 'maatschappelijke_zetel',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_636a23afa16ce',
							'label' => 'Ondernemingsnummer',
							'name' => 'ondernemingsnummer',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'settings',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'show_in_rest' => 0,
		));
	endif;		
}
add_action('acf/init', 'ACF_optionspage');


