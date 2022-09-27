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
| ADD OPTION PAGE -> NEED ACF (PRO?)
\*--------------------------------------------------------------------------------------*/
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Openingsuren',
		'menu_title'	=> 'Openingsuren',
		'menu_slug' 	=> 'openingsuren',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position'		=> '2',
		'icon_url'		=> 'dashicons-clock'
));
}

// function wpb_custom_toolbar_link($wp_admin_bar) {
//     $args = array(
//         'title' => 'Openingsuren', 
//         'href' => '/wp-admin/admin.php?page=openingsuren', 
//     );

//     $wp_admin_bar->add_node($args);
// }
// add_action('admin_bar_menu', 'wpb_custom_toolbar_link', 999);
	


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
	wp_enqueue_script( 
        'be-editor',
        get_stylesheet_directory_uri() . '/assets/editor.js',
        array( 'wp-blocks', 'wp-dom' ), 
	    filemtime( get_stylesheet_directory() . '/assets/editor.js' ),
        true
	);  

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

	
