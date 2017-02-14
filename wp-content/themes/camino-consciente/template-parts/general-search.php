<?php get_header(); ?>

<div id="wrapper" class="wrapper-interior">
    <div id="filtros-curso" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 in-the-zone-container">
                    
                    
                    <div class="instructors-in-the-zone text-center">
                        <div class="title main-title">Instructores destacados</div>
                        <?php
                        $instructors_query_args = array(
                            'post_status'       => 'publish',
                            'posts_per_page'    => 2,
                            'post_type'         => 'instructor',
                            'order_by'          => 'rand',
                            'meta_query' => array(
                                array (
                                    'key'	  	=> 'instructor_is_featured',
                                    'value'	  	=> '1',
                                    'compare' 	=> 'like',
                                ),
                            ),
                        );

                        $instructors_query = new WP_Query( $instructors_query_args );

                        if ( $instructors_query ->have_posts() ) :
                            while ( $instructors_query ->have_posts() ) :
                                $instructors_query ->the_post();
                                if ( has_post_thumbnail() ) :
                                    $default_url = '';
                                    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'instructor-featured' );
                                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                                    $instructor_data = get_instructor_data();  ?>
                                    <!-- instructor init -->
                                    <div class="col-md-12 instructor">
                                        <a href="<?php the_permalink(); ?>" class="to-section" title="María Arozamena">
                                            <aside>
                                                <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                                    <div class="sr-only"><img src="<?= $thumb_url ?>"></div>
                                                </figure>
                                                <div class="details">
                                                    <h3><?= sprintf( '%s <br /><strong>%s</strong>', get_field( 'instructor_name' ), get_field( 'instructor_last_name' ) ); ?></h3>
                                                    <p><?= wp_rp_text_shorten( get_the_content(), 160 ); ?></p>
                                                </div>
                                            </aside>
                                        </a>
                                    </div>
                                    <!-- instructor end -->
                                <?php endif;  ?>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                        <a href="<?= get_site_url(); ?>/instructores/" class="btn btn-default downcase">Ver todos los instructores</a>
                    </div>
                    <div class="temples-in-the-zone">
                        <div class="line"></div>
                        <div class="title main-title">Centros destacados</div>
                        <?php
                        $featured_venues_query_args = array(
                            'post_status'       => 'publish',
                            'posts_per_page'    => 2,
                            'post_type'         => 'centros_de_ensenanza',
                            'order_by'          => 'rand',
                            'meta_query' => array(
                                array (
                                    'key'	  	=> 'venue_is_featured',
                                    'value'	  	=> '1',
                                    'compare' 	=> 'like',
                                ),
                            ),
                        );

                        $featured_venues_query = new WP_Query( $featured_venues_query_args );

                        if ( $featured_venues_query ->have_posts() ) :
                            while ( $featured_venues_query ->have_posts() ) :
                                $featured_venues_query ->the_post();
                                $course_data = get_course_data();
                                if ( has_post_thumbnail() ) :
                                    $default_url = '';
                                    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'venue-featured' );
                                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                                    <div class="col-md-12 temple">
                                        <a href="<?php the_permalink(); ?>" class="to-section">
                                            <aside>
                                                <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                                    <div class="sr-only"><img src="<?= $thumb_url ?>"></div>
                                                </figure>
                                                <div class="details">
                                                    <h3><?php the_title(); ?></h3>
                                                </div>
                                            </aside>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                        <a href="<?= get_site_url(); ?>/centros-de-ensenanza/" class="btn btn-default downcase all-centers">Ver todos los centros</a>
                    </div>
                </div>

                <div class="col-md-9 articles-container">
                    <?php if (!is_page()) :?>
                    <h1>Resultados de tu búsqueda:</h1>
                    <?php endif; ?>
                            <?php
                            $exclude_post_ids = array();
                            if (have_posts()) :
                                while (have_posts()) :
                                    the_post();
                                    $exclude_post_ids[] = get_the_ID();
                                    $thumb_url = '';
                                    if ( has_post_thumbnail() )
                                        $thumb_url =  get_the_post_thumbnail_url( get_the_ID() );

                            ?>
                            <!-- init article -->
                            <article class="article article-search-result">
                                <div class="row">
                                    <div class="col-md-5 search-results-mobile-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <figure class="text-center search-results-course-image" style="background-image:url('<?= $thumb_url ?>')">
                                                
                                                <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                                                <div class="white-gradient"></div>
                                                <h2 class="result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            </figure>
                                        </a>
                                    </div>
                                    <aside class="col-md-7">
                                        <div class="col-md-5 shares">
                                            <div class="partial-section">
                                                <?php get_template_part( 'template-parts/share' ); ?>
                                            </div>
                                        </div>
                                        <h2 class="result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="author-description col-md-7">
                                            
                                            <p></p>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-default">Ver más</a>
                                        </div>
                                        <div class="details col-md-5">
                                            
                                            
                                            
                                        </div>
                                    </aside>
                                    <div class="col-md-5 search-results-course-desktop-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <figure class="text-center search-results-course-desktop-image" style="background-image:url('<?= $thumb_url ?>')">
                                                
                                                <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            <!-- end article -->
                            <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                    
                        <?php echo do_shortcode('[ajax_load_more ajax_load_more repeater="template_5" post_type="post, cursos, instructor, centros_de_ensenanza" search="'.$term.'" post__not_in="' . implode(",", $exclude_post_ids ) . '" posts_per_page="5" scroll="true" pause="false" button_label = "Ver más" button_loading_label="Cargando más artículos"]'); ?>

                    
                </div>
            </div>
            
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#filtros-curso .selectable').each(function(index, el) {
                var _placeholder = $(this).find("select").data("placeholder");
                $(el).selectable({placeholder:_placeholder});
            });
        });
    </script>
</div>

<?php get_footer(); ?>
