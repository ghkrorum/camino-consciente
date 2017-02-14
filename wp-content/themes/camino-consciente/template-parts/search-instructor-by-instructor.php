<?php get_header(); ?>

<div id="wrapper">
    <div id="filtros-curso" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 in-the-zone-container">
                    <h3 class="title big-title">Conoce más cursos</h3>
                    <div class="know-more-courses">
                        <div class="row">
                            <form id="form-search-by-criteria" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="hidden" name="search-type" value="search-venue-by-criteria" />
                                <input type="hidden" name="s" value="" />
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="selectable select-content">
                                        <?php generate_categories_dropdown(); ?>
                                    </div>
                                </div>
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="selectable select-content">
                                        <?php generate_country_dropdown(); ?>
                                    </div>
                                </div>
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="selectable select-content">
                                        <?php generate_cities_dropdown(); ?>
                                    </div>
                                </div>
                                <div class="col-md-8 col-md-offset-2">
                                    <center>
                                        <input class="submit-selectable" type="submit" value="Buscar">
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
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
                        <div class="title main-title">Centros en la zona</div>
                        <?php
                        $featured_venues_query_args = array(
                            'post_status'       => 'publish',
                            'posts_per_page'    => 2,
                            'post_type'         => 'centros_de_ensenanza',
                            'order_by'          => 'rand',
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
                    <?php
                    $instructor_id = (int) $_GET['instructor'];
                    
                    $search_query_args = array(
                        'post_status'       => 'publish',
                        'posts_per_page'    => 10,
                        'post_type'         => 'instructor',
                        'order_by'          => 'date',
                        'p'                 => $instructor_id,
                    );

                    $search_query = new WP_Query( $search_query_args );

                    if ( $search_query ->have_posts() ) :
                        while ( $search_query ->have_posts() ) :
                            $search_query ->the_post();
                            $course_data = get_course_data();
                            $default_url = '';
                            $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
                            $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                            $venues_args = array(
                                'post_type'         => 'centros_de_ensenanza',
                                'posts_per_page'    => 1,
                            );

                            if( $course_data['type'] !== 'online' )
                                $venues_args['p'] = $course_data['venue'][0]->ID;

                            $venues = get_posts( $venues_args );

                            $instructors = get_posts(array(
                                'post_type'         => 'instructor',
                                'posts_per_page'    => 1,
                                'post__in'			=> array($instructor_id),
                            ));

                            ?>
                            <!-- init article -->
                            <article class="article">
                                <div class="row">
                                    <aside class="col-md-7">
                                        <div class="col-md-5 shares">
                                            <div class="partial-section">
                                                <?php get_template_part( 'template-parts/share' ); ?>
                                            </div>
                                        </div>
                                        <h2><?php the_title(); ?></h2>
                                        <div class="author-description col-md-7">
                                            <h3><?= sprintf( '%s %s', $course_data[0]['instructor']['name'], $course_data[0]['instructor']['last_name'] ); ?></h3>
                                            <p><?php the_excerpt(); ?></p>
                                            <a href="<?= esc_url( the_permalink() ) ?>" class="btn btn-default">Ver más</a>
                                        </div>
                                        <div class="details col-md-5">
                                            <ul>
                                                <li> <i class="icon icon-map-marker"></i> <?= the_course_location( get_the_terms( $post, 'ubicacion' ) ); ?> </li>
                                            </ul>
                                            <div class="favs-container">
                                                <h4>5 opiniones
                                                    <divs class="favs">
                                                        <i class="icon icon-star"></i>
                                                        <i class="icon icon-star"></i>
                                                        <i class="icon icon-star"></i>
                                                        <i class="icon icon-star"></i>
                                                        <i class="icon icon-star"></i>
                                                    </divs>
                                                </h4>
                                            </div>
                                        </div>
                                    </aside>
                                    <div class="col-md-5">
                                        <figure class="text-center" style="background-image:url('<?= $thumb_url ?>')">
                                            <div class="title course-type-<?= $course_data['type']; ?>"><?= get_course_type_name( $course_data['type'] ) ?></div>
                                            <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                                        </figure>
                                    </div>
                                </div>
                            </article>
                            <!-- end article -->
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
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
