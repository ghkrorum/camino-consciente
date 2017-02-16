<?php get_header(); ?>
<?php
$postId = 0;
?>
<div id="wrapper" class="wrapper-interior">
    <div class="section" id="centros-de-ensenanza-interior-section">
        <?php if ( have_posts() ) : ?>
            <?php while( have_posts() ) : the_post();
                $postId = get_the_ID();
                $venue_data = get_venue_data();
                $default_url = '';
                $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'venue-thumb' );
                $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                $videoUrl = get_field('venue_video_url');
                ?>

                <article class="container top-article">
                    <div class="row header">
                        <div class="col-md-6 full-h top-article-image-box">
                            <figure style="background-image: url('<?= $thumb_url ?>');">
                                <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                                <div class="white-gradient">
                                    <div class="col-md-6">
                                        <div class="title-container">
                                            <h1><?php the_title(); echo $courseType; ?></h1>
                                            <?php the_venue_slogan( $venue_data['slogan'] ); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($videoUrl) : ?>
                                <div class="btn-vid-cont">
                                    <a href="<?= $videoUrl; ?>" data-lity>
                                        <div class="icon-video btn-video">
                                            <span class="icon-cont">
                                            <i class="icon icon-play"></i>
                                            </span>
                                            <span class="title-video">Ver video</span>
                                        </div>
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                            </figure>
                            <div class="the-row">
                                <div class="col-md-12">
                                    <div class="instructor-contact">
                                        <?php if ( $venue_data['email'] ) : ?>
                                        <a href="mailto:<?= $venue_data['email']; ?>">
                                            <div class="the-bullet contact">
                                                <span class="icon-cont"><i class="glyphicon glyphicon-envelope"></i></span> <div>Contáctame</div>
                                            </div>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ( $venue_data['social_networks']['facebook'] ) : ?>
                                        <a href="<?= $venue_data['social_networks']['facebook']; ?>" class="social-btn fb" target="_blank">
                                            <i class="icon icon-fb"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ( $venue_data['social_networks']['twitter'] ) : ?>
                                        <a href="<?= $venue_data['social_networks']['twitter']; ?>" class="social-btn tw" target="_blank">
                                            <i class="icon icon-tw"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ( $venue_data['social_networks']['instagram'] ) : ?>
                                        <a href="<?= $venue_data['social_networks']['instagram']; ?>" class="social-btn instagram" target="_blank">
                                            <i class="icon icon-instagram"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ( $venue_data['website'] ) : ?>
                                        <a href="<?= $venue_data['website']; ?>" target="_blank">
                                            <div class="the-bullet website">
                                                <span class="icon-cont"><i></i></span> <p>Ir a página web</p>
                                            </div>
                                        </a>
                                        <?php endif; ?>

                                        <?php if ( $venue_data['gmaps_url'] ) : ?>
                                        <a href="<?= $venue_data['gmaps_url']; ?>" target="_blank">
                                        <?php endif; ?>
                                            <div class="the-bullet location">
                                                <span class="icon-cont"><i class="glyphicon glyphicon-map-marker"></i></span> <div>Guadalajara, México</div>
                                            </div>
                                        <?php if ( $venue_data['gmaps_url'] ) : ?>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="row">
                                <div class="col-md-12 col-share">
                                    <div class="partial-section">
                                        <?php get_template_part( 'template-parts/share' ); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-rating">
                                    <div class="partial-section">
                                        <?php
                                        if(function_exists('the_ratings')) { the_ratings(); } 
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 full-h">
                            <?php
                            $post_tags = get_the_tags();
                            if ( $post_tags ) :
                                $totalTags = count($post_tags);
                            ?>
                            <div class="the-row">
                                <div class="col-md-12 course-cats">
                                    <?php
                                    for ( $i=0 ; $i < 2 && $i < $totalTags ; $i++ ): 
                                        $tag = $post_tags[$i];
                                        $tagUrl = kxn_get_search_tag_url($tag->slug, 'search-venue-by-criteria');
                                    ?>
                                    <a href="<?= $tagUrl; ?>"><?= $tag->name; ?></a>&nbsp;
                                    <?php endfor;?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <aside class="">
                                <?php the_content(); ?>
                            </aside>
                        </div>

                        <?php
                        if ($calCourses) :
                                    $totalCourses = count($calCourses);
                                    $currYearMonth = '';
                                    setlocale(LC_ALL,"es_ES");
                                ?>

                                <div class="col-md-12 col-next-courses col-next-courses-mobile">
                                    <div class="partial-section">
                                        <div class="calendar">
                                            <div class="header">
                                                <h2><?= sprintf( 'Próximos cursos'); ?></h2>
                                            </div>
                                            <div class="body">
                                                <div class="calendar-slider" id="calendar-slider">
                                                    
                                                    <div class="viewport">
                                                        <ul class="overview">
                                                            <li class="month">
                                                                <ul>
                                                            <?php for ($i = 0 ; $i < $totalCourses ; $i++) : ?>

                                                            <?php
                                                                $post = $calCourses[$i];
                                                                setup_postdata($post);
                                                                $course_data = get_course_data();
                                                                $startDate = $course_data['starting_date'];
                                                                $courseYearMonth = date('Ym', strtotime($startDate));
                                                            ?>
                                                                <?php if ($currYearMonth != $courseYearMonth) : ?>
                                                                <?php
                                                                    $currYearMonth = $courseYearMonth;
                                                                    $dateStr = strftime("%B, %Y", strtotime($startDate));
                                                                ?>
                                                                    <li>
                                                                        <h2><?= $dateStr; ?></h2>
                                                                    </li>
                                                                <?php endif; ?>

                                                                    <li>
                                                                        <a href="<?php the_permalink(); ?>" target="_blank">
                                                                            <h3><?= the_course_location( get_the_terms( $post, 'ubicacion' )); ?></h3>
                                                                            <p><?php the_title();?></p>
                                                                            <span class="mode"><?= get_course_type_name( $course_data['type'] )?></span>
                                                                        </a>
                                                                    </li>


                                                                <?php if ( $i+1 == $totalCourses ) : ?>

                                                                    </ul>
                                                                </li>

                                                                <?php endif; ?>

                                                            <?php endfor; ?>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php endif; 
                                wp_reset_postdata();
                                ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>

        
        
        <?php
        $featuredCourses = get_posts(array(
            'numberposts' => 4,
            'post_type' => 'cursos',
            'post_status' => 'publish',
            'meta_query' => array(
                'relation'      => 'AND',
                array(
                    'key'       => 'course_is_featured',
                    'value'     => '1',
                    'compare'   => 'like',
                ),
                array(
                    'key' => 'course_centro_de_ensenanza',
                    'value' => '"' . $postId . '"',
                    'compare' => 'LIKE'
                )
            )
        ));


        if ( $featuredCourses ) :
        ?>
        <div class="partial-section">
            <div class="featured-courses">
                <h3 class="title main-title">Cursos Destacados en <?= get_the_title(); ?></h3>
                <div class="container">
                    <div class="row">
                        <?php
                            foreach ( $featuredCourses as $featuredCourse ) :
                                $post = $featuredCourse;
                                setup_postdata($post);
                                $course_data = get_course_data();
                                if ( has_post_thumbnail() ) :
                                    $default_url = '';
                                    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
                                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                                    <?php /* AGREGAR LA CLASE free-course para el tag de cursos gratis */ ?>
                                    <div class="col-md-3 course">
                                        <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
                                            <aside>
                                                <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                                    <span class="title course-type-<?= $course_data['type']; ?>"><?= get_course_type_name( $course_data['type'] ) ?></span>
                                                    <div class="description">
                                                        <p><?= wp_rp_text_shorten( get_the_excerpt( $post->ID ), 180 ); ?></p>
                                                    </div>
                                                    <div class="sr-only"><img src="img/views/home/camino-consciente-course.jpg" alt="UNA GUÍA PARA LA AUTOOBSERVACIÓN CONSCIENTE"></div>
                                                </figure>
                                                <div class="details">
                                                    <h3><?php the_title(); ?></h3>
                                                    <?php
                                                    $instructors= get_posts(array(
                                                        'post_type'         => 'instructor',
                                                        'posts_per_page'    => 1,
                                                        'post__in'			=> get_field('course_instructor', false, false),
                                                    ));

                                                    foreach ( $instructors as $instructor ) :
                                                        ?>
                                                        <p><?= get_field( 'instructor_name', $instructor->ID ); ?> <?= get_field( 'instructor_last_name', $instructor->ID ); ?></p>
                                                    <?php endforeach; ?>
                                                    <span class="date">Fecha de Inicio: <?= get_course_starting_date( $course_data['starting_date'] );?></span>
                                                </div>
                                            </aside>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php
                            endforeach;
                        ?>
                    </div>
                    <a href="<?= get_site_url() ?>/cursos/" class="btn btn-default all-courses-link to-section" title="Ver todos los cursos">Ver todos los cursos</a>
                </div>
            </div>

        </div>
        <?php
        endif;
        wp_reset_postdata();
        ?>
        
        <div class="partial-section"><?php get_template_part( 'template-parts/featured-instructors' ); ?></div>

        <?php /*
        <div class="related-articles text-center">
            <h3 class="title main-title">Artículos Relacionados a <?php the_title(); ?></h3>
            <div class="partial-section" data-url="partials/more-articles.html"></div>
        </div>
        */?>
        <div class="partial-section">
            <?php get_template_part( 'template-parts/_testimonials' ); ?>
        </div>
        <?php
        $authorId = $postId;
        require('template-parts/author-related-posts.php');
        ?>


        <div class="container">
            <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="1280" data-numposts="5"></div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
