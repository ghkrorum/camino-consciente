<?php
$location = get_location_from_object( $post );
$vdata = get_venue_data();
$videoUrl = $vdata['video']['video_url'];
                            
$default_url = '';
$thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
$thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
?>
<!-- init article -->
<article class="article article-venue">
    <div class="row">
        <div class="col-md-5 search-results-mobile-image">
            <a href="<?php the_permalink(); ?>">
                <figure class="text-center search-results-course-image" style="background-image:url('<?= $thumb_url ?>')">
                    <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                    <div class="white-gradient"></div>
                    <h2 class="result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </figure>
            </a>

            <?php
            if ( $videoUrl ) :
            ?>
            <div class="btn-vid-cont">
                <a href="<?= $videoUrl; ?>" data-lity>
                    <div class="icon-video btn-video">
                        <span class="icon-cont">
                        <i class="icon icon-play"></i>
                        </span>
                        <span class="title-video">Ver video</span>
                    </div>
                </a>
            </div>
            <?php 
            endif; 
            ?>
        </div>
        <aside class="col-md-7">
            <div class="the-row">
                
                <div class="col-md-6 shares">
                    <div class="partial-section">
                        <?php get_template_part( 'template-parts/share' ); ?>
                    </div>
                </div>


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
                            'search-type' => 'search-venue-by-criteria',
                            'tag' => $tag->slug,
                        ), $homeUrl );
                    ?>
                        <a href="<?= esc_url( $tagUrl ); ?>"><?= $tag->name; ?></a>&nbsp;
                    <?php endfor; ?>
                <?php endif; ?>
                </div>
            </div>

            <h2 class="result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php if ( $vdata['specialty'] ) : ?>
            <h3 class="lecturer-position"><?= $vdata['specialty']; ?></h3>
            <?php endif; ?>

            <div class="the-row row-desc">
                <div class="details col-md-4 features">
                    <div class="the-row">
                        <div class="col-md-12">
                            <?php if ( $vdata['email'] ): ?>
                            <a href="mailto:<?= $vdata['email']; ?>">
                                <div class="the-bullet contact">
                                    <span class="icon-cont"><i class="glyphicon glyphicon-envelope"></i></span> <div>Contáctame</div>
                                </div>
                            </a>
                            <?php endif; ?>
                            <?php if ( $vdata['social_networks']['facebook'] ): ?>
                            <a href="<?= $vdata['social_networks']['facebook']; ?>" class="social-btn fb" target="_blank">
                                <i class="icon icon-fb"></i>
                            </a>
                            <?php endif; ?>
                            <?php if ( $vdata['social_networks']['twitter'] ): ?>
                            <a href="<?= $vdata['social_networks']['twitter']; ?>" class="social-btn tw" target="_blank">
                                <i class="icon icon-tw"></i>
                            </a>
                            <?php endif; ?>
                            <?php if ( $vdata['social_networks']['instagram'] ): ?>
                            <a href="<?= $vdata['social_networks']['instagram']; ?>" class="social-btn instagram" target="_blank">
                                <i class="icon icon-instagram"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php if ( $vdata['website'] ): ?>
                        <div class="col-md-12">
                            <a href="<?= $vdata['website']; ?>" target="_blank">
                                <div class="the-bullet website">
                                    <span class="icon-cont"><i class=""></i></span> <p>Ir a página web</p>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if ($location): ?>
                        <div class="col-md-12">
                            <?php if ( $vdata['gmaps_url'] ) : ?>
                            <a href="<?= $vdata['gmaps_url']; ?>" target="_blank">
                            <?php endif; ?>
                                <div class="the-bullet location">
                                    <span class="icon-cont"><i class="glyphicon glyphicon-map-marker"></i></span> <div><?= $location ?></div>
                                </div>
                            <?php if ( $vdata['gmaps_url'] ) : ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="col-md-8">
                    <div class="author-description col-md-12">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>

            <div class="the-row">
                <div class="col-md-4 rating_holder">
                    <div class="the-row">
                        
                        <div class="favs-container">
                        <?php
                        if(function_exists('the_ratings')) { the_ratings(); } 
                        ?>
                        </div>
                        <?php if( have_rows('testimonials') ) : ?>
                        <a class="the-rating-lbl" href="<?php the_permalink(); ?>#testimoniales">
                            Experiencias de alumnos
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-8 btn_more">
                    <div class="the-row text-center">
                        <a href="<?php the_permalink(); ?>" class="the-btn">Ver más</a>
                    </div>
                </div>
            </div>
        </aside>
        <div class="col-md-5 search-results-course-desktop-image">
            <a href="<?php the_permalink(); ?>">
                <figure class="text-center search-results-course-desktop-image" style="background-image:url('<?= $thumb_url ?>')">
                    <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                </figure>
            </a>
            
            <?php
            if ( $videoUrl ) :
            ?>
            <div class="btn-vid-cont">
                <a href="<?= $videoUrl; ?>" data-lity>
                    <div class="icon-video btn-video">
                        <span class="icon-cont">
                        <i class="icon icon-play"></i>
                        </span>
                        <span class="title-video">Ver video</span>
                    </div>
                </a>
            </div>
            <?php 
            endif; 
            ?>
        </div>
    </div>
</article>
<!-- end article -->    