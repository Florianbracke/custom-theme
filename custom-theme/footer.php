
        <footer id="colophon" class="site-footer alignwide">

            <div class="footer-one">

                <div class="site-branding">
                    <?php the_custom_logo(); ?>
                </div>

                <div class="container">
                    <?php
                        wp_nav_menu( array(
                            'menu_id'        => 'main-menu',
                        ) );
                    ?>
                </div>

                <div class="socials">
                    <span class="dashicons dashicons-whatsapp"></span>
                    <span class="dashicons dashicons-instagram"></span>
                    <span class="dashicons dashicons-facebook-alt"></span>
                </div>

            </div>
                        
            <div class="footer-two">	

                       <p>© <?php echo date('Y') . ' ' . $info['naam_bedrijf']; ?> </p>
            </div>

        </footer><!-- #colophon -->
        
    </div><!-- #page -->

    <?php wp_footer(); ?>

</body>
</html>
