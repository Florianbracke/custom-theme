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
    wp_enqueue_style( 'variables-css', get_template_directory_uri() . '/assets/css/variables.css', array(), filemtime( get_template_directory() . '/assets/css/variables.css' ));
    wp_enqueue_style( 'structural-csss', get_template_directory_uri() . '/assets/css/structural.css', ['variables-css'], filemtime( get_template_directory() .  '/assets/css/structural.css' ));
    wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/assets/css/custom.css', ['variables-css'] , filemtime( get_template_directory() . '/assets/css/custom.css' ));
	wp_enqueue_style( 'header-css', get_template_directory_uri() . '/assets/css/header.css', ['variables-css'] ,  filemtime( get_template_directory() . '/assets/css/header.css' ));
	wp_enqueue_style( 'footer-css', get_template_directory_uri() . '/assets/css/footer.css', ['variables-css'], filemtime( get_template_directory() . '/assets/css/footer.css'));
    wp_enqueue_style( 'style-editor-css', get_template_directory_uri() . '/assets/css/style-editor.css', ['variables-css'] , filemtime( get_template_directory() . '/assets/css/style-editor.css' ));
	wp_enqueue_style( 'style-editor-frontend-css', get_template_directory_uri() . '/assets/css/style-editor-frontend.css', ['variables-css'], filemtime( get_template_directory() .'/assets/css/style-editor-frontend.css' ));

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
	if( function_exists('acf_add_options_page') ){
		if( have_rows('colours', 'option') ): 
			while( have_rows('colours', 'option') ): the_row(); 
				$default_text_color = get_sub_field('default_text_color');
				$accent_text_color_one = get_sub_field('accent_text_color_one');
				$accent_text_color_two = get_sub_field('accent_text_color_two');
				$accent_text_color_three = get_sub_field('accent_text_color_three');
				$default_heading_text_color = get_sub_field('default_heading_text_color');
				$default_background_color = get_sub_field('default_background_color');
				$accent_background_color_one = get_sub_field('accent_background_color_one');
				$accent_background_color_two = get_sub_field('accent_background_color_two');
				$accent_background_color_three = get_sub_field('accent_background_color_three');
				$default_filled_button_text_color = get_sub_field('default_filled_button_text_color');
				$default_filled_button_background_color = get_sub_field('default_filled_button_background_color');
				$default_outlined_button_text_color = get_sub_field('default_outlined_button_text_color');
				$default_outlined_button_background_color = get_sub_field('default_outlined_button_background_color');
			endwhile;
		endif; ?>

	    <style>
		:root{
			<?php 
				echo "--text-color:" . $default_text_color . ";"; 
				echo "--text-one:" . $accent_text_color_one . ";";
				echo "--text-two:" . $accent_text_color_two . ";";
				echo "--text-three:" . $accent_text_color_three . ";";
				echo "--heading-color:" . $default_heading_text_color . ";"; 
				echo "--background-color:" . $default_background_color . ";";
				echo "--background-one:" . $accent_background_color_one . ";";
				echo "--background-two:" . $accent_background_color_two . ";";
				echo "--background-three:" . $accent_background_color_three . ";";
				echo "--filled-button-text:" . $default_filled_button_text_color . ";";
				echo "--filled-button-background:" . $default_filled_button_background_color . ";";
				echo "--outlined-button-text:" . $default_outlined_button_text_color . ";";
				echo "--outlined-button-background:" . $default_outlined_button_background_color . ";";
		    ?>
		}
	    </style> <?php 
		} 
	}
add_action('wp_head','theme_colours');



