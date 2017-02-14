<?php get_header(); ?>
<div id="wrapper" class="wrapper-interior">
    <div class="section" id="nota-blog-interior">
        <div class="container">
            <div class="row">
                <?php if ( have_posts() ) : ?>
                    <?php while( have_posts() ) : the_post(); ?>
                        <div class="text-center">
                            <h1 class="blog-nota-title"><?php the_title(); ?></h1>
                        </div>
                        <div class="wrapper-nota">

                            <div class="blog-nota col-md-8">
                                <?php the_content(); ?>
                            </div>

                    <?php endwhile; ?>

                <?php else: ?>
                    <?php // TODO: Include no content template ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
