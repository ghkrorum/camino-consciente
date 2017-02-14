<div class="latest-articles">
    <h3 class="title main-title">Últimos Artículos</h3>
    <div class="container white-gradient">
        <div class="row text-center">
            <?php
            $home_latest_articles_query_args = array(
                'post_status' => 'publish',
                'post_type' => 'post',
                'posts_per_page' => 4,
                'order_by' => 'date',
                'post__not_in' => $published_posts_ids,
                'meta_query' => array(
                    array (
                        'key'	  	=> 'show_in_home_slider',
                        'value'	  	=> '1',
                        'compare' 	=> 'not like',
                    ),
                ),
            );

            $home_featured_articles_query = new WP_Query( $home_latest_articles_query_args );
            if ( $home_featured_articles_query ->have_posts() ) :
                while ( $home_featured_articles_query ->have_posts() ) :
                    $home_featured_articles_query ->the_post();
                    $course_data = get_course_data();
                    $published_posts_ids[] = $post->ID;
                    $theCategory = get_the_category( $post->ID );
                    $catName = ($theCategory)?$theCategory[0]->cat_name:'';
                    if ( has_post_thumbnail() ) :
                        $default_url = '';
                        $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
                        $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                        ?>

                        <div class="col-md-6 latest-article">
                            <a href="<?php the_permalink(); ?>" class="to-section">
                                <article class="article">
                                    <figure style="background-image: url('<?= $thumb_url ?>');">
                                        <div class="sr-only"><img src="<?= $thumb_url ?>" alt="Mente y emociones"></div>
                                    </figure>
                                    <aside class="aside">
                                        <span class="title title-labeled"><?= $catName; ?></span>
                                        <p><?= wp_rp_text_shorten( get_the_title() , 90 ); ?></p>
                                    </aside>
                                </article>
                            </a>
                        </div>
                    <?php endif;  ?>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
