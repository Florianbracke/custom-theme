<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<!-- FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;700&display=swap" rel="stylesheet">

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.typekit.net/wtx1bnr.css">
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <div id="page" class="site">
            
        <header id="masthead" class="site-header">

            <div class="site-branding">
                <?php the_custom_logo(); ?>
            </div>

            <nav id="site-navigation" class="main-navigation">

                <div class="menu-container">
                    <?php
                        wp_nav_menu( array(
                            'menu_id'        => 'main-menu',
                        ) );
                    ?>
                </div>
                    
                <div class="mobile-header-block">

                    <div class="menu-container-mobile">

                        <?php
                            wp_nav_menu( array(
                                'menu_id'        => 'main-menu',
                            ) );
                        ?>
                    </div>

                    <div class="mobile-buttons">
                        <button class="phone-mobile"> <a href="tel:+32 472 88 84 61" class="phone-link"></a></button>	
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
                    </div>          
                            
                </div>

            </nav>
		
	get_template_part('template-parts/content', 'breadcrumbs');

        </header>
