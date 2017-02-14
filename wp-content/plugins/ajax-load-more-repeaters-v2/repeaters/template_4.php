<?php
$theCategory = get_the_category( $post->ID );
$catName = ($theCategory)?$theCategory[0]->cat_name:'';
if ( has_post_thumbnail() ) :
    $default_url = '';
    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'home-more-articles' );
    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; 
    $author = '';
    $authorArray = get_field('entry_author');
    if ($authorArray){
        $author = kxn_get_post_author($authorArray[0]);
    }
?>
<div class="col-md-4 article">
    <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
        <aside>
            <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
                <div class="sr-only"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"></div>
            </figure>
            <div class="details">
                <span class="title title-labeled"><?= $catName; ?></span>
                <h3><?php the_title(); ?></h3>
                <?php if ( $author ) : ?>
                <p class="author"><?= $author; ?></p>
                <?php endif; ?>
            </div>
        </aside>
    </a>
</div>
<?php endif; ?>