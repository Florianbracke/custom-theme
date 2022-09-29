<?php 


/*--------------------------------------------------------------------------------------*\
| Register BLOG BLOCK PATTERN
\*--------------------------------------------------------------------------------------*/
function wpdocs_register_block_patterns() {

 	$directory = get_stylesheet_directory() . "/template-parts/blockPatterns/";
	$filecount = count(glob($directory . "*"));

	for ($x = 1; $x <= $filecount; $x++) {

	  	require get_stylesheet_directory() . "/template-parts/blockPatterns/blok-{$x}.php";

		register_block_pattern(
			"Wizarts/{$naam}",

			[
				'content'       => "$block",
				'description'   => "$beschrijving",
				'title'         => "$beschrijving",
			],

		);
	}
	
}
add_action( 'after_setup_theme', 'wpdocs_register_block_patterns' );


