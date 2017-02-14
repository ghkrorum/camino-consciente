<?php
/**
 * Template Name: Calendario
 *
 * @package WordPress
 * @subpackage camino_consciente
 * @since Camino Consciente 1.0
 */

get_header(); ?>

<div id="wrapper">

    <div class="section" id="home-calendario-section">
        <div class="row header">
            <div class="col-md-12 filter">
                <div class="row white-gradient">
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2">
                            <h1>Elige tu país <br>y revisa los cursos y sesiones que tenemos para tí</h1>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <form action="#" class="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="selectable">
                                            <?php generate_month_dropdown(); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="selectable">
                                            <?php generate_country_dropdown(); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="selectable">
                                            <?php generate_cities_dropdown(); ?>
                                        </div>
                                        <input class="submit-selectable" type="submit" value="Buscar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="partial-section">
            <!-- courses -->
            <div class="featured-courses">
                <h3 class="title main-title">Cursos</h3>
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <?php
                        $courses_query_args = array(
                            'post_status' => 'publish',
                            'posts_per_page' => 8,
                            'post_type' => 'cursos',
                            'order_by' => 'date',
                        );

                        $courses_query = new WP_Query( $courses_query_args );

                        if ( $courses_query ->have_posts() ) :
                            while ( $courses_query ->have_posts() ) :
                            $courses_query ->the_post();
                            $course_data = get_course_data();
                            if ( has_post_thumbnail() ) :
                                $default_url = '';
                                $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
                                $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                                <!-- cousrse init -->
                                <div class="col-md-3 course">
                                    <a href="<?php esc_url( the_permalink() ); ?>" class="to-section" title="<?php the_title(); ?>">
                                        <aside>
                                            <figure class="image" style="background-image:url('<?= $thumb_url ?>'">
                                                <span class="title course-type-<?= $course_data['type']; ?>"><?= get_course_type_name( $course_data['type'] ) ?></span>
                                                <div class="description">
                                                    <p><?= wp_rp_text_shorten( get_the_excerpt( $post->ID ), 180 ); ?></p>
                                                </div>
                                                <div class="sr-only"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"></div>
                                            </figure>
                                            <div class="details">
                                                <h3><?php the_title(); ?></h3>
                                                <?php
                                                $instructors= get_posts(array(
                                                    'post_type'         => 'instructor',
                                                    'posts_per_page'    => 1,
                                                    'post__in'			=> get_field('instructor', false, false),
                                                ));

                                                foreach ( $instructors as $instructor ) : ?>
                                                    <p><?= get_field( 'instructor_name', $instructor->ID ); ?> <?= get_field( 'instructor_last_name', $instructor->ID ); ?></p>
                                                <?php endforeach; ?>
                                                <span class="date">Fecha de Inicio: <?= get_course_starting_date( $course_data['starting_date'] );?></span>
                                            </div>
                                        </aside>
                                    </a>
                                </div>
                                <!-- cousrse end -->
                            <?php endif; ?>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <!-- row -->
                <a href="cursos.html" class="btn btn-default all-courses-link to-section" title="Ver todos los cursos">Ver todos los cursos</a>
            </div>
        </div>
        <!-- courses -->
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#home-calendario-section .selectable').each(function(index, el) {
                var _placeholder = $(this).find("select").data("placeholder");
                $(el).selectable({placeholder:_placeholder});
            });
        });
    </script>

</div>

<?php get_footer(); ?>
