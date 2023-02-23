<?php
/*--------------------------------------------------------------------------------------*\
| Enqueue ALL js and css files
| https://wordpress.stackexchange.com/questions/276890/how-to-enqueue-every-script-in-a-folder-automatically/276897
\*--------------------------------------------------------------------------------------*/
function enqueue_my_scripts(){

	$excludes = array('editor.js', 'test.js');

    	foreach( glob( get_template_directory(). '/assets/js/*.js' ) as $file ) {

 		$filename = substr($file, strrpos($file, '/') + 1);

		if(!in_array($filename, $excludes)){

        		wp_enqueue_script( $filename, get_template_directory_uri().'/assets/js/'.$filename);

		}   

	}

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



