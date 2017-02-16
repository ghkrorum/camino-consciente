<?php get_header(); ?>

<div id="wrapper" class="wrapper-interior">
    <div class="section" id="curso-section">
        <div class="container">
            <div class="row header">
                <?php if ( have_posts() ) :
                while( have_posts() ) : the_post();
                $course_data = get_course_data();
                $courseTitle = kxn_get_course_title($course_data);
                $courseType = kxn_get_course_type($course_data);
                $originalPrice = kxn_get_course_price($course_data);
                $localPrice = kxn_get_course_local_price($course_data);
                $courseId = get_field('course_id');
                $videoUrl = get_field('course_main_video');
                $videoImg = get_field('course_main_video_prev');
                $claseMuestra = get_field('clase_muestra');
                $btnLabel = "";
                $subscribeUrl = "";
                $aData = '';
                $priceTag = '<span class="precio mxn original-price">'.$originalPrice.'</span>';
                if ( $courseId ) { 
                    $btnLabel = 'INSCRIBIRME AHORA';
                    $subscribeUrl =  SUBSCRIBE_URL.$courseId;
                    if ( $course_data['is_free'] ){
                        $subscribeUrl = REDIRECT_URL.$courseId;
                        $aData = 'data-lity-custom';
                        $btnLabel = "Ver ahora gratis";
                    }

                    $priceTag = '<a href="'.$subscribeUrl.'" '.$aData.'>'.$priceTag.'</a>';
                }


                
                $default_url = '';
                $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
                $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                $venues_args = array(
                    'post_type'         => 'centros_de_ensenanza',
                    'posts_per_page'    => 1,
                );

                if( $course_data['type'] !== 'online' )
                    $venues_args['p'] = $course_data['venue'][0]->ID;

                $venues = get_posts( $venues_args );

                $instructors = get_posts(array(
                    'post_type'         => 'instructor',
                    'posts_per_page'    => 1,
                    'post__in'			=> get_field('course_instructor', false, false),
                ));

                $course_data[0]['gmaps_url'] = get_field( 'course_google_maps_url' );

                if( $venues ):
                    foreach ( $venues as $venue ) :
                        $course_data[0]['venue'] = array(
                            'name'      => $venue->post_title,
                            'address'   => get_field( 'venue_address', $venue->ID ),
                            'city'      => get_city_from_object( $venue->ID )->name,
                            'country'   => get_country_from_city( get_city_from_object( $venue->ID )->term_id )->name,
                            'location'  => get_location_from_object( $venue ),
                            'phone'     => get_field( 'venue_landline', $venue->ID ),
                            'mobile'    => get_field( 'venue_mobile_phone', $venue->ID ),
                            'mail'      => get_field( 'venue_email', $venue->ID ),
                            'website'   => get_field( 'venue_website', $venue->ID ),
                        );
                    endforeach;
                endif;

                $course_data[0]['insite_data'] = array(
                    'phone'     => get_field( 'course_insite_phone' ),
                    'address'   => get_field( 'course_insite_address' ),
                    'mail'      => get_field( 'course_insite_mail' ),
                    'website'   => get_field( 'course_insite_website' ),
                );

                if( $instructors ) :
                    foreach ( $instructors as $instructor) :
                        setup_postdata( $instructor );
                        $course_data[0]['instructor'] = array(
                            'name'          => get_field( 'instructor_name', $instructor->ID ),
                            'last_name'     => get_field( 'instructor_last_name', $instructor->ID ),
                            'profession'    => get_field( 'instructor_profession', $instructor->ID ),
                            'description'   => get_the_content(),
                            'address'       => get_field( 'instructor_address', $instructor->ID ),
                            'phone'         => get_field( 'instructor_phone', $instructor->ID ),
                            'mobile'        => get_field( 'instructor_mobile_phone	', $instructor->ID ),
                            'e-mail1'       => get_field( 'instructor_email_1', $instructor->ID ),
                            'e-mail2'       => get_field( 'instructor_email_2', $instructor->ID ),
                            'instagram'     => get_field( 'instructor_instagram', $instructor->ID ),
                            'facebook'      => get_field( 'instructor_facebook', $instructor->ID ),
                            'twitter'       => get_field( 'instructor_twitter', $instructor->ID ),
                            'picture'       => get_the_post_thumbnail_url( $instructor->ID,  'instructor-featured' ),
                        );
                    endforeach;
                endif; ?>
                <div class="nota-blog-head" data-course-id="<?= $courseId; ?>">
                    <div class="banner-top" style="background-image: url('<?= $thumb_url ?>');">
                        <div class="title-cont">
                            <span class="title course-type-<?= $courseType; ?>"><?= get_course_type_name( $courseType ) ?></span>
                        </div>
                        <h1 class="blog-nota-title"><?= $courseTitle; ?></h1>
                        <div class="wrapper-nota-blog wrapper-nota-blog-desktop button-header">
                            <?php if ($videoUrl): ?>
                            <div class="btn-vid-cont text-center">
                                <a class="btn-video" href="<?= $videoUrl; ?>" data-lity>
                                    <span class="icon-cont"><i class="icon icon-play"></i></span><span>Ver video</span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?= $priceTag; ?>
                            
                            <p class="precio mxn local-price"></p>
                            
                            <?php if ($subscribeUrl) : ?>
                            <a href="<?= $subscribeUrl; ?>" target="_blank" <?= $aData; ?>><span class="title"><?= $btnLabel; ?></span></a>
                            <?php endif; ?>
                            
                        </div>
                        <div class="partial-section">
                            <?php get_template_part( 'template-parts/share' ); ?>
                        </div>
                    </div>
                    <?php if ( $course_data['benefits'] ) : ?>
                    <ul class="course-targets">
                        <?php foreach ( $course_data['benefits'] as $benefit ) : ?>
                        <li>
                            <span class="bullet"><span><i class="glyphicon glyphicon-check"></i></span></span><p class="txt"><?= $benefit['course_benefit_caption']; ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <div class="wrapper-nota-blog wrapper-nota-blog-mobile">
                        <span class="title course-type-<?= $courseType; ?>"><?= get_course_type_name( $courseType ) ?></span>
                        <h1 class="blog-nota-title"><?= $courseTitle; ?></h1>
                        <p class="blog-nota-des"><?= get_field( 'course_excerpt' ); ?></p>
                        <?= $priceTag; ?>
                        
                        <span class="precio mxn local-price"></span>
                        
                        <?php if ($courseId) : 
                                $btnLabel = 'INSCRIBIRME EN EL CURSO';
                                $subscribeUrl =  SUBSCRIBE_URL.$courseId;
                                $aData = '';
                                if ( $course_data['is_free'] ){
                                    $subscribeUrl = REDIRECT_URL.$courseId;
                                    $aData = 'data-lity-custom';
                                    $btnLabel = "Ver ahora gratis";
                                }
                            ?>
                        <a href="<?= $subscribeUrl; ?>" target="_blank" <?= $aData; ?>><span class="title subscribe" <?= $aData; ?> ><?= $btnLabel; ?></span></a>
                        <?php endif; ?>
                        <div class="social-icons">
                            <a href="#/" onclick="socialshare('twitter', '<?php echo get_the_permalink(); ?>', '<?= $courseTitle;?>');"><span class="icon icon-tw-bird"></span></span></a>
                            <a href="#/" onclick="socialshare('facebook', '<?php echo get_the_permalink(); ?>', '<?= $courseTitle; ?>');"><span class="icon icon-fb"></span></span></a>
                            <a href="mailto:?subject=<?= $courseTitle; ?>&amp;body=<?php the_permalink() ?>"><span class="icon icon-mail"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"> 
                <div class="partial-section">
                    <div class="tab-wrapper">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#generales" aria-controls="generales" role="tab" data-toggle="tab">GENERALES</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-instructor" aria-controls="instructor" role="tab" data-toggle="tab">INSTRUCTOR</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-temario" aria-controls="temario" role="tab" data-toggle="tab">TEMARIO</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="generales">
                                <div class="tab-temario-wrap ">
                                    <div class="col-md-6">
                                        <div class="content-body">
                                            <img class="donation" src="<?= THEME_DIR ?>/img/donation.png" alt="">
                                            <?php setup_postdata( $post ); ?>
                                            <?php the_content(); ?>
                                        </div>
                                        <div class="row course-cont-bottom">
                                            <div class="col-md-4">
                                                <div class="the-bullet">
                                                    <span class="icon-cont"><i class="icon icon-calendar"></i></span> <p><?= get_course_starting_date( $course_data['starting_date'] );?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="the-bullet">
                                                    <span class="icon-cont"><i class="icon icon-clock"></i></span> <p><?= $course_data['length'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="imagen-description col-md-6">
                                        <div class="wrapper-border">
                                            <?php
                                            if ($videoUrl && $videoImg):
                                                $thumb = kxn_get_acf_image_src($videoImg, 'video-thumb-560x360');
                                            ?>
                                            <a href="<?= $videoUrl; ?>" data-lity>
                                            <div class="video-testimonial button-video" >
                                                <div class="row">
                                                    <div class="col-md-12 col-md-offset-0 col-xs-12">
                                                        <img src="<?= $thumb; ?>" >
                                                    </div>
                                                </div>
                                                <div class="btn-vid-cont text-center">
                                                    <div class="icon-video btn-video">
                                                        <span class="icon-cont">
                                                        <i class="icon icon-play"></i>
                                                        </span>
                                                        <span class="title-video">Ver video</span>
                                                    </div>
                                                </div>
                                            </div>
                                            </a>
                                            <?php 
                                            endif;
                                            ?>
                                            <div class="row">
                                                <div class="col-md-12 col-md-offset-0 col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="favs-container">
                                                                <?php
                                                                if(function_exists('the_ratings')) { the_ratings(); } 
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="partial-section"><?php get_template_part( 'template-parts/share' ); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab-instructor">
                                <div class="tab-temario-wrap ">
                                    <div class="col-md-6">
                                        <a href="<?= get_permalink( $instructors[0]->ID ) ?>">
                                            <figure style="background-image: url(<?= $course_data[0]['instructor']['picture'] ?>);">
                                                <div class="sr-only"><img src="<?= $course_data[0]['instructor']['picture'] ?>" alt=""></div>
                                                <?
                                                $instructorVideo = get_field('instructor_video_url', $instructors[0]->ID);
                                                if ( $instructorVideo ) : 
                                                ?>
                                                <div class="btn-vid-cont text-center">
                                                    <a class="btn-video" href="<?= $instructorVideo; ?>" data-lity="">
                                                        <span class="icon-cont"><i class="icon icon-play"></i></span><span>Ver video</span>
                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                            </figure>
                                        </a>
                                        <div class="title-container">
                                            <h1><?= sprintf('%s %s', $course_data[0]['instructor']['name'], $course_data[0]['instructor']['last_name']); ?></h1>
                                            <h3><?= $course_data[0]['instructor']['profession'] ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <aside class="content-body">
                                            <h1><a href="<?= get_permalink( $instructors[0]->ID )?>" title="<?php the_title(); ?>"><?= kxn_get_instructor_name( $instructors[0] );?></a></h1>
                                            <h3><?= $course_data[0]['instructor']['profession'] ?></h3>
                                            <?= $course_data[0]['instructor']['description']; ?>
                                        </aside>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab-temario">
                                <div class="tab-temario-wrap ">
                                    <div class="col-md-12">
                                        <?php
                                        $temarioTxt =  get_field( 'course_online_syllabus', $post->ID );
                                        if ( have_rows('course_agenda') ) : 
                                        ?>
                                            <ul>
                                        <?php
                                            for ( $i=0 ; have_rows('course_agenda') ; $i++ ): 
                                                the_row();
                                                $rowClasses =  array();
                                                $agendaItemTitle = get_sub_field('agenda_item_title');
                                                $agendaItemIsChapter = get_sub_field('agenda_item_is_chapter');
                                                $agendaItemFreeClass = get_sub_field('agenda_item_free_class');
                                                $rowClasses[] = ($agendaItemIsChapter)?'is-chapter':'';


                                        ?>
                                            <li class="<?= implode(' ', $rowClasses);?>">
                                                <?= $agendaItemTitle; ?> 
                                                <?php if ($agendaItemFreeClass) : ?>
                                                
                                                <div class="agenda-item-video">
                                                    <a href="<?= $agendaItemFreeClass; ?>" class="agenda-item-video-btn" data-lity>Toma esta clase gratis<span></span></a>
                                                </div>
                                                <?php endif; ?>
                                            </li>
                                        <?php endfor; ?>
                                            </ul>
                                        <?php 
                                        else:
                                            echo $temarioTxt;
                                        endif; ?>

                                        <?php if (!empty($claseMuestra)) : ?>
                                        <a href="<?= $claseMuestra; ?>" class="title" data-lity>Ver curso</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END TABS -->

                        <?php if( $course_data['type'] == 'insite' ) : ?>
                            <div class="col-md-12 inscripcion">
                                <div class="center-inscribete">
                                    <h1><i>PARA INSCRIBIRTE EN EL CURSO, CONTÁCTANOS</i></h1>

                                    <div class="col-md-3 inscribete inscribete-1">
                                        <span class="icon-inscribete"><i class="ion ion-ios-telephone"></i></span>
                                        <span><?= $course_data[0]['insite_data']['phone'] ?></span>
                                    </div>
                                    <div class="inscribete-line"></div>
                                    <div class="col-md-3 inscribete inscribete-2">
                                        <a href="<?= $course_data[0]['gmaps_url']  ?>" target="_blank"><span class="icon-inscribete"><i class="ion ion-ios-location"></i></span></a>
                                        <span><?= $course_data[0]['insite_data']['address'] ?></span>
                                    </div>
                                    <div class="inscribete-line"></div>
                                    <div class="col-md-3 inscribete inscribete-3">
                                        <span class="icon-inscribete"><i class="ion ion-email"></i></span>
                                        <span><?= $course_data[0]['insite_data']['mail'] ?></span>
                                    </div>
                                    <div class="inscribete-line"></div>
                                    <div class="col-md-3 inscribete inscribete-4">
                                        <span class="icon-inscribete"><i class="ion ion-earth"></i></span>
                                        <span><?= $course_data[0]['insite_data']['website'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <?php if ( $courseId ) : ?>
                            <div class="col-md-12 inscripcion inscripcion-online">
                                <div class="center-inscribete">
                                    <h1 class="online-course-heading">¡Inscribirme ahora!</h1>
                                    <a href="<?= SUBSCRIBE_URL.$courseId; ?>" target="_blank"><p class="online-course-price-tag original-price"><?= $originalPrice; ?></p></a>
                                    <p class="local-price-tag local-price"></p>
                                    <div class="inscribete-online-option">
                                        <div class="inscribete-online-option-inner">
                                            <img src="<?= THEME_DIR ?>/img/guarantee.png" alt="" class="online-option">
                                            <p class="online-option-desc">Si no te gusta el curso <b>Te regresamos tu dinero</b> en máximo 48 hrs.</p>
                                        </div>
                                    </div>
                                    <div class="inscribete-online-option">
                                        <div class="inscribete-online-option-inner">
                                            <img src="<?= THEME_DIR ?>/img/safe.png" alt="" class="online-option">
                                            <p class="online-option-desc">Ten la confianza <b>de comprar con nosotros</b>.</p>
                                        </div>
                                    </div>
                                    <div class="inscribete-online-option">
                                        <div class="inscribete-online-option-inner">
                                            <img src="<?= THEME_DIR ?>/img/cards.png" alt="" class="online-option">
                                            <p class="online-option-desc">Aceptamos tarjetas de <b>Crédito y Débito</b>.</p>
                                        </div>
                                    </div>
                                    <div class="inscribete-online-option">
                                        <div class="inscribete-online-option-inner">
                                            <img src="<?= THEME_DIR ?>/img/oxxo.png" alt="" class="online-option">
                                            <p class="online-option-desc">Paga en <b>Efectivo, Depósito, Transferencia y cuenta Mercadopago</b>.</p>
                                        </div>
                                    </div>
                                    <div class="inscribete-online-option">
                                        <div class="inscribete-online-option-inner">
                                            <img src="<?= THEME_DIR ?>/img/msi.png" alt="" class="online-option">
                                            <p class="online-option-desc">Aprovecha las <b>Promociones de Tarjetas Participantes</b>.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <script>
                            $(document).ready(function() {
                                $('.to-theme').on("click", function(event){
                                    event.preventDefault();
                                    $('.to-theme').not(this).removeClass("active");
                                    $(this).addClass("active");
                                    var _theme = $(this).data("target");
                                    $('.theme').not(_theme).removeClass('active');
                                    $(_theme).addClass('active');
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="partial-section"><?php get_template_part( 'template-parts/testimonials' ); ?></div>
            <div class="container">
                <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="1280" data-numposts="1"></div>
            </div>
            <div class="partial-section"><?php get_template_part( 'template-parts/featured-courses' ); ?></div>

            <?php 
            $authorId = $instructor->ID;
            require('template-parts/author-related-posts.php');
            ?>

            <?php /*
            <div class="text-center">
                <h3 class="title main-title">Artículos relacionados</h3>
            </div>
            <div class="partial-section" data-url="partials/more-articles.html"></div>
            */ ?>
            <?php endwhile; ?>

            <?php else: ?>
                <?php // TODO: Include no content template ?>
            <?php endif; ?>
        </div>
</div>
<div class="login-frame-cont">
    <div id="redirect-frame-cont" class="login-frame">
        <iframe id="redirect-frame" scrolling="no" src="" width="320" height="auto"></iframe>
    </div>
</div>

<?php get_footer(); ?>
