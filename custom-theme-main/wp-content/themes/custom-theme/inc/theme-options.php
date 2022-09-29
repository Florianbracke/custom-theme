<?php


/*--------------------------------------------------------------------------------------*\
| THEME SUPPORT
\*--------------------------------------------------------------------------------------*/
function enable_theme_support() {

	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'woocommerce' );

}
add_action( 'after_setup_theme', 'enable_theme_support' );



/*--------------------------------------------------------------------------------------*\
| MENU CUSTOMIZER
\*--------------------------------------------------------------------------------------*/        
function register_my_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
  }

add_action('init', 'register_my_menu');