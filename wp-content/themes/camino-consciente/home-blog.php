<?php
/**
 * Template Name: Blog Home
 *
 * @package WordPress
 * @subpackage camino_consciente
 * @since Camino Consciente 1.0
 */

get_header(); ?>

<div id="wrapper" class="wrapper-interior">
    <div class="section" id="home-blog-section">
        <div class="container">
            <div class="row">
                <?php
                $featured_post_query_args = array(
                    'post_status' => 'publish',
                    'posts_per_page' => 1,
                    'post_type' => 'post',
                    'order_by' => 'date',
                    'meta_query' => array(
                        array (
                            'key'	  	=> 'show_as_featured',
                            'value'	  	=> '1',
                            'compare' 	=> 'like',
                        ),
                    ),
                );

                $featured_post_query = new WP_Query( $featured_post_query_args );

                if ( $featured_post_query ->have_posts() ) :
                    while ( $featured_post_query ->have_posts() ) :
                        $featured_post_query ->the_post();
                        if ( has_post_thumbnail() ) :
                            $default_url = '';
                            $thumb_url =  get_the_post_thumbnail_url( $post->ID );
                            $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                            <div class="col-md-7 big">
                                <div class="inner-grid" style="background-image:url('<?= $thumb_url ?>');">
                                    <div class="cell-center">
                                        <span class="title title-labeled"><?= get_the_category( $post->ID )[0]->name ?></span>
                                        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                                        <p><?= wp_rp_text_shorten( get_the_excerpt( $post->ID ), 80 ); ?></p>
                                    </div>
                                    <div class="white-gradient" style="background-image:url(<?= THEME_DIR ?>/img/views/home-blog/gradient.png);"></div>
                                </div>
                            </div>
                        <?php endif;  ?>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();

                $featured_post_aside_query_args = array(
                    'post_status' => 'publish',
                    'posts_per_page' => 2,
                    'post_type' => 'post',
                    'order_by' => 'date',
                    'meta_query' => array(
                        array (
                            'key'	  	=> 'show_as_featured_aside',
                            'value'	  	=> '1',
                            'compare' 	=> 'like',
                        ),
                    ),
                );

                $featured_post_aside_query = new WP_Query( $featured_post_aside_query_args );

                if ( $featured_post_aside_query ->have_posts() ) :
                    while ( $featured_post_aside_query ->have_posts() ) :
                        $featured_post_aside_query ->the_post();
                        if ( has_post_thumbnail() ) :
                            $default_url = '';
                            $thumb_url =  get_the_post_thumbnail_url( $post->ID );
                            $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                            <div class="col-md-5 side">
                                <div class="col-md-12 inner-grid" style="background-image:url('<?= $thumb_url ?>');">
                                    <div class="cell-center">
                                        <span class="title title-labeled"><?= get_the_category( $post->ID )[0]->name ?></span>
                                        <span class="home-blog-side-description"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?= wp_rp_text_shorten( get_the_title(), 50 ); ?></a></span>
                                    </div>
                                    <div class="white-gradient" style="background-image:url(img/views/home-blog/gradient-b.png);"></div>
                                </div>
                            </div>
                        <?php endif;  ?>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <div class="partial-section"><?php get_template_part( 'template-parts/featured-courses' ); ?></div>

        <div class="partial-section">
            <!-- articles -->
            <div class="featured-articles">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <?php
                        $posts_query_args = array(
                            'post_status' => 'publish',
                            'posts_per_page' => 6,
                            'post_type' => 'post',
                            'order_by' => 'date',
                        );

                        $posts_query = new WP_Query( $posts_query_args );

                        if ( $posts_query ->have_posts() ) :
                            while ( $posts_query ->have_posts() ) :
                                $posts_query ->the_post();
                                if ( has_post_thumbnail() ) :
                                    $default_url = '';
                                    $thumb_url =  get_the_post_thumbnail_url( $post->ID );
                                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                                    <div class="col-md-4 article">
                                        <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
                                            <article>
                                                <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                                    <div class="sr-only"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"></div>
                                                </figure>
                                                <div class="details">
                                                    <span class="title title-labeled"><?= get_the_category( $post->ID )[0]->name ?></span>
                                                    <h3><?php the_title(); ?></h3>
                                                    <p><?= get_field( 'post_excerpt' ); ?></p>
                                                </div>
                                            </article>
                                        </a>
                                    </div>
                                <?php endif;  ?>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                    <!-- row -->
                    <?php /* <a href="cursos.html" class="btn btn-default all-courses-link to-section" title="Ver todos los cursos">Ver Más</a> */ ?>
                </div>
            </div>
            <!-- articles -->
        </div>
    </div>
</div>

<?php get_footer(); ?>