function color_palette(){
	if( function_exists('acf_add_options_page') ){	
		$color_array = array();

		if( have_rows('colours', 'option') ): 
			while( have_rows('colours', 'option') ): the_row(); 
				$default_text_color = get_sub_field('default_text_color');
				$accent_text_color_one = get_sub_field('accent_text_color_one');
				$accent_text_color_two = get_sub_field('accent_text_color_two');
				$accent_text_color_three = get_sub_field('accent_text_color_three');
				$default_heading_text_color = get_sub_field('default_heading_text_color');
				$default_background_color = get_sub_field('default_background_color');
				$accent_background_color_one = get_sub_field('accent_background_color_one');
				$accent_background_color_two = get_sub_field('accent_background_color_two');
				$accent_background_color_three = get_sub_field('accent_background_color_three');
				$default_filled_button_text_color = get_sub_field('default_filled_button_text_color');
				$default_filled_button_background_color = get_sub_field('default_filled_button_background_color');
				$default_outlined_button_text_color = get_sub_field('default_outlined_button_text_color');
				$default_outlined_button_background_color = get_sub_field('default_outlined_button_background_color');
			endwhile;
		endif; 



		if($default_text_color) : $color_array[] = array( 'name'  => __(  'default_text_color'  ),'slug'  => __(  'default_text_color'  ), 'color' => __( $default_text_color ),); endif;
		if($accent_text_color_one) : $color_array[] = array( 'name'  => __( 'accent_text_color_one' ),'slug'  => __( 'accent_text_color_one' ), 'color' => __( $accent_text_color_one ),); endif;
		if($accent_text_color_two) : $color_array[] = array( 'name'  => __( 'accent_text_color_two' ),'slug'  => __( 'accent_text_color_two' ), 'color' => __( $accent_text_color_two ),); endif;
		if($accent_text_color_three) : $color_array[] = array( 'name'  => __( 'accent_text_color_three' ),'slug'  => __( 'accent_text_color_three' ), 'color' => __( $accent_text_color_three ),); endif;
		if($default_heading_text_color) : $color_array[] = array( 'name'  => __( 'default_heading_text_color' ),'slug'  => __( 'default_heading_text_color' ), 'color' => __( $default_heading_text_color ),); endif;
		if($default_background_color) : $color_array[] = array( 'name'  => __( 'default_background_color' ),'slug'  => __( 'default_background_color' ), 'color' => __( $default_background_color ),); endif;
		if($accent_background_color_one) : $color_array[] = array( 'name'  => __( 'accent_background_color_one' ),'slug'  => __( 'accent_background_color_one' ), 'color' => __( $accent_background_color_one ),); endif;
		if($accent_background_color_two) : $color_array[] = array( 'name'  => __( 'accent_background_color_two' ),'slug'  => __( 'accent_background_color_two' ), 'color' => __( $accent_background_color_two ),); endif;
		if($accent_background_color_three) : $color_array[] = array( 'name'  => __( 'accent_background_color_three' ),'slug'  => __( 'accent_background_color_three' ), 'color' => __( $accent_background_color_three ),); endif;
		if($default_filled_button_text_color) : $color_array[] = array( 'name'  => __( 'default_filled_button_text_color' ),'slug'  => __( 'default_filled_button_text_color' ), 'color' => __( $default_filled_button_text_color ),); endif;
		if($default_filled_button_background_color) : $color_array[] = array( 'name'  => __( 'default_filled_button_background_color' ),'slug'  => __( 'default_filled_button_background_color' ), 'color' => __( $default_filled_button_background_color ),); endif;
		if($default_outlined_button_text_color) : $color_array[] = array( 'name'  => __( 'default_outlined_button_text_color' ),'slug'  => __( 'default_outlined_button_text_color' ), 'color' => __( $default_outlined_button_text_color ),); endif;
		if($default_outlined_button_background_color) : $color_array[] = array( 'name'  => __( 'default_outlined_button_background_color' ),'slug'  => __( 'default_outlined_button_background_color' ), 'color' => __( $default_outlined_button_background_color ),); endif;

		$result = [];
		foreach ($color_array as $row) {
			$result[$row['color']] = $row;
		}

		add_theme_support( 'editor-color-palette', array_values($result) );
	}
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
| EDITOR STYLES JS
\*--------------------------------------------------------------------------------------*/
function be_gutenberg_scripts() {
	wp_enqueue_script(
		'be-editor', get_stylesheet_directory_uri() . '/assets/js/editor.js', 
		array( 'wp-blocks', 'wp-dom' ), 
		filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ),
		true
	);  
	wp_enqueue_script('be-editorr', get_stylesheet_directory_uri() . '/assets/js/stylingScript.js' );
}
add_action( 'enqueue_block_editor_assets', 'be_gutenberg_scripts' );


