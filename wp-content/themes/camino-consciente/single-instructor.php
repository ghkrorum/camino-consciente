<?php get_header(); ?>
<?php
$postId = 0;
?>
<div id="wrapper" class="wrapper-interior">
    <div class="section" id="instructor-section">
        <?php if ( have_posts() ) : ?>
            <?php
            while( have_posts() ) : the_post();
                $postId = get_the_ID();
                $instructor_data = get_instructor_data();
                if ( has_post_thumbnail() ) :
                    $default_url = '';
                    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'instructor-featured' );
                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                    $instructor_data = get_instructor_data(); 
                    $videoUrl = get_field('instructor_video_url');
            ?>

            <article class="container top-article">
                <div class="row header">
                    <div class="col-md-6 full-h top-article-image-box">
                        <figure style="background-image: url(<?= $thumb_url ?>);">
                            <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                            <div class="white-gradient button-video button-instructor">
                                <div class="col-md-7">
                                    <div class="title-container">
                                        <h1><?= sprintf( '%s %s', get_field( 'instructor_name' ), get_field( 'instructor_last_name' ) ); ?></h1>
                                        <h3><?= get_field( 'instructor_profession' ) ?></h3>
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
                                        <span class="title-video">Ver biografía</span>
                                    </div>
                                </a>
                            </div>
                            <?php endif; ?>
                        </figure>

                        <div class="the-row">
                            <div class="col-md-8">
                                <div class="instructor-contact">
                                    <?php if ( $instructor_data['email1'] ) : ?>
                                    <a href="mailto:<?= $instructor_data['email1']; ?>">
                                        <div class="the-bullet contact">
                                            <span class="icon-cont"><i class="glyphicon glyphicon-envelope"></i></span> <div>Contáctame</div>
                                        </div>
                                    </a>
                                    <?php endif; ?>
                                    <?php if ( $instructor_data['facebook'] ) : ?>
                                    <a href="<?= $instructor_data['facebook']; ?>" class="social-btn fb" target="_blank">
                                        <i class="icon icon-fb"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if ( $instructor_data['twitter'] ) : ?>
                                    <a href="<?= $instructor_data['twitter']; ?>" class="social-btn tw">
                                        <i class="icon icon-tw"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if ( $instructor_data['instagram'] ) : ?>
                                    <a href="<?= $instructor_data['instagram']; ?>" class="social-btn instagram" target="_blank">
                                        <i class="icon icon-instagram"></i>
                                    </a>
                                    <?php endif; ?>

                                    <?php if ( $instructor_data['type'] ) : ?>

                                        <?php if ( $instructor_data['gmaps_url'] ) : ?>
                                        <a href="<?= $instructor_data['gmaps_url']; ?>" target="_blank">
                                        <?php endif; ?>
                                            <div class="the-bullet location">
                                                <span class="icon-cont"><i class="glyphicon glyphicon-map-marker"></i></span> <div><?= $instructor_data['location']; ?></div>
                                            </div>
                                        <?php if ( $instructor_data['gmaps_url'] ) : ?>
                                        </a>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php
                                if(function_exists('the_ratings')) { the_ratings(); } 
                                ?>
                            </div>
                        </div>

                                              
                        <div class="row">
                            <div class="col-md-12 col-share">
                                <div class="partial-section">
                                    <?php get_template_part( 'template-parts/share' ); ?>
                                </div>
                            </div>
                        </div>
                        
                        

                        
                    </div>
                    <div class="col-md-6 full-h full-h top-article-desc-box">
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
                                    $tagUrl = kxn_get_search_tag_url($tag->slug, 'search-instructor-by-criteria');
                                ?>
                                <a href="<?= $tagUrl; ?>"><?= $tag->name; ?></a>&nbsp;
                                <?php 
                                endfor;
                                ?>
                            </div>
                        </div>
                        <?php 
                        endif; 
                        ?>
                        <aside>
                            <?php the_content(); ?>
                        </aside>
                    </div>

                    <?php
                    if ($calCourses) :
                        $totalCourses = count( $calCourses );
                        $currYearMonth = '';
                        setlocale(LC_ALL,"es_ES");
                    ?>

                    <div class="col-md-12 col-next-courses col-next-courses-mobile">
                        <div class="partial-section">
                                    <div class="calendar">
                                        <div class="header">
                                            <h2><?= sprintf( 'Próximos cursos de %s %s', get_field( 'instructor_name' ), get_field( 'instructor_last_name' ) ); ?></h2>
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
            <div class="partial-section" style="clear: both;"><?php get_template_part( 'template-parts/_testimonials' ); ?></div>
            <div class="container comments">
                <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="1280" data-numposts="1"></div>
            </div>
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
                        'key' => 'course_instructor',
                        'value' => '"' . $postId . '"',
                        'compare' => 'LIKE'
                    )
                )
            ));


            if ( $featuredCourses ) :
            ?>
            <div class="partial-section">
                <div class="featured-courses">
                    <h3 class="title main-title"><?= sprintf( 'Cursos Destacados de %s %s', get_field( 'instructor_name' ), get_field( 'instructor_last_name' ) ); ?></h3>
                    <div class="container">
                        <div class="row">
                            <?php
                                foreach ( $featuredCourses as $featuredCourse ) :
                                    $post = $featuredCourse;
                                    setup_postdata($post);
                                    $course_data = get_course_data();
                                    $courseTitle = kxn_get_course_title($course_data);
                                    $courseType = kxn_get_course_type($course_data);
                                    if ( has_post_thumbnail() ) :
                                        $default_url = '';
                                        $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
                                        $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                                        <?php /* AGREGAR LA CLASE free-course para el tag de cursos gratis */ ?>
                                        <div class="col-md-3 course">
                                            <a href="<?php the_permalink(); ?>" class="to-section" title="<?= $courseTitle; ?>">
                                                <aside>
                                                    <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                                        <span class="title course-type-<?= $courseType; ?>"><?= get_course_type_name( $courseType ) ?></span>
                                                        <div class="description">
                                                            <p><?= wp_rp_text_shorten( get_the_excerpt( $post->ID ), 180 ); ?></p>
                                                        </div>
                                                        <div class="sr-only"><img src="img/views/home/camino-consciente-course.jpg" alt="UNA GUÍA PARA LA AUTOOBSERVACIÓN CONSCIENTE"></div>
                                                    </figure>
                                                    <div class="details">
                                                        <h3><?= $courseTitle; ?></h3>
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



            <?php 
            $authorId = $postId;
            require('template-parts/author-related-posts.php');
            ?>


            <?php /*
            <div class="text-center">
                <h3 class="title main-title">Artículos de <?= sprintf( '%s %s', get_field( 'instructor_name' ), get_field( 'instructor_last_name' ) ); ?></h3>
            </div>
            <div class="partial-section" data-url="partials/more-articles.html"></div>
            */ ?>
            <?php endif;
            endwhile; ?>

        <?php else: ?>
            <?php // TODO: Include no content template ?>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
