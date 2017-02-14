<!-- courses -->
<div class="featured-temples">
    <h3 class="title main-title">Centros Destacados</h3>
    <div class="container">
        <div class="row">
            <?php
            $featured_venues_query_args = array(
                'post_status' => 'publish',
                'posts_per_page' => 2,
                'post_type' => 'centros_de_ensenanza',
                'order_by' => 'date',
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
                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
            ?>
                <div class="col-md-6 temple">
                    <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
                        <aside>
                            <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                <div class="sr-only"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"></div>
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
        </div>
        <a href="<?= get_site_url() ?>?s=&search-type=search-venue-by-criteria&order=rand" class="btn btn-default all-temples-link to-section" title="Ver todos los cursos">Ver todos los centros</a>
    </div>
</div>
