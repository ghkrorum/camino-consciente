<?php
$thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
?>
<div class="col-md-3 course">
    <a href="<?php esc_url( the_permalink() ); ?>" class="to-section" title="<?php the_title(); ?>">
        <aside>
            <figure class="image" style="background-image:url('<?= $thumb_url ?>'">
                <span class="title"><?= get_course_type_name( $course_data['type'] ) ?></span>
                <div class="description">
                    <p><?= get_field( 'course_excerpt' ); ?></p>
                </div>
                <div class="sr-only"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"></div>
            </figure>
            <div class="details">
                <h3><?php the_title(); ?></h3>
                <?php
                $instructors= get_posts(array(
                    'post_type'         => 'instructor',
                    'posts_per_page'    => 1,
                    'post__in'          => get_field('course_instructor', false, false),
                ));

                foreach ( $instructors as $instructor ) : ?>
                    <p><?= get_field( 'instructor_name', $instructor->ID ); ?> <?= get_field( 'instructor_last_name', $instructor->ID ); ?></p>
                <?php endforeach; ?>
                <span class="date">Fecha de Inicio: <?= get_course_starting_date( $course_data['starting_date'] );?></span>
            </div>
        </aside>
    </a>
</div><?php include( locate_template( 'template-parts/content-categories.php' ) ); ?>