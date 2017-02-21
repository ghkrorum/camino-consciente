<?php
$default_url = '';
$thumb_url =  get_the_post_thumbnail_url( $post->ID,  'home-more-articles' );
$thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; 
?>
<div class="col-md-4 article">
    <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
        <aside>
            <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                <div class="sr-only"><img src="<?= $thumb_url ?>" alt="La vejez ¿Carga o liberación?"></div>
            </figure>
            <div class="details">
                <span class="title title-labeled"><?= get_the_category( $post->ID )[0]->cat_name ?></span>
                <h3><?php the_title(); ?></h3>
                <p><?= get_field( 'course_excerpt' ); ?></p>
            </div>
        </aside>
    </a>
</div>