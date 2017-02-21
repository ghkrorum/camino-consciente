<?php 
$default_url = '';
$thumb_url =  get_the_post_thumbnail_url( $post->ID );
$thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
?>
<div class="col-md-4 article">
    <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
        <article>
            <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                <div class="sr-only"><img src="<?= $thumb_url ?>" alt="UNA GUÍA PARA LA AUTOOBSERVACIÓN CONSCIENTE"></div>
            </figure>
            <div class="details">
                <span class="title title-labeled"><?= get_the_category()[0]->name ?></span>
                <h3><?php the_title(); ?></h3>
                <p><?= wp_rp_text_shorten( get_the_excerpt( $post->ID ), 140 ); ?></p>
            </div>
        </article>
    </a>
</div>