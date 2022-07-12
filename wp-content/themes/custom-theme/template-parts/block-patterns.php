<?php 

add_action('init', function() {
	remove_theme_support('core-block-patterns');
});

/*--------------------------------------------------------------------------------------*\
| Register BLOG BLOCK PATTERN
\*--------------------------------------------------------------------------------------*/
function wpdocs_register_block_patterns() {

	register_block_pattern(
		'Wizarts/blog-block',

		[
			'categories' 	=> array( 'featured' ),
			'content'       => '(  .  Y  .  )',
			'description'   => 'Two blocks with images and decorations.',
			'keywords'      => array( 'blog', 'blog', 'block'),
			'title'         => 'Two blocks with images',
		],

	);
}
add_action( 'init', 'wpdocs_register_block_patterns' );


