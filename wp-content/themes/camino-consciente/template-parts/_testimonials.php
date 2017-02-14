<?php
if( have_rows('testimonials') ) :
?>
<!-- articles -->
<div class="testimoniales-articles" id="testimoniales">
    <div class="container text-center">
        <div class="row">
            <div class="title main-title">Testimoniales</div>
            <div class="tiny-slider">
                <a class="buttons icon icon-prev prev" href="#">&#60;</a>
                <div class="viewport">
                    <ul class="overview">

                        <?php 
                        while ( have_rows('testimonials') ) : the_row(); 
                            $imageObj = get_sub_field('testimonial_preview');
                            $url = get_sub_field('testimonial_video');
                            $image = kxn_get_acf_image_src($imageObj, 'large');
                        ?>
                            <!-- item -->
                            <li class="item">
                                <?php if ( $url ) : ?>
                                <a href="<?= $url; ?>" data-lity>
                                <?php endif; ?>
                                    <figure class="figure" style="background-image:url('<?= $image; ?>')">
                                        <div class="sr-only"><img src="<?= $image; ?>" class="img-responsive"></div>
                                        <?php if ( $url ) : ?>
                                        <i class="icon icon-play"></i>
                                        <?php endif; ?>
                                    </figure>
                                <?php if ( $url ) : ?>
                                </a>
                                <?php endif; ?>
                            </li>
                        <?php endwhile; ?>

                    </ul>
                </div>
                <a class="buttons icon icon-next next" href="#">&#62;</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.testimoniales-articles .tiny-slider').tinycarousel({ interval: true });
        Sliders.setTestimoniales();
        $(window).on("resize", function(){
            Sliders.setTestimoniales();
        });
    });
</script>
<?php endif; ?>
