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
| Add Class To Body
\*--------------------------------------------------------------------------------------*/
add_filter( 'body_class', function( $classes ) {
	$slug = get_post_field( 'post_name', get_post() );
   	return array_merge( $classes, array( $slug ) );
} );



