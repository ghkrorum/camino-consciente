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

                                            <aside>
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                                        <div class="sr-only"><img src="<?= $thumb_url ?>"></div>
                                                    </figure>
                                                </a>
                                                <div class="details">
                                                    <?php
                                                    $post_tags = get_the_tags();
                                                    if ( $post_tags ) :
                                                        $totalTags = count($post_tags);
                                                    ?>
                                                    <div class="cont-tags">

                                                        <?php
                                                        for ( $i=0 ; $i < 2 && $i < $totalTags ; $i++ ): 
                                                            $tag = $post_tags[$i];
                                                            $tagUrl = add_query_arg( array(
                                                                's' => '',
                                                                'search-type' => 'search-instructor-by-criteria',
                                                                'tag' => $tag->slug,
                                                            ), $homeUrl );
                                                        ?>
                                                        <a href="<?= $tagUrl; ?>"><?= $tag->name; ?></a>&nbsp;
                                                        <?php 
                                                        endfor; 
                                                        ?>
                                                    </div>
                                                    <?php 
                                                    endif; 
                                                    ?>
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <h3><?= sprintf( '%s <br /><strong>%s</strong>', get_field( 'instructor_name' ), get_field( 'instructor_last_name' ) ); ?></h3>
                                                    <?php if ( $instructor_data['profession'] ): ?>
                                                    <h2><?= $instructor_data['profession']; ?></h2>
                                                    <?php endif; ?>
                                                    <p><?= wp_rp_text_shorten( get_the_content(), 160 ); ?></p>
                                                    </a>
                                                </div>
                                            </aside>
                                        
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