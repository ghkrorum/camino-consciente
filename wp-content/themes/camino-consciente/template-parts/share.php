<div class="compartir">
    <span>COMPARTE:</span>
    <a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink() ?>" title="Compartir con mail">
        <img src="<?= THEME_DIR ?>/img/views/share/ma.png" alt="comparte">
    </a>
    <a href="#/" onclick="return socialshare('facebook', '<?php echo get_the_permalink(); ?>', '<?php the_title(); ?>');" target="_blank" title="Compartir por facebook">
        <img src="<?= THEME_DIR ?>/img/views/share/fb.png" alt="comparte">
    </a>
    <a href="#/" onclick="return socialshare('twitter', '<?php echo get_the_permalink(); ?>', '<?php echo get_the_title();?>');" title="Compartir por twitter" target="_blank">
        <img src="<?= THEME_DIR ?>/img/views/share/tw.png" alt="comparte">
    </a>
    <?php if( wp_is_mobile() ): ?>
    <a href="whatsapp://send?text=<?php the_title(); ?>" data-action="share/whatsapp/share" title="Compartir por whatsapp">
        <img src="<?= THEME_DIR ?>/img/views/share/wa.png" alt="comparte">
    </a>
    <?php endif; ?>
</div>
