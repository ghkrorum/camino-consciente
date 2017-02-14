<?php
/**
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage camino_consciente
 * @since Camino Consciente 1.0
 */

get_header(); ?>

    <div id="wrapper">
        <div class="section" id="home-section">

            <?php
            $published_posts_ids = array();
            get_template_part( 'template-parts/home-slider' );
            get_template_part( 'template-parts/featured-courses' );
            get_template_part( 'template-parts/our-services' );
            include( locate_template( 'template-parts/latest-articles.php' ) );
            get_template_part( 'template-parts/store' );
            include( locate_template( 'template-parts/more-articles.php' ) );
            ?>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#home-section .tiny-slider').tinycarousel({ interval: true });
            Sliders.setHome();
            $(window).on("resize", function(){
                Sliders.setHome();
            });
        });
    </script>
    </div>


<?php
get_footer();
