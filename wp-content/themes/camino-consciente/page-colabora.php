<?php
/**
 * Template Name: Colabora con nosotros
 *
 * @package WordPress
 * @subpackage camino_consciente
 * @since Camino Consciente 1.0
 */

get_header(); ?>

<div id="wrapper">
    <div class="section" id="colabora-section">
        <div class="container">
            <div class="row">
                <?php
                if ( have_posts() ) :
                    while( have_posts() ) : the_post(); ?>

                    <div class="wrapper-colabora">

                        <div class="blog-nota">
                            <img class="colabora-logo" src="<?= THEME_DIR ?>/img/camino-conciente-icon.png" alt="">
                            <?php the_content(); ?>
                            <?= do_shortcode( '[contact-form-7 id="3469" title="Formulario de contacto 1"]' ); ?>
                        </div>

                        <?php endwhile;

                        else:
                            // TODO: Include no content template
                        endif; ?>
                    </div>
                    <p class="colabora-legend">Respetamos tu privacidad, tu información está <br> segura, nunca será vendida ni cedida a terceros.</p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
