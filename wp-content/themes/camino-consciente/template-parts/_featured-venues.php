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

                                if ( has_post_thumbnail() ) :
                                    $default_url = '';
                                    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'venue-featured' );
                                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; 
                                    $location = get_location_from_object($post);
                                    $locationUrl = get_field('venue_google_maps_url');
                                    
                        ?>

                                    <div class="col-md-12 temple">
                                        
                                            <aside>
                                                <a href="<?php the_permalink(); ?>" class="to-section">
                                                    <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                                        <div class="sr-only"><img src="<?= $thumb_url ?>"></div>
                                                    </figure>
                                                </a>
                                                <div class="details">
                                                    <div class="details-cont">
                                                        <h3><?php the_title(); ?></h3>
                                                        <?php
                                                        if ( $location || $locationUrl ):
                                                        ?>
                                                        <div class="temple-location">
                                                            <?php if ($locationUrl): ?>
                                                            <a href="<?= $locationUrl; ?>" target="_blank">
                                                            <?php endif; ?>
                                                                <div  class="btn-location">
                                                                    <span class="icon-cont"><i class="icon icon-map-marker"></i></span><span><?= $location; ?></span>
                                                                </div>
                                                            <?php if ($locationUrl): ?>
                                                            </a>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php 
                                                        endif;
                                                        ?>
                                                    </div>
                                                </div>
                                            </aside>
                                        
                                    </div>
                                <?php endif; ?>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                        <a href="<?= get_site_url(); ?>/centros-de-ensenanza/" class="btn btn-default downcase all-centers">Ver todos los centros</a>
                    </div>