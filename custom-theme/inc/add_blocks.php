<?php 

/*--------------------------------------------------------------------------------------*\
|  BLOCK PATTERN
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
		   ]

	   );
   }
   
}
add_action( 'after_setup_theme', 'wpdocs_register_block_patterns' );



/*--------------------------------------------------------------------------------------*\
| ADD BLOCKS
\*--------------------------------------------------------------------------------------*/
function my_acf_init_block_types() {

    if( function_exists('acf_register_block_type') ) {

        $directory = get_stylesheet_directory() . "/template-parts/blocks/";
        $filecount = count(glob($directory . "*"));
    
       for ($x = 1; $x <= $filecount; $x++) {
        
            require get_stylesheet_directory() . "/template-parts/blocks/blok-$x.php";

            acf_register_block_type(array(
                'name'              => "$naam",
                'title'             => "$naam",
                'description'       => "$beschrijving",
                'render_template'   => "template-parts/blocks/blok-$x.php",
                'category'          => '...',
                'icon'              => 'admin-comments',
                'keywords'          => array( "$naam" ),
            ));
            
        }
    }
}
add_action('acf/init', 'my_acf_init_block_types');

