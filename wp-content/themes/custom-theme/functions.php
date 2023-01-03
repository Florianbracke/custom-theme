<?php
/*--------------------------------------------------------------------------------------*\
| INCLUDES
\*--------------------------------------------------------------------------------------*/
require get_template_directory() . '/inc/config.php';
require get_template_directory() . '/inc/theme-options.php';
require get_template_directory() . '/template-parts/block-patterns.php';



/*--------------------------------------------------------------------------------------*\
| ENQUEUE STYLES
\*--------------------------------------------------------------------------------------*/
function styles_load() {
    wp_enqueue_style( 'variables-css', get_template_directory_uri() . '/assets/css/variables.css');
    wp_enqueue_style( 'structural-csss', get_template_directory_uri() . '/assets/css/structural.css', ['variables-css'] );
    wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/assets/css/custom.css', ['variables-css'] );
	wp_enqueue_style( 'header-css', get_template_directory_uri() . '/assets/css/header.css', ['variables-css'] );
	wp_enqueue_style( 'footer-css', get_template_directory_uri() . '/assets/css/footer.css', ['variables-css'] );
    wp_enqueue_style( 'style-editor-css', get_template_directory_uri() . '/assets/css/style-editor.css', ['variables-css'] );
	wp_enqueue_style( 'style-editor-frontend-css', get_template_directory_uri() . '/assets/css/style-editor-frontend.css', ['variables-css'] );

}
add_action( 'wp_print_styles', 'styles_load' ); 



/*--------------------------------------------------------------------------------------*\
| REMOVE GUTENBERG CSS
\*--------------------------------------------------------------------------------------*/
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

/*--------------------------------------------------------------------------------------*\
| ADD OPTION PAGE -> NEED ACF 
\*--------------------------------------------------------------------------------------*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Consero settings',
		'menu_title'	=> 'Consero settings',
		'menu_slug' 	=> 'Consero settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position'		=> '2',
		'icon_url'		=> 'dashicons-clock'
	));
}

function wpb_custom_toolbar_link($wp_admin_bar) {
	if( function_exists('acf_add_options_page') ) {
	     	$args = array(
			'title' => 'Consero settings', 
		 	'href' => '/wp-admin/admin.php?page=Consero+settings', 
	     	);

	     	$wp_admin_bar->add_node($args);
 		}
}
add_action('admin_bar_menu', 'wpb_custom_toolbar_link', 999);



/*--------------------------------------------------------------------------------------*\
| STYLE ACF OPTIONS PAGE
\*--------------------------------------------------------------------------------------*/
if( function_exists('acf_add_options_page') ) {
	function my_acf_admin_head() {
	    ?>
	    <style type="text/css">
			.postbox > div.acf-fields > div.acf-field > .acf-label{
				padding: 8px;
				background: #d6d5bf;
			}
			.acf-field{
				background: #f8f8f4;
			}
		.acf-postbox > .-top > .acf-field, .acf-postbox > .-top > .acf-field-group{
				background: #e9e9df;
			}
	    </style>
	    <?php
	}
	add_action('acf/input/admin_head', 'my_acf_admin_head');
}
	



/*--------------------------------------------------------------------------------------*\
| REMOVE UNNECESAIRY ADMIN BAR ITEMS
\*--------------------------------------------------------------------------------------*/
function custom_toolbar_link($wp_admin_bar) {

	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('updates');
	
}
add_action('admin_bar_menu', 'custom_toolbar_link', 999);


/*--------------------------------------------------------------------------------------*\
| CUSTOM EDITOR STYLES
\*--------------------------------------------------------------------------------------*/
function editor_styles_scripts() {
	wp_enqueue_script( 'be-editor', get_stylesheet_directory_uri() . '/assets/editor.js', array( 'wp-blocks', 'wp-dom' ),
	filemtime( get_stylesheet_directory() . '/assets/editor.js' ), true );  

	add_theme_support( 'editor-styles' );
	add_editor_style( '/assets/css/style-editor.css' ); 

}
//add_action( 'after_setup_theme', 'editor_styles_css' );



/*--------------------------------------------------------------------------------------*\
| ADD REUSABLE BLOCKS TO ADMIN BAR
\*--------------------------------------------------------------------------------------*/
add_action( 'admin_menu', 'reusable_blocks_link_wp_admin' );
function reusable_blocks_link_wp_admin() {
    add_menu_page( 'linked_url', 'Reusable Blocks', 'read', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
}


/*--------------------------------------------------------------------------------------*\
| FUNCTION REUSABLE BLOCKS TO FRONTEND
\*--------------------------------------------------------------------------------------*/
function get_reusable_block( $block_id ){
	
	$reuse_block = get_post( $block_id ); 
	
	if( $reuse_block == null ) return '';
	
	$reuse_block_content = apply_filters( 'the_content', $reuse_block->post_content);
	
	return $reuse_block_content;
}	

/*--------------------------------------------------------------------------------------*\
| ADD AND REMOVE BLOCK PATTERN CATEGORIES
\*--------------------------------------------------------------------------------------*/
function removeCorePatterns() {
    	remove_theme_support('core-block-patterns');
	unregister_block_pattern_category('buttons');
	unregister_block_pattern_category('columns');
	unregister_block_pattern_category('gallery');
	unregister_block_pattern_category('header');
	unregister_block_pattern_category('text');
	unregister_block_pattern_category('uncategorized');
}
add_action('after_setup_theme', 'removeCorePatterns');



/*--------------------------------------------------------------------------------------*\
| CREATE POST OBJECT, AUTOMATIC COOKIE/PRIVACY/...
\*--------------------------------------------------------------------------------------*/
// automatically create options page + data for privacy policy, cookie policy, ...
function add_pages() {
	if( get_field('gegevens','option')){

		$directory = get_stylesheet_directory() . "/template-parts/pages/";
		$filecount = count(glob($directory . "*"));

		if ( !get_option('run_only_once_1') ){

			for ($x = 1; $x <= $filecount; $x++) {

				require get_stylesheet_directory() . "/template-parts/pages/page-{$x}.php";

				$page = array(
					'post_title'    => "$post_title",
					'post_content'  => "$post_content",
					'post_status'   => 'publish',
					'post_type'		=> 'page',
				);

				wp_insert_post( $page );
				add_option('run_only_once_111111011111011', 1); 

			}
		} 
	}
}

//add_action( 'after_setup_theme', 'add_pages' );
	
