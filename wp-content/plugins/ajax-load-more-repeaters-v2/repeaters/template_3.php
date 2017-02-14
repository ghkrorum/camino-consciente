<?php
$thumb_url =  get_the_post_thumbnail_url( $post->ID,  'instructor-featured' );
                                $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
                                $instructor_data = get_instructor_data();
?>
<div class="result instructor alm-instructor">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php the_permalink(); ?>">
                    <figure style="background-image:url('<?= $thumb_url ?>')">
                        <div class="sr-only"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"></div>
                    </figure>
                </a>
            </div>
            <div class="col-md-6">
                <aside>
                    <h2><?= sprintf( '<a href="%s">%s %s</a>', get_the_permalink( $post->ID ), get_field( 'instructor_name' ), get_field( 'instructor_last_name' ) ); ?></h2>
                    <h3><?= get_field( 'instructor_profession' ) ?></h3>
                    <p><?= wp_rp_text_shorten( get_the_excerpt( $post->ID ), 600 ); ?></p>
                    <ul class="networks">
                        <?php the_instructor_instagram( $instructor_data['instagram'] ); ?>
                        <?php the_instructor_facebook( $instructor_data['facebook'] ); ?>
                        <?php the_instructor_twitter( $instructor_data['twitter'] ); ?>
                    </ul>
                </aside>
            </div>
            <div class="col-md-3">
                <ul class="instructor-info">
                    <?php the_instructor_phone( $instructor_data['phone'] ); ?>
                    <?php the_instructor_mobile( $instructor_data['mobile'] ); ?>
                    <?php the_instructor_email( $instructor_data['email1'], $instructor_data['email2'] ); ?>

                    <li><a href="<?= $instructor_data['gmaps_url'] ?>">
                            <i class="icon icon-map-marker"></i>
                            <?= get_location_from_object( $post ); ?>
                            <address>
                                <h4><?php the_instructor_address( $instructor_data['address'] ); ?></h4>
                            </address>
                        </a></li>
                </ul>
            </div>
        </div>
    </div>