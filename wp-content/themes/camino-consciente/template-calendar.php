<?php
/*
Template Name: Custom Calendar
*/
get_header(); 
the_post();

$category = ( isset($_GET['categories']) )?$_GET['categories']:'';
$country = ( isset($_GET['country']) )?$_GET['country']:'';
$city = ( isset($_GET['city']) )?$_GET['city']:'';
$timestamp = ( isset($_GET['date']) && !empty($_GET['date']) )?strtotime($_GET['date']):time();
$month = date('n', $timestamp);
$year = date('Y', $timestamp);

$nextMonthTime = strtotime('+1 month', $timestamp);

$nextMonth = date('n', $nextMonthTime);
$bextYear = date('Y', $nextMonthTime);

?>
<div id="wrapper" class="wrapper-interior">
    <div class="section" id="template-calendar">
        <div class="container">
        	
        	<div class="row header row-search-form">
				<div class="col-md-12 filter">
				    <div class="row white-gradient">
				        <div class="col-md-12">
				            <h1>Encuentra tu curso.</h1>
				        </div>
				        <div class="col-md-12">
				            <div class="row search-form">
				            	<form id="calendar-form" role="search" method="get">
					                <div class="col-md-6">
					                    <div class="form-wrap">
					                        
				                            <div class="form-wrap">
				                                <div class="selectable">
				                                    <?php generate_categories_dropdown(); ?>
				                                </div>

				                                <div class="selectable">
				                                    <?php generate_country_dropdown(); ?>
				                                </div>
				                            </div>

					                    </div>
					                </div>

									<div class="col-md-6">
					                    <div class="form-wrap">

				                            <div class="form-wrap">

	        									<div class="selectable">
				                                    <?php generate_cities_dropdown(); ?>
				                                </div>
				                            	
				                            	<input type="text" id="date-picker" name="date-picker" placeholder="Fecha" >
				                            	<input type="hidden" id="cal-date" name="date" placeholder="Fecha" >

				                            	<input class="submit-selectable" type="submit" value="Buscar">
				                                
				                            </div>
					                    </div>
					                </div>
								</form>
				            </div>
				        </div>
				    </div>
				</div>
			</div>
			<div id="the-cal-cont">
        	<?php printCalendar($month, $year, 'sun', $category, $country, $city); ?>
			</div>
			<?php if ( !isset($_GET['date']) || empty($_GET['date']) ): ?>
        	<div class="alm-btn-wrap"><button id="cal-load-more" class="alm-load-more-btn more" data-next-month="<?= $nextMonth; ?>" data-next-year="<?= $bextYear; ?>" data-category="<?= $category; ?>" data-country="<?= $country; ?>" data-city="<?= $city; ?>">Ver más</button></div>
        	<?php endif; ?>

        	<?php
        	$twoDigitMonth = str_pad($month, 2, "0", STR_PAD_LEFT);
        	$date = date('Ymt');
        	
        	$nextCourses = get_posts(array(
	            'numberposts' => 4,
	            'post_type' => 'cursos',
	            'post_status' => 'publish',
	            'meta_query' => array(
	                array(
	                    'key' => 'course_starting_date',
	                    'value' => $date,
	                    'compare' => '>='
	                )
	            )
	        ));


	        if ( $nextCourses ) :
        	?>

        	<div class="partial-section cal-next-courses">
	            <div class="featured-courses">
	                <h3 class="title main-title">Próximos Cursos</h3>
	                <div class="container-fluid">
	                    <div class="row">
	                        <?php
	                            foreach ( $nextCourses as $post ) :
	                                setup_postdata($post);
	                                $course_data = get_course_data();
	                                $courseTitle = kxn_get_course_title($course_data);
	                                $courseType = kxn_get_course_type($course_data);
	                                if ( has_post_thumbnail() ) :
	                                    $default_url = '';
	                                    $thumb_url =  get_the_post_thumbnail_url( $post->ID,  'featured-courses' );
	                                    $thumb_url = ( $thumb_url !== '' ) ? $thumb_url  : $default_url; ?>
	                                    <?php /* AGREGAR LA CLASE free-course para el tag de cursos gratis */ ?>
	                                    <div class="col-md-3 course">
	                                        <a href="<?php the_permalink(); ?>" class="to-section" title="<?php the_title(); ?>">
	                                            <aside>
	                                                <figure class="image" style="background-image:url('<?= $thumb_url ?>')">
	                                                    <span class="title course-type-<?= $courseType; ?>"><?= get_course_type_name( $courseType ) ?></span>
	                                                    <div class="description">
	                                                        <p><?= wp_rp_text_shorten( get_the_excerpt( $post->ID ), 180 ); ?></p>
	                                                    </div>
	                                                </figure>
	                                                <div class="details">
	                                                    <h3><?= $courseTitle; ?></h3>
	                                                    <?php
	                                                    $instructors= get_posts(array(
	                                                        'post_type'         => 'instructor',
	                                                        'posts_per_page'    => 1,
	                                                        'post__in'			=> get_field('course_instructor', false, false),
	                                                    ));

	                                                    foreach ( $instructors as $instructor ) :
	                                                        ?>
	                                                        <p><?= get_field( 'instructor_name', $instructor->ID ); ?> <?= get_field( 'instructor_last_name', $instructor->ID ); ?></p>
	                                                    <?php endforeach; ?>
	                                                    <span class="date">Fecha de Inicio: <?= get_course_starting_date( $course_data['starting_date'] );?></span>
	                                                </div>
	                                            </aside>
	                                        </a>
	                                    </div>
	                                <?php endif; ?>
	                                <?php
	                            endforeach;
	                        ?>
	                    </div>
	                    <a href="<?= get_site_url() ?>/cursos/" class="btn btn-default all-courses-link to-section" title="Ver todos los cursos">Ver todos los cursos</a>
	                </div>
	            </div>
	        </div>
    	<?php endif; ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.selectable').each(function(index, el) {
            var _placeholder = $(this).find("select").data("placeholder");
            $(el).selectable({placeholder:_placeholder});
        });
    });
</script>
<?php 
get_footer(); 
?>