<?php
$course_data = get_course_data();
$testimonials = $course_data['testimonials'];
$filteredTestimonials = array_filter( $testimonials );
if( !empty( $filteredTestimonials ) ): ?>
<!-- articles -->
<div class="testimoniales-articles" id="testimoniales">
    <div class="container text-center">
        <div class="row">
            <div class="title main-title">Testimoniales</div>
            <div class="tiny-slider">
                <a class="buttons icon icon-prev prev" href="#">&#60;</a>
                <div class="viewport">
                    <ul class="overview">

                        <?php if( $testimonials['video_testimonial_1'] && $testimonials['video_thumb_testimonial_1'] ): ?>
                            <!-- item -->
                            <li class="item">
                                <a href="<?= $testimonials['video_testimonial_1'] ?>" data-lity>
                                    <figure class="figure" style="background-image:url('<?= $testimonials['video_thumb_testimonial_1'] ?>')">
                                        <div class="sr-only"><img src="<?= $testimonials['video_thumb_testimonial_1'] ?>" class="img-responsive"></div>
                                        <i class="icon icon-play"></i>
                                    </figure>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if( $testimonials['video_testimonial_2'] && $testimonials['video_thumb_testimonial_2'] ): ?>
                            <!-- item -->
                            <li class="item">
                                <a href="<?= $testimonials['video_testimonial_2'] ?>" data-lity>
                                    <figure class="figure" style="background-image:url('<?= $testimonials['video_thumb_testimonial_2'] ?>')">
                                        <div class="sr-only"><img src="<?= $testimonials['video_thumb_testimonial_2'] ?>" class="img-responsive"></div>
                                        <i class="icon icon-play"></i>
                                    </figure>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if( $testimonials['video_testimonial_3'] && $testimonials['video_thumb_testimonial_3'] ): ?>
                            <!-- item -->
                            <li class="item">
                                <a href="<?= $testimonials['video_testimonial_3'] ?>" data-lity>
                                    <figure class="figure" style="background-image:url('<?= $testimonials['video_thumb_testimonial_3'] ?>')">
                                        <div class="sr-only"><img src="<?= $testimonials['video_thumb_testimonial_3'] ?>" class="img-responsive"></div>
                                        <i class="icon icon-play"></i>
                                    </figure>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if( $testimonials['quote_testimonial_1'] ): ?>
                            <!-- item -->
                            <li class="item">
                                <figure class="figure" style="background-image:url('<?= $testimonials['quote_testimonial_1'] ?>')">
                                    <div class="sr-only"><img src="<?= $testimonials['quote_testimonial_1'] ?>" class="img-responsive"></div>
                                </figure>
                            </li>
                        <?php endif; ?>

                        <?php if( $testimonials['quote_testimonial_2'] ): ?>
                            <!-- item -->
                            <li class="item">
                                <figure class="figure" style="background-image:url('<?= $testimonials['quote_testimonial_2'] ?>')">
                                    <div class="sr-only"><img src="<?= $testimonials['quote_testimonial_2'] ?>" class="img-responsive"></div>
                                </figure>
                            </li>
                        <?php endif; ?>

                        <?php if( $testimonials['quote_testimonial_3'] ): ?>
                            <!-- item -->
                            <li class="item">
                                <figure class="figure" style="background-image:url('<?= $testimonials['quote_testimonial_3'] ?>')">
                                    <div class="sr-only"><img src="<?= $testimonials['quote_testimonial_3'] ?>" class="img-responsive"></div>
                                </figure>
                            </li>
                        <?php endif; ?>

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
