<?php get_header(); ?>

<div id="wrapper" class="wrapper-interior">
    <div class="section" id="home-blog-section">
        <div class="container">
            <div class="row">
                <?php
                $exclude_post_ids = array();
                $category_id = get_queried_object_id();
                $categpry_slug = get_queried_object()->slug;
                $featured_post_query_args = array(
                    'post_status' => 'publish',
                    'posts_per_page' => 1,
                    'post_type' => 'post',
                    'order_by' => 'date',
                    'cat' => $category_id,
                    'meta_query' => array(
                        array (
                            'key'	  	=> 'show_as_featured',
                            'value'	  	=> '1',
                            'compare' 	=> 'like',
                        ),
                    ),
                );

                $featured_post_query = new WP_Query( $featured_post_query_args );

                if ( $featured_post_query ->have_posts() ) :
                    while ( $featured_post_query ->have_posts() ) :
                        $featured_post_query ->the_post();
                        if ( has_post_thumbnail() ) :
                            $default_url = '';
                            $thumb_url =  get_the_post_thumbnail_url( $post->ID );
                            $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                            $exclude_post_ids[] = $post->ID;
                            ?>
                            <div class="col-md-7 big big-mobile post-<?= $post->ID?>" onclick="location.href='<?= the_permalink(); ?>';" style="cursor: pointer;">
                                <div class="inner-grid-head-mobile">
                                    <div class="inner-grid-head-mobile-wrap">
                                        <span class="title title-labeled"><?= single_cat_title( "", false ) ?></span>
                                        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                                        
                                    </div>
                                </div>
                                <div class="inner-grid inner-grid-head" style="background-image:url('<?= $thumb_url ?>');">
                                    <div class="cell-center">
                                        <span class="title title-labeled"><?= single_cat_title( "", false ) ?></span>
                                        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                                    </div>
                                    <div class="white-gradient" style="background-image:url(<?= THEME_DIR ?>/img/views/home-blog/gradient.png);"></div>
                                </div>
                            </div>

                        <?php endif;  ?>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();

                $featured_post_aside_query_args = array(
                    'post_status' => 'publish',
                    'posts_per_page' => 2,
                    'post_type' => 'post',
                    'order_by' => 'date',
                    'cat' => $category_id,
                    'post__not_in' => $exclude_post_ids,
                    'meta_query' => array(
                        array (
                            'key'	  	=> 'show_as_featured_aside',
                            'value'	  	=> '1',
                            'compare' 	=> 'like',
                        ),
                    ),
                );

                $featured_post_aside_query = new WP_Query( $featured_post_aside_query_args );

                if ( $featured_post_aside_query ->have_posts() ) :
                    while ( $featured_post_aside_query ->have_posts() ) :
                        $featured_post_aside_query ->the_post();
                        $exclude_post_ids[] = $post->ID;
                        if ( has_post_thumbnail() ) :
                            $default_url = '';
                            $thumb_url =  get_the_post_thumbnail_url( $post->ID );
                            $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
                            <div class="col-md-5 side post-<?= $post->ID?>" onclick="location.href='<?= the_permalink(); ?>';" style="cursor: pointer;">
                                <div class="col-md-12 inner-grid" style="background-image:url('<?= $thumb_url ?>');">
                                    <div class="cell-center">
                                        <span class="title title-labeled"><?= single_cat_title( "", false ) ?></span>
                                        <span class="home-blog-side-description"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?= wp_rp_text_shorten( get_the_title() , 50 ); ?></a></span>
                                    </div>
                                    <div class="white-gradient" style="background-image:url(img/views/home-blog/gradient-b.png);"></div>
                                </div>
                            </div>
                        <?php endif;  ?>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <div class="partial-section"><?php get_template_part( 'template-parts/featured-courses' ); ?></div>

        <div class="partial-section">
            <!-- articles -->
            <div class="featured-articles hey">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <?php
                        $posts_query_args = array(
                            'post_status' => 'publish',
                            'posts_per_page' => 6,
                            'post_type' => 'post',
                            'order_by' => 'date',
                            'cat' => $category_id,
                            'post__not_in' => $exclude_post_ids,
                        );

                        $posts_query = new WP_Query( $posts_query_args );

                        if ( $posts_query ->have_posts() ) :
                            while ( $posts_query ->have_posts() ) :
                                $posts_query ->the_post();
                                $exclude_post_ids[] = $post->ID;
                                if ( has_post_thumbnail() ) :
                                    $default_url = '';
                                    $thumb_url =  get_the_post_thumbnail_url( $post->ID );
                                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                                    $author = '';
                                    $authorArray = get_field('entry_author');
                                    if ($authorArray){
                                        $author = kxn_get_post_author($authorArray[0]);
                                    } 
                                    $category = kxn_get_single_cat_title();
                        ?>
                                    <div class="col-md-4 article post-<?= $post->ID?>">
                                        <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
                                            <article>
                                                <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                                                    <div class="sr-only"><img src="<?= $thumb_url ?>" alt="UNA GUÍA PARA LA AUTOOBSERVACIÓN CONSCIENTE"></div>
                                                </figure>
                                                <div class="details">
                                                    <span class="title title-labeled"><?= $category; ?></span>
                                                    <h3><?php the_title(); ?> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
                                                    <?php if ($author) : ?>
                                                    <p class="author"><?= $author; ?></p>
                                                    <?php endif; ?>
                                                </div>
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
                    <!-- row -->
                    <div class="row">
                        <?php echo do_shortcode('[ajax_load_more ajax_load_more repeater="template_1" post_type="post" category="' . $categpry_slug . '" post__not_in="' . implode(",", $exclude_post_ids ) . '" posts_per_page="12" scroll="true" pause="false" button_label = "Ver más" button_loading_label="Cargando más artículos"]'); ?>

                    </div>
                </div>
            </div>
            <!-- articles -->
        </div>
    </div>
</div>

<?php get_footer(); ?>

