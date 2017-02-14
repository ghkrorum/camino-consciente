<?php
/**
 * Template Name: Nuestra filososfía
 *
 * @package WordPress
 * @subpackage camino_consciente
 * @since Camino Consciente 1.0
 */

get_header(); ?>

<div id="wrapper">
    <div class="section" id="sobre-nosotros-section">
        <div class="container">
            <div class="row">
                <div class="banner-top  text-center" style="background-image: url(<?= THEME_DIR ?>/img/views/nota-blog-interior/top.jpg);">
                    <div class="wrapper-nota-blog">
                        <?php
                        while ( have_posts() ) : the_post(); ?>
                            <h1><?php the_title(); ?></h1>
                        <?php endwhile; ?>
                        <div class="wrapper-bg-w">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="white-gradient"></div>
                </div>
            </div>
        </div>
        <div class="partial-section" data-url="partials/know-services.html"></div>
        <div class="container content-fundadores">
            <div class="row">
                <div class="founders col-md-12">
                    <h3 class="title main-title">FUNDADORES</h3>

                    <div class="video col col-md-6">
                        <?php 
                        $videoUrl = get_field('founders_video_url');
                        $videoImg = get_field('founders_video_img');
                        if ($videoUrl && $videoImg):
                            $thumb = kxn_get_acf_image_src($videoImg, 'video-thumb');
                        ?>
                        <div class="video-testimonial">
                            <a href="<?= $videoUrl; ?>" data-lity>
                                <img src="<?= $thumb; ?>" >
                                <i class="icon icon-play"></i>
                            </a>
                        </div>
                        <?php 
                        endif;
                        ?>
                    </div>
                    <div class="founder col-md-3">
                        <a href="<?= get_permalink(PERFIL_HECTOR_BONILLA); ?>"><img src="http://i.imgur.com/nGYkU2S.png" style="display: block;width: 150px;margin: 0 auto;" alt="héctor bonilla" /></a>
                        <h2><a href="<?= get_permalink(PERFIL_HECTOR_BONILLA); ?>">Héctor Bonilla</a></h2>
                        <div style="text-align: justify;">
                            <p>Héctor Raúl Bonilla Orozco es Maestro en Artes Marciales Internas. Está enfocado desde hace 35 años en el desarrollo y difusión de las Disciplinas que conducen al logro del sentido de vida del ser humano en la era actual, promoviendo salud, plenitud, paz, felicidad; de forma simple, directa, efectiva.</p>
                        </div>
                    </div>
                    <div class="founder col-md-3">
                        <a href="<?= get_permalink(PERFIL_ROCIO_SIERRA); ?>"><img src="http://i.imgur.com/pPywHqF.png" style="display: block;width: 150px;margin: 0 auto;" alt="Rocío Sierra Basurto" /></a>
                        <h2><a href="<?= get_permalink(PERFIL_ROCIO_SIERRA); ?>">Rocío Sierra Basurto</a></h2>
                        <div style="text-align: justify;">
                            <p>Rocío, ha tenido la oportunidad de acompañar desde hace más de 30 años a cientos de personas y familias de diferentes condiciones socioeconómicas y culturales en su transformación hacia una vida de salud, felicidad, paz, amor y servicio.</p>
                        </div>
                    </div>
                </div>
                <div class="partial-section" data-url="partials/testimoniales.html"></div>
                <div class="col-md-12">
                    <a href="http://www.descubreyavanza.org/" target="_blank">
                        <img src="<?= THEME_DIR ?>/img/hands.jpg" alt="Image" style="max-width:100%;">
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
