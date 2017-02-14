<article class="article article-search-result">
<?php
$course_data = get_course_data();
$courseType = kxn_get_course_type( $course_data );
$courseTitle = kxn_get_course_title($course_data);
$originalPrice = kxn_get_course_price($course_data);
$localPrice = kxn_get_course_local_price($course_data);
$courseId = get_field('course_id');
$default_url = '';
$thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
$thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
$venues_args = array(
    'post_type'         => 'centros_de_ensenanza',
    'posts_per_page'    => 1,
);
$instructor = $course_data['instructor'];

?>
    <div class="row" data-course-id="<?= $courseId; ?>">
        <div class="col-md-5 search-results-mobile-image">
            <a href="<?php the_permalink(); ?>">
                <figure class="text-center search-results-course-image" style="background-image:url('<?= $thumb_url ?>')">
                    <div class="title course-type-<?= $courseType; ?>"><?= get_course_type_name( $courseType ); ?></div>
                    <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                    <div class="white-gradient"></div>
                    <h2 class="result-title"><a href="<?php the_permalink(); ?>"><?= $courseTitle; ?></a></h2>
                </figure>
            </a>
        </div>
        <aside class="col-md-7">
            <div class="the-row">

                <div class="col-md-6 course-cats">

                <?php
                $post_tags = get_the_tags();
                if ( $post_tags ) :
                ?>
                    <?php 
                    $totalTags = count($post_tags);
                    for ( $i=0 ; $i < 2 && $i < $totalTags ; $i++ ):  
                        $tag = $post_tags[$i];
                        $tagUrl = add_query_arg( array(
                            's' => '',
                            'search-type' => 'search-by-criteria',
                            'tag' => $tag->slug,
                        ), $homeUrl );
                    ?>
                        <a href="<?= esc_url( $tagUrl ); ?>"><?= $tag->name; ?></a>&nbsp;
                    <?php endfor; ?>
                <?php endif; ?>

                </div>
                
                <div class="col-md-6 shares">
                    <div class="partial-section">
                        <?php get_template_part( 'template-parts/share' ); ?>
                    </div>
                </div>
            </div>
            <h2 class="result-title"><a href="<?php the_permalink(); ?>"><?= $courseTitle; ?></a></h2>
            <div class="author-description col-md-12">
                <?php if ( $course_data['author'] ) : ?>
                <h3><?= $course_data['author']; ?></h3>
                <?php endif; ?>
            </div>
            <div class="the-row row-desc">
                <div class="col-md-7">
                    <p><?= get_field( 'course_excerpt' );?> </p>
                </div>
                <div class="col-md-5">
                    
                    <div class="the-bullet">
                        <span class="icon-cont"><i class="icon icon-calendar"></i></span> <p>Inicia <?= get_course_starting_date( $course_data['starting_date'] );?></p>
                    </div>

                    
                    <div class="the-bullet">
                        <span class="icon-cont"><i class="icon icon-clock"></i></span> <p><?= $course_data['length'] ?></p>
                    </div>
                    
                    <div class="the-bullet">
                        <span class="icon-cont"><i class="icon icon-money"></i></span> <p><span class="original-price"><?=  $originalPrice; ?></span></p>
                    </div>
                    <?php 
                    $locationLbl = 'En línea';
                    if ( $courseType == 'insite' ){
                        $locationLbl = $course_data['location'];
                    }
                    ob_start();
                    ?>
                        <div class="the-bullet">
                            <span class="icon-cont"><i class="glyphicon glyphicon-map-marker"></i></span> <p><span><?= $locationLbl; ?></spam></p>
                        </div>
                        
                    <?php 
                        $bulletTag = ob_get_clean();
                        if ( $courseType == 'insite' && !empty($course_data['location_url']) ){
                            $bulletTag = '<a href="'.$course_data['location_url'].'" target="_blank">'.$bulletTag.'</a>';
                        }
                        echo $bulletTag;
                    ?>
                    
                </div>
            </div>
            <div class="the-row">
                <div class="col-md-7">
                    <div class="btn-cont text-center">
                        <a href="<?php the_permalink(); ?>" class="the-btn">Ver más</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="the-rating">
                        <?php
                        if(function_exists('the_ratings')) { the_ratings(); } 
                        ?>
                        <?php if( have_rows('testimonials') ) : ?>
                        <a class="the-rating-lbl" href="<?php the_permalink(); ?>#testimoniales">
                            Experiencias de alumnos
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="details col-md-12">
                <div class="favs-container">
                    
                </div>
                <?php if ( $courseId ): 
                    $btnLabel = 'Inscribirme ahora';
                    $subscribeUrl =  SUBSCRIBE_URL.$courseId;
                    $aData = '';
                    if ( $course_data['is_free'] ){
                        $subscribeUrl = REDIRECT_URL.$courseId;
                        $aData = 'data-lity-custom';
                        $btnLabel = "Ver ahora gratis";
                    }
                ?>
                <!--div class="subscribe-btn">
                    <a href="<?= $subscribeUrl; ?>" target="_blank" class="btn btn-blue" <?= $aData; ?>><?= $btnLabel; ?></a>
                </div-->
                <?php endif; ?>
            </div>
        </aside>
        <div class="col-md-5 search-results-course-desktop-image">
            <a href="<?php the_permalink(); ?>">
                <figure class="text-center search-results-course-desktop-image" style="background-image:url('<?= $thumb_url ?>')">
                    <div class="title course-type-<?= $courseType; ?>"><?= get_course_type_name( $courseType ) ?></div>
                    <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                    <?php if ( $course_data['video']['url'] ) : ?>
                    <div class="btn-vid-cont text-center">
                        <a class="btn-video" href="<?= $course_data['video']['url']; ?>" data-lity>
                            <span class="icon-cont"><i class="icon icon-play"></i></span><span>Ver video</span>
                        </a>
                    </div>
                    <?php endif; ?>
                </figure>
            </a>
        </div>
    </div>
</article>