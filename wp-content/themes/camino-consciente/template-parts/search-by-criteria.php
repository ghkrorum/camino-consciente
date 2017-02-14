<?php 
get_header(); 
$homeUrl = esc_url( home_url( ) );
?>

<div id="wrapper" class="wrapper-interior">
    <div id="filtros-curso" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 in-the-zone-container">
                    <div class="row header row-search-form <?= (!is_page())?'row-search-form-desktop':''; ?>">
                        <div class="col-md-12 filter">
                            <div class="row white-gradient">
                                <div class="col-md-12">
                                    <h1>Conoce más cursos.</h1>
                                </div>
                                <div class="col-md-12">
                                    <div class="row search-form">
                                        <div class="col-md-12">
                                            <div class="form-wrap">
                                                <h2>Elige un curso en línea</h2>
                                                <form id="form-search-by-category" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                    
                                                        <input type="hidden" name="search-type" value="search-by-criteria" />
                                                        <input type="hidden" name="s" value="" />
                                                        
                                                        <div class="selectable select-content">
                                                            <?php generate_categories_dropdown(); ?>
                                                        </div>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-wrap">
                                                <h2>Elige un curso presencial</h2>
                                                <form id="form-search-by-criteria" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                    <div class="form-wrap">
                                                        <input type="hidden" name="search-type" value="search-by-criteria" />
                                                        <input type="hidden" name="s" value="" />
                                                        
                                                        <div class="selectable select-content">
                                                            <?php generate_categories_dropdown(); ?>
                                                        </div>
                                                    
                                                    
                                                        <div class="selectable select-content">
                                                            <?php generate_country_dropdown(); ?>
                                                        </div>
                                                    
                                                    
                                                        <div class="selectable select-content">
                                                            <?php generate_cities_dropdown(); ?>
                                                        </div>
                                                        <input class="submit-selectable" type="submit" value="Buscar">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-wrap">
                                                <h2>Elige por instructor</h2>
                                                <form id="form-search-by-instructor" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                    <input type="hidden" name="search-type" value="search-by-criteria" />
                                                    <input type="hidden" name="s" value="" />
                                                    <div class="selectable select-content">
                                                        <?php generate_instructors_dropdown(); ?>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
                            $exclude_post_ids[] = $post->ID;
                            include '_course_item.php';
                        endforeach;
                    endif;

                    wp_reset_postdata();
                    ?>

                    <?php endif; ?>
                    <?php
                    

                    $category_id = $_GET['categories'];
                    $country_id = $_GET['country'];
                    $city_id = $_GET['city'];
                    $instructor_id = $_GET['instructor'];
                    $order = (isset($_GET['order']))?$_GET['order']:'date';
                    $searchTag = (isset($_GET['tag']))?$_GET['tag']:'';

                    $search_query_args = array(
                        'post_status'       => 'publish',
                        'post_type'         => 'cursos',
                        'order_by'          => $order,
                        'post__not_in'      => $exclude_post_ids,
                    );

                    $categorySlug = '';
                    if( $category_id ){
                        $search_query_args['cat'] = (int) $category_id;
                        $category = &get_category($cat_id);
                        $categorySlug =  $category->slug;
                    }

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

                    if( $city_id && $country_id == '' ) {
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

                    if( $instructor_id && $instructor_id  ) {
                        $search_query_args['meta_query'] = array(
                            array(
                                'key' => 'course_instructor',
                                'value' => $instructor_id,
                                'compare'   => 'like',
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
                            $exclude_post_ids[] = $post->ID;
                            include '_course_item.php';

                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                    <?php echo do_shortcode('[ajax_load_more repeater="template_6" post_type="cursos" tag="'.$searchTag.'" post__not_in="' . implode(",", $exclude_post_ids ) . '"  category="'.$categorySlug.'" taxonomy="'. implode(':', $almTaxonomy) .'" taxonomy_terms="'. implode(':', $almTerms) .'"  meta_key="course_instructor" meta_value="'.$instructor_id.'" meta_compare="LIKE" button_label = "Ver más" button_loading_label="Cargando más cursos" scroll="true"]'); ?>
                </div>
            </div>
            <div class="row header row-search-form row-search-form-mobile <?= (is_page())?'hide':''; ?>">
                <div class="col-md-12 filter">
                    <div class="row white-gradient">
                        <div class="col-md-12">
                            <h1>Tenemos cursos en línea y presenciales. Elige abajo.</h1>
                        </div>
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-wrap">
                                        <h2>Elige un curso en línea</h2>
                                        <form id="form-search-by-criteria" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                            
                                                <input type="hidden" name="search-type" value="search-by-criteria" />
                                                <input type="hidden" name="s" value="" />
                                                
                                                <div class="selectable">
                                                    <?php generate_categories_dropdown(); ?>
                                                </div>

                                                <input class="submit-selectable" type="submit" value="Buscar">
                                            
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-wrap">
                                        <h2>Elige un curso presencial</h2>
                                        <form id="form-search-by-criteria" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                            <div class="form-wrap">
                                                <input type="hidden" name="search-type" value="search-by-criteria" />
                                                <input type="hidden" name="s" value="" />
                                                
                                                <div class="selectable">
                                                    <?php generate_categories_dropdown(); ?>
                                                </div>
                                            
                                            
                                                <div class="selectable">
                                                    <?php generate_country_dropdown(); ?>
                                                </div>
                                            
                                            
                                                <div class="selectable">
                                                    <?php generate_cities_dropdown(); ?>
                                                </div>
                                                <input class="submit-selectable" type="submit" value="Buscar">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-wrap">
                                        <h2>Elige por instructor</h2>
                                        <form id="form-search-by-instructor" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                            <input type="hidden" name="search-type" value="search-by-criteria" />
                                            <input type="hidden" name="s" value="" />
                                            <div class="selectable">
                                                <?php generate_instructors_dropdown(); ?>
                                            </div>
                                        </form>
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
    </script>
</div>
<div class="login-frame-cont">
    <div id="redirect-frame-cont" class="login-frame">
        <iframe id="redirect-frame" scrolling="no"  src="" width="320" height="auto"></iframe>
    </div>
</div>
<?php get_footer(); ?>
