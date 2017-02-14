<?php get_header(); ?>
<div id="wrapper" class="wrapper-interior">
    <div class="section" id="nota-blog-interior">
        <div class="container">
            <div class="row">
                <?php if ( have_posts() ) : ?>
                    <?php while( have_posts() ) : the_post();
                        $default_url = '';
                        $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
                        $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                        <div class="banner-top-mobile">
                            <div class="wrapper-nota-blog">
                                <div class="inner-grid-head-mobile-wrap">
                                    <span class="title title-labeled"><?= get_first_category_link( $post->ID ); ?></span>
                                    <h1 class="blog-nota-title"><?php the_title(); ?></h1>
                                    <p class="blog-nota-des"><?= get_field( 'post_excerpt' ); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="banner-top text-center" style="background-image: url('<?= $thumb_url ?>');">
                            <div class="wrapper-nota-blog">
                                <span class="title title-labeled"><?= get_first_category_link( $post->ID ); ?></span>
                                <h1 class="blog-nota-title"><?php the_title(); ?></h1>
                                <p class="blog-nota-des"><?= get_field( 'post_excerpt' ); ?></p>
                            </div>
                            <div class="white-gradient"></div>
                        </div>
                        <div class="wrapper-nota">
                            <?php get_template_part( 'template-parts/share' ); ?>
                            <div class="blog-nota col-md-8">
                                <div class="date"><?php the_date( 'j \d\e F, Y' ); ?></div>
                                <?php the_content(); ?>
                            </div>
                            <!-- Anuncios -->
                            <div class="anuncio col-md-4">
                                <div class="banner banner-1">
                                    <a href="http://brutalcontent.com/cc/cursos/ejercicios-para-liberar-la-tension/">
                                        <img src="<?= THEME_DIR ?>/img/views/nota-blog-interior/300x250-banner-blog-liberate-de-las-preocupaciones.jpg" alt="">
                                    </a>
                                </div>
                                <div class="banner banner-2">
                                    <a href="http://brutalcontent.com/cc/cursos/diplomado-el-arte-de-vivir-con-salud-y-plenitud/">
                                        <img src="<?= THEME_DIR ?>/img/views/nota-blog-interior/300x600-banner-blog-diplomado.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="container">
                                <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="1280" data-numposts="1"></div>
                            </div>
                            <div class="partial-section" data-url="partials/fb-comments.html"></div>
                            <div class="partial-section"><?php get_template_part( 'template-parts/featured-courses' ); ?></div>
                            <?php /*
                            <div class="row text-center">
                                <h3 class="title main-title">Artículos Relacionados</h3>
                                <div class="partial-section" data-url="partials/featured-articles.html"></div>
                            </div>
                            */ ?>
                        </div>
                    <?php endwhile; ?>

                <?php else: ?>
                    <?php // TODO: Include no content template ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
