<div id="home-carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicadores -->
    <!-- <ol class="carousel-indicators">
                                    <li data-target="#home-carousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#home-carousel" data-slide-to="1"></li>
                                    <li data-target="#home-carousel" data-slide-to="2"></li>
    </ol> -->
    <div class="carousel-inner" role="listbox">
        <?php
        $home_featured_article_query_args = array(
            'post_status' => 'publish',
            'post_type' => 'post',
            'posts_per_page' => 4,
            'order_by' => 'date',
            'meta_query' => array(
                array (
                    'key'	  	=> 'show_in_home_slider',
                    'value'	  	=> '1',
                    'compare' 	=> 'like',
                ),
            ),
        );

        $current_post = 0;
        $home_featured_article_query = new WP_Query( $home_featured_article_query_args );
        if ( $home_featured_article_query ->have_posts() ) :
            while ( $home_featured_article_query ->have_posts() ) :
                $home_featured_article_query ->the_post();
                $current_post++;
                $post_class = ( $current_post <= 1 ) ? 'item active' : 'item';
                if ( has_post_thumbnail() ) :
                    $default_url = '';
                    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'home-slider' );
                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                    $published_posts_ids[] = $post->ID;
                    ?>
                    <div class="<?= $post_class; ?>" style="background-image:url('<?= $thumb_url ?>');">
                        <div class="sr-only">
                            <img class="first-slide" src="img/views/home/camino-consciente-carousel-background.jpg" alt="First slide">
                        </div>
                        <div class="container white-gradient">
                            <div class="carousel-caption">
                                <span class="title title-labeled"><?= get_first_category_link( $post->ID ) ?></span>
                                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                                
                                <div class="compartir">
                                    <a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink() ?>" title="Compartir con mail">
                                        <img src="<?= THEME_DIR ?>/img/views/share/ma.png" alt="comparte">
                                    </a>
                                    <a href="#/" target="_blank" onclick="return socialshare('facebook', '<?php echo get_the_permalink(); ?>', '<?php the_title(); ?>');" title="Compartir por facebook">
                                        <img src="<?= THEME_DIR ?>/img/views/share/fb.png" alt="comparte">
                                    </a>
                                    <a href="#/" onclick="return socialshare('twitter', '<?php echo get_the_permalink(); ?>', '<?php echo get_the_title();?>');" title="Compartir por twitter" target="_blank">
                                        <img src="<?= THEME_DIR ?>/img/views/share/tw.png" alt="comparte">
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
    <a class="left carousel-control" href="#home-carousel" role="button" data-slide="prev">
        <span class="icon icon-prev" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#home-carousel" role="button" data-slide="next">
        <span class="icon icon-next" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
