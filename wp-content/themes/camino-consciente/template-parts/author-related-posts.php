            <?php
            $relatedPosts = get_posts(array(
                'numberposts' => 4,
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key' => 'entry_author',
                        'value' => '"' . $authorId . '"',
                        'compare' => 'LIKE'
                    )
                )
            ));

            $authorName = get_field( 'instructor_name', $authorId ).' '.get_field( 'instructor_last_name', $authorId );

            if ( !trim($authorName) ){
                $authorName = get_the_title($authorId);
            }

            if ( $relatedPosts ) :
            ?>
            <div class="partial-section">
                <div class="featured-courses">
                    <h3 class="title main-title"><?= sprintf( 'Artículos de %s', $authorName ); ?></h3>
                    <div class="container">
                        <div class="row">
                            <?php
                                foreach ( $relatedPosts as $post ) :
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
                                                        <div class="description">
                                                            <p><?= wp_rp_text_shorten( get_the_excerpt( $post->ID ), 180 ); ?></p>
                                                        </div>
                                                        <div class="sr-only"><img src="img/views/home/camino-consciente-course.jpg" alt="UNA GUÍA PARA LA AUTOOBSERVACIÓN CONSCIENTE"></div>
                                                    </figure>
                                                    <div class="details">
                                                        <h3><?php the_title(); ?></h3>
                                                        <p><?= $authorName ?></p>
                                                        
                                                    </div>
                                                </aside>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            endif;
            wp_reset_postdata();
            ?>