<?php
$default_url = '';
$thumb_url =  get_the_post_thumbnail_url( $post->ID );
$thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url;
$author = '';
$authorArray = get_field('entry_author');
if ($authorArray){
    $author = kxn_get_post_author($authorArray[0]);
} 
$category = kxn_get_single_cat_title();
?>
<div class="col-md-4 article post-<?= $post->ID?>">
    <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
        <article>
            <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                <div class="sr-only"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"></div>
            </figure>
            <div class="details">
                <span class="title title-labeled"><?= $category; ?></span>
                <h3><?php the_title(); ?></h3>
                <?php if ($author) : ?>
                <p class="author"><?= $author; ?></p>
                <?php endif; ?>
            </div>
        </article>
    </a>
</div>