/*--------------------------------------------------------------------------------------*\
| EDITOR STYLES CSS
\*--------------------------------------------------------------------------------------*/
function misha_gutenberg_css(){
	add_theme_support( 'editor-styles' );
	add_editor_style( '/assets/css/style-editor.css' ); 
}
add_action( 'after_setup_theme', 'misha_gutenberg_css' );

function CSS_duplicate() {
	$destination = get_template_directory() . '/assets/css/style-editor.css';
	$arrayCSS = file(get_template_directory_uri() . '/assets/css/custom.css');
	file_put_contents($destination,implode('', $arrayCSS));
}

//add_action('init', 'CSS_duplicate');





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
	register_block_pattern_category( 'Custom', array( 'label' => 'Custom' ));
}
add_action('after_setup_theme', 'removeCorePatterns');



/*--------------------------------------------------------------------------------------*\
| PASSWORD CUSTOMIZATION
\*--------------------------------------------------------------------------------------*/
function change_protected_title_prefix() {
    return '';
}
add_filter('protected_title_format', 'change_protected_title_prefix');

add_filter( 'the_password_form', 'wporg_password_form' );
function wporg_password_form() {
    global $post;
    $label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
    $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
    ' . esc_html__( 'Welkom! ', 'text-domain' ) . '<br><br><br>' . '
    <label class="pass-label" for="' . $label . '">' . esc_html__( 'Wachtwoord:', 'text-domain' ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" style="background: #ffffff; border:1px solid #999; color:#333333; padding:10px;" size="20" /><input type="submit" name="Submit" class="button" value="' . esc_attr__( 'Aanmelden', 'text-domain' ) . '" />
    </form>
    ';
    return $output;
}



/*--------------------------------------------------------------------------------------*\
| MASONRY LIBRARY
\*--------------------------------------------------------------------------------------*/
function your_function_name(){

	global $post;

	if( is_admin() ) return; ?>
	
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

	<script>
	if( document.querySelector('.wp-block-gallery') ){
		window.addEventListener('load', (event) => {
			function setMasonry( cols , containerWidth , gutter = 10 ){	
				let elems = document.querySelectorAll('.wp-block-gallery');		
				let elem = document.querySelector('.wp-block-gallery');		
				let gutters = cols - 1;
				let colWidth = ( containerWidth - ( gutters * gutter ) ) / cols;
				let galleryItems = document.querySelectorAll('.wp-block-gallery .wp-block-image');

				galleryItems.forEach( function(galleryItem){
					galleryItem.style.width = colWidth + "px";
				});

				let zeroElem = galleryItems[0];
				elems.forEach( 
					element => new Masonry( element, {
						itemSelector: '.wp-block-image',
						columnWidth: zeroElem,
						gutter: gutter,
					})
				); 
			}
			
			
			function initMasonry(){
				
				let galleryItems = document.querySelectorAll('.wp-block-gallery .wp-block-image');
				let cols = (galleryItems.length) > 4 ? 3 : 2;
				let style = window.getComputedStyle(document.querySelector('.wp-block-gallery'), null);
				let containerWidth = parseInt(style.getPropertyValue("width"), 10);

				cols = (containerWidth > 768) ? cols : 2;

				setMasonry( cols , containerWidth );

			}			
			initMasonry();	

			addEventListener("resize", (event) => { initMasonry(); });	
		});
	}
	</script>
	<?php
};

add_action('wp_footer', 'your_function_name');


