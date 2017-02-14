<div class="more-articles">
    <div class="container text-center">
        <div class="row text-left more-articles-row">
            <?php
            $exclude_post_ids = array();
            $more_articles_query_args = array(
                'post_status' => 'publish',
                'post_type' => 'post',
                'posts_per_page' => 3,
                'order_by' => 'date',
                'post__not_in' => $published_posts_ids,
            );
            $more_articles_query = new WP_Query( $more_articles_query_args );
            if ( $more_articles_query  ->have_posts() ) :
                while ( $more_articles_query  ->have_posts() ) :
                    $more_articles_query->the_post();
                    $exclude_post_ids[] = get_the_ID();
                    include('_more-articles-item.php');
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <?php echo do_shortcode('[ajax_load_more ajax_load_more repeater="template_4" post_type="post"  post__not_in="' . implode(",", $exclude_post_ids ) . '" posts_per_page="6" scroll="true" pause="false" button_label = "Ver más" button_loading_label="Cargando más artículos"]'); ?>
    </div>
</div>
