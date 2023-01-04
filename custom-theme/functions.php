<?php
/*--------------------------------------------------------------------------------------*\
| INCLUDES
\*--------------------------------------------------------------------------------------*/
require get_template_directory() . '/inc/config.php';
require get_template_directory() . '/inc/theme-options.php';

require get_template_directory() . '/inc/acf_settings.php';
require get_template_directory() . '/inc/add_blocks.php';


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
	wp_dequeue_style( 'global-styles-inline-css' );
    wp_dequeue_style( 'wc-blocks-style' ); 
 	wp_dequeue_style( 'global-styles' );
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );





/*--------------------------------------------------------------------------------------*\
| ADD SETTINGS PAGE 
\*--------------------------------------------------------------------------------------*/
function my_acf_setting_init() {
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'Settings',
			'menu_title'	=> 'Settings',
			'menu_slug' 	=> 'Settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false,
			'position'		=> '2',
			'icon_url'		=> 'dashicons-admin-generic
			'
		));
	}
}
add_action('acf/init', 'my_acf_setting_init');
/*--------------------------------------------------------------------------------------*\
| ADD COLOURS PAGE 
\*--------------------------------------------------------------------------------------*/
function my_acf_colour_init() {
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'Colours',
			'menu_title'	=> 'Colours',
			'menu_slug' 	=> 'Colours',
			'capability'	=> 'edit_posts',
			'redirect'		=> false,
			'position'		=> '3',
			'icon_url'		=> 'dashicons-admin-appearance'
		));
	}
}
add_action('acf/init', 'my_acf_colour_init');

/*--------------------------------------------------------------------------------------*\
| ADD COLOURS & SETTINGS TO ADMIN BAR 
\*--------------------------------------------------------------------------------------*/
function wpb_custom_toolbar_link($wp_admin_bar) {

	if( function_exists('acf_add_options_page') ) {
		$args = array(
			'title' => 'Settings', 
			'href' => '/wp-admin/admin.php?page=Settings', 
		);
		$wp_admin_bar->add_node($args);

		$args2 = array(
			'title' => 'Colours', 
			'href' => '/wp-admin/admin.php?page=Colours', 
		);
		$wp_admin_bar->add_node($args2);
 	}
}
add_action('admin_bar_menu', 'wpb_custom_toolbar_link', 999);



/*--------------------------------------------------------------------------------------*\
| LOAD COLOURS INTO BLOCK
\*--------------------------------------------------------------------------------------*/
function acf_load_color_field_choices( $field ) {
	
	if( function_exists('acf_add_options_page') ){

		$field["choices"] = array();

		if( have_rows("theme_colours", "option") ) {
			while( have_rows("theme_colours", "option") ) {

				the_row();
				$value = get_sub_field("color_value");
				$label = get_sub_field("color_name");
				$field['choices'][ $value ] = $label;

			}
		}

		return $field;

	}
}
add_filter("acf/load_field/name=backgroundColor", "acf_load_color_field_choices");


/*--------------------------------------------------------------------------------------*\
| LOAD COLOURS INTO INLINE CSS & EDITOR COLOUR PALETTE
\*--------------------------------------------------------------------------------------*/
function theme_colours(){   

	if( have_rows('colours', 'option') ): 

			$default_text_color = get_field('default_text_color');
			$accent_text_color_one = get_field('accent_text_color_one');
			$accent_text_color_two = get_field('accent_text_color_two');
			$accent_text_color_three = get_field('accent_text_color_three');
			$default_background_color = get_field('default_background_color');
			$accent_background_color_one = get_field('accent_background_color_one');
			$accent_background_color_two = get_field('accent_background_color_two');
			$accent_background_color_three = get_field('accent_background_color_three');
			$default_filled_button_text_color = get_field('default_filled_button_text_color');
			$default_filled_button_background_color = get_field('default_filled_button_background_color');
			$default_outlined_button_text_color = get_field('default_outlined_button_text_color');
			$default_outlined_button_background_color = get_field('default_outlined_button_background_color');

	endif; ?>
 
    <style>
        :root{
          	<?php 
                    echo "default-text-color:" . $default_text_color . ";";
					echo "accent-text-color-one:" . $accent_text_color_one . ";";
					echo "accent-text-color-two:" . $accent_text_color_two . ";";
					echo "accent-text-color-three:" . $accent_text_color_three . ";";
					echo "default-background-color:" . $default_background_color . ";";
					echo "accent-background-color-one:" . $accent_background_color_one . ";";
					echo "accent-background-color-two:" . $accent_background_color_two . ";";
					echo "accent-background-color-three:" . $accent_background_color_three . ";";
					echo "default-filled-button-text-color:" . $default_filled_button_text_color . ";";
					echo "default-filled-button-background-color:" . $default_filled_button_background_color . ";";
					echo "default-outlined-button-text-color:" . $default_outlined_button_text_color . ";";
					echo "default-outlined-button-background-color:" . $default_outlined_button_background_color . ";";
            ?>
        }
    </style>
<?php }
add_action('wp_head','theme_colours');



function color_palette(){

	if( have_rows('theme_colours', 'option') ): 
		
		$color_array = array();

		while( have_rows('theme_colours', 'option') ) : the_row();

			$text_option = get_sub_field('color_name', 'option');
			$color_option = get_sub_field('color_value');
			$color_array[] = array(
					'name'  => __( $text_option ),
					'slug'  => __( $text_option ),
					'color' => __( $color_option ),
			);
	
		endwhile; 
	
		add_theme_support( 'editor-color-palette', $color_array );

	endif;
}
add_action( 'after_setup_theme', 'color_palette' );



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
	unregister_block_pattern_category('buttons');
	unregister_block_pattern_category('columns');
	unregister_block_pattern_category('gallery');
	unregister_block_pattern_category('header');
	unregister_block_pattern_category('text');
	unregister_block_pattern_category('uncategorized');
}
add_action('after_setup_theme', 'removeCorePatterns');


