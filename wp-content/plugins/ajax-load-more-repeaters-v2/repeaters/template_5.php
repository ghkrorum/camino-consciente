<?php
$thumb_url = '';
                                    if ( has_post_thumbnail() )
                                        $thumb_url =  get_the_post_thumbnail_url( get_the_ID() );
?>
<article class="article article-search-result">
                                <div class="row">
                                    <div class="col-md-5 search-results-mobile-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <figure class="text-center search-results-course-image" style="background-image:url('<?= $thumb_url ?>')">
                                                
                                                <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                                                <div class="white-gradient"></div>
                                                <h2 class="result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            </figure>
                                        </a>
                                    </div>
                                    <aside class="col-md-7">
                                        <div class="col-md-5 shares">
                                            <div class="partial-section">
                                                <?php get_template_part( 'template-parts/share' ); ?>
                                            </div>
                                        </div>
                                        <h2 class="result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="author-description col-md-7">
                                            
                                            <p></p>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-default">Ver más</a>
                                        </div>
                                        <div class="details col-md-5">
                                            
                                            
                                            
                                        </div>
                                    </aside>
                                    <div class="col-md-5 search-results-course-desktop-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <figure class="text-center search-results-course-desktop-image" style="background-image:url('<?= $thumb_url ?>')">
                                                
                                                <div class="sr-only"><img src="<?= $thumb_url ?>" alt=""></div>
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                            </article>