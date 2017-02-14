<div class="featured-courses">
    <h3 class="title main-title">Cursos Destacados</h3>
    <div class="container">
        <div class="row">
            <div class="featured-courses-desktop">
            <?php
            $home_featured_courses_query_args = array(
                'post_status' => 'publish',
                'posts_per_page' => 4,
                'post_type' => 'cursos',
                'order_by' => 'date',
                'meta_query' => array(
                    array (
                        'key'	  	=> 'course_is_featured',
                        'value'	  	=> '1',
                        'compare' 	=> 'like',
                    ),
                ),
            );

            $home_featured_courses_query = new WP_Query( $home_featured_courses_query_args );
            if ( $home_featured_courses_query ->have_posts() ) :
                while ( $home_featured_courses_query ->have_posts() ) :
                $home_featured_courses_query ->the_post();
                $course_data = get_course_data();
                $courseType = kxn_get_course_type($course_data);
                if ( has_post_thumbnail() ) :
                    $default_url = '';
                    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                    <?php /* AGREGAR LA CLASE free-course para el tag de cursos gratis */ ?>
                    <div class="col-md-3 course">
                        <a href="<?php the_permalink(); ?>" class="to-section" title="<?=kxn_get_course_title($course_data); ?>">
                            <aside>
                                <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                    <span class="title course-type-<?= $courseType; ?>"><?= get_course_type_name( $courseType ) ?></span>
                                    <div class="description">
                                        <p><?= get_field( 'course_excerpt' ); ?></p>
                                    </div>
                                    <div class="sr-only"><img src="img/views/home/camino-consciente-course.jpg" alt="UNA GUÍA PARA LA AUTOOBSERVACIÓN CONSCIENTE"></div>
                                </figure>
                                <div class="details">
                                    <a href="#" class="category"><span>Mente y emociones <img src="<?= THEME_DIR; ?>/img/cat-arrow.png"></span></a>
                                    <h3><?= kxn_get_course_title($course_data); ?></h3>
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
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
            </div>
            <div class="featured-courses-mobile">
            <?php
            $home_featured_courses_query_args = array(
                'post_status' => 'publish',
                'posts_per_page' => 8,
                'post_type' => 'cursos',
                'order_by' => 'date',
                'meta_query' => array(
                    array (
                        'key'       => 'course_is_featured',
                        'value'     => '1',
                        'compare'   => 'like',
                    ),
                ),
            );

            $home_featured_courses_query = new WP_Query( $home_featured_courses_query_args );
            if ( $home_featured_courses_query ->have_posts() ) :
                while ( $home_featured_courses_query ->have_posts() ) :
                $home_featured_courses_query ->the_post();
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
                                        <p><?= get_field( 'course_excerpt' ); ?></p>
                                    </div>
                                    <div class="sr-only"><img src="img/views/home/camino-consciente-course.jpg" alt="UNA GUÍA PARA LA AUTOOBSERVACIÓN CONSCIENTE"></div>
                                </figure>
                                <div class="details">
                                    <h3><?php the_title(); ?></h3>
                                    <?php
                                    $instructors= get_posts(array(
                                        'post_type'         => 'instructor',
                                        'posts_per_page'    => 1,
                                        'post__in'          => get_field('course_instructor', false, false),
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
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
            </div>
        </div>
        <?php
        $urlRequest = (is_page_template('home-cursos.php'))?'?search-type=search-by-criteria&s=&order=rand':'/cursos/';
        ?>
        <a href="<?= get_site_url().$urlRequest ?>" class="btn btn-default all-courses-link to-section" title="Ver todos los cursos">Ver todos los cursos</a>
    </div>
</div>
