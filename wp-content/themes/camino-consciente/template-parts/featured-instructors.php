<!-- instructors -->
<div class="featured-instructors">
    <h3 class="title main-title">Instructores Destacados</h3>
    <div class="container">
        <div class="row">
            <?php
            $featured_instructors_query_args = array(
                'post_status' => 'publish',
                'posts_per_page' => 4,
                'post_type' => 'instructor',
                'order_by' => 'date',
                'meta_query' => array(
                    array (
                        'key'	  	=> 'instructor_is_featured',
                        'value'	  	=> '1',
                        'compare' 	=> 'like',
                    ),
                ),
            );

            $featured_instructors_query = new WP_Query( $featured_instructors_query_args );
            if ( $featured_instructors_query ->have_posts() ) :
                while ( $featured_instructors_query ->have_posts() ) :
                $featured_instructors_query ->the_post();
                $course_data = get_course_data();
                if ( has_post_thumbnail() ) :
                    $default_url = '';
                    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'instructor-featured' );
                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
            ?>
                <div class="col-md-3 instructor">
                    <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
                        <aside>
                            <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                <div class="sr-only"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"></div>
                            </figure>
                            <div class="details">
                                <h3><?= get_field( 'instructor_name', $post->ID ); ?> <b><?= get_field( 'instructor_last_name', $post->ID ); ?></b></h3>
                                <p><?= wp_rp_text_shorten( get_the_excerpt( $post->ID ), 180 ); ?></p>
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
        <!-- row -->
        <a href="<?= get_site_url() ?>/instructores/" class="btn btn-default to-section all-instructors-link" title="Ver todos los instructores">Ver todos los instructores</a>
    </div>
</div>
<!-- instructors -->
