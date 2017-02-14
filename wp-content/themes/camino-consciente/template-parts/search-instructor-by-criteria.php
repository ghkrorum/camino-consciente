<?php get_header(); ?>

<div id="wrapper" class="wrapper-interior">
    <div id="filtros-curso" class="section filtro-instructores">
        <div class="container">
            <div class="row">
                <div class="col-md-3 in-the-zone-container">
                    <div class="row header row-search-form <?= (!is_page())?'row-search-form-desktop':''; ?>">
                        <div class="col-md-12 filter">
                            <div class="row white-gradient">
                                <div class="col-md-12">
                                    <h1>Busca el instructor <br>perfecto para tí</h1>
                                    <div class="row search-form">
                                        <form id="form-search-by-criteria" class="" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                            <input type="hidden" name="search-type" value="search-instructor-by-criteria" />
                                            <input type="hidden" name="s" value="" />
                                            <div class="col-md-12">
                                                <div class="selectable select-content">
                                                    <?php generate_country_dropdown(); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 cities-dropdown-cont">
                                                <div class="selectable select-content">
                                                    <?php generate_cities_dropdown(); ?>
                                                </div>
                                                <input class="submit-selectable" type="submit" value="Buscar">
                                            </div>
                                        </form>
                                        <!-- <form id="form-search-by-criteria" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                            <input type="hidden" name="search-type" value="search-instructor-by-instructor" />
                                            <input type="hidden" name="s" value="" />
                                            <div class="col-md-3">
                                                <div class="selectable">
                                                    <?php generate_instructors_dropdown(); ?>
                                                </div>
                                                <input class="submit-selectable submit-instructor" type="submit" value="Buscar">
                                            </div>
                                        </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php include_once('_featured-instructors.php');?>

                    <?php include_once('_featured-venues.php');?>
                </div>
                <?php
                $exclude_post_ids = array();
                ?>
                <div class="col-md-9 articles-container">
                    <?php if (!is_page()) :?>
                    <h1>Resultados de tu búsqueda:</h1>
                    <?php else: ?>

                    <?php
                    $relatedPosts = get_field('featured_posts');
                    
                    if ( $relatedPosts ):
                        foreach( $relatedPosts as $post ):
                            setup_postdata( $post );
                            $exclude_post_ids[] =  $post->ID;
                            $default_url = '';
                            $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
                            $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;

                            include '_instructor-item.php';

                        endforeach;
                    endif;

                    wp_reset_postdata();
                    ?>

                    <?php endif; ?>

                    <?php
                    $country_id = $_GET['country'];
                    $city_id = $_GET['city'];
                    $searchTag = (isset($_GET['tag']))?$_GET['tag']:'';

                    $search_query_args = array(
                        'post_status'       => 'publish',
                        'posts_per_page'    => 10,
                        'post_type'         => 'instructor',
                        'order_by'          => 'date',
                        'post__not_in'      => $exclude_post_ids,
                    );

                    $almTaxonomy = array();
                    $almTerms = array();

                    if ($country_id){
                        $term = get_term( $country_id, 'ubicacion' );
                        $almTaxonomy[] = 'ubicacion';
                        $almTerms[] = $term->slug;
                    }
                    $citySlug = '';
                    if ($city_id){
                        $term = get_term( $city_id, 'ubicacion' );
                        $almTaxonomy[] = 'ubicacion';
                        $almTerms[] = $term->slug;
                    }

                    

                    if( $country_id == '' && $city_id ) {
                        $search_query_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'ubicacion',
                                'field'    => 'term_id',
                                'terms'    => (int) $city_id,
                            ),
                        );
                    }

                    if( $country_id && $city_id == '' ) {
                        $search_query_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'ubicacion',
                                'field'    => 'term_id',
                                'terms'    => (int) $country_id,
                            ),
                        );
                    }

                    if( $country_id && $city_id  ) {
                        $search_query_args['tax_query'] = array(
                            'relation' => 'AND',
                            array(
                                'taxonomy'  => 'ubicacion',
                                'field'     => 'term_id',
                                'terms'     => (int) $country_id,
                            ),
                            array(
                                'taxonomy'  => 'ubicacion',
                                'field'     => 'term_id',
                                'terms'     => (int) $city_id,
                            ),
                        );
                    }

                    if ( $searchTag ){
                        $search_query_args['tag'] = array($searchTag);
                    }

                    $search_query = new WP_Query( $search_query_args );
                    if ( $search_query ->have_posts() ) :
                        while ( $search_query ->have_posts() ) :
                            $search_query ->the_post();
                            setup_postdata( $post );
                            $exclude_post_ids[] =  $post->ID;

                            include '_instructor-item.php';

                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
<?php echo do_shortcode('[ajax_load_more repeater="template_8"  post_type="instructor" tag="'.$searchTag.'" taxonomy="'. implode(':', $almTaxonomy) .'" taxonomy_terms="'. implode(':', $almTerms) .'" post__not_in="' . implode(",", $exclude_post_ids ) . '" button_label = "Ver más" button_loading_label="Cargando más instructores" ]'); ?>

                </div>
            </div>
            <div class="row header row-search-form row-search-form-mobile <?= (is_page())?'hide':''; ?>">
                <div class="col-md-12 filter">
                    <div class="row white-gradient">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <h1>Busca el instructor <br>perfecto para tí</h1>
                                        <div class="row">
                                            <form id="form-search-by-criteria" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                <input type="hidden" name="search-type" value="search-instructor-by-criteria" />
                                                <input type="hidden" name="s" value="" />
                                                <div class="col-md-3">
                                                    <div class="selectable">
                                                        <?php generate_country_dropdown(); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="selectable">
                                                        <?php generate_cities_dropdown(); ?>
                                                    </div>
                                                    <input class="submit-selectable" type="submit" value="Buscar">
                                                </div>
                                            </form>
                                            <!-- <form id="form-search-by-criteria" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                <input type="hidden" name="search-type" value="search-instructor-by-instructor" />
                                                <input type="hidden" name="s" value="" />
                                                <div class="col-md-3">
                                                    <div class="selectable">
                                                        <?php generate_instructors_dropdown(); ?>
                                                    </div>
                                                    <input class="submit-selectable submit-instructor" type="submit" value="Buscar">
                                                </div>
                                            </form> -->
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#filtros-curso .selectable').each(function(index, el) {
                var _placeholder = $(this).find("select").data("placeholder");
                $(el).selectable({placeholder:_placeholder});
            });
        });
    </script>
</div>

<?php get_footer(); ?>
