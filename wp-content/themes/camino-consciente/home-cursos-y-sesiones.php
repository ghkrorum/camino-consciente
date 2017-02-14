<?php
/**
 * Template Name: Cursos y sesiones personales home
 *
 * @package WordPress
 * @subpackage camino_consciente
 * @since Camino Consciente 1.0
 */

get_header(); ?>

<div id="wrapper">
    <div class="section" id="cursos-y-sesiones-personales-section">
        <div class="container">
            <div class="row header">
                <div class="col-md-9 filter">
                    <div class="row white-gradient">
                        <div class="col-md-12">
                            <h1>Elige el tema que más te guste <br>y revisa los temas que tenemos para tí</h1>
                        </div>
                        <div class="col-md-11">
                            <form action="#" class="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="selectable">
                                            <select name="theme" id="" data-placeholder="Tema">
                                                <option value="Tema 1">Tema 1</option>
                                                <option value="Tema 2">Tema 2</option>
                                                <option value="Tema 3">Tema 3</option>
                                                <option value="Tema 4">Tema 4</option>
                                                <option value="Tema 5">Tema 5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="selectable">
                                            <?php generate_country_dropdown(); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="selectable">
                                            <?php generate_cities_dropdown(); ?>
                                        </div>
                                        <input class="submit-selectable" type="submit" value="Buscar">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="selectable">
                                            <?php generate_instructors_dropdown(); ?>
                                        </div>
                                        <input class="submit-selectable" type="submit" value="Buscar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="partial-section">
                        <div class="calendar">
                            <div class="header">
                                <h2>Calendario</h2>
                            </div>
                            <div class="body">
                                <div class="tiny-slider" id="calendar-slider">
                                    <a class="buttons prev" href="#">&#60;</a>
                                    <div class="viewport">
                                        <ul class="overview">
                                            <li class="month">
                                                <h2>Enero 2016</h2>
                                                <ul class="event">
                                                    <li>
                                                        <a href="http://google.com" target="_blank">
                                                            <h3>Madrid, España</h3>
                                                            <p>Lorem ipsum dolor sit amet,...</p>
                                                            <span class="mode">En línea</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="http://google.com" target="_blank">
                                                            <h3>Madrid, España</h3>
                                                            <p>Lorem ipsum dolor sit amet,...</p>
                                                            <span class="mode">En línea</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="http://google.com" target="_blank">
                                                            <h3>Madrid, España</h3>
                                                            <p>Lorem ipsum dolor sit amet,...</p>
                                                            <span class="mode">En línea</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="http://google.com" target="_blank">
                                                            <h3>Madrid, España</h3>
                                                            <p>Lorem ipsum dolor sit amet,...</p>
                                                            <span class="mode">En línea</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="http://google.com" target="_blank">
                                                            <h3>Madrid, España</h3>
                                                            <p>Lorem ipsum dolor sit amet,...</p>
                                                            <span class="mode">En línea</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="http://google.com" target="_blank">
                                                            <h3>Madrid, España</h3>
                                                            <p>Lorem ipsum dolor sit amet,...</p>
                                                            <span class="mode">En línea</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="http://google.com" target="_blank">
                                                            <h3>Madrid, España</h3>
                                                            <p>Lorem ipsum dolor sit amet,...</p>
                                                            <span class="mode">En línea</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="month">
                                                <h2>Febrero 2016</h2>
                                                <ul class="event">
                                                    <li>
                                                        <a href="http://google.com" target="_blank">
                                                            <h3>Madrid, España</h3>
                                                            <p>Lorem ipsum dolor sit amet,...</p>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="buttons next" href="#">&#62;</a>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#calendar-slider").tinycarousel();
                                Sliders.setCalendar();
                                $(window).on("resize", function(){
                                    Sliders.setCalendar();
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="partial-section"><?php get_template_part( 'template-parts/featured-courses' ); ?></div>
        <div class="partial-section"><?php get_template_part( 'template-parts/featured-venues' ); ?></div>
        <div class="partial-section"><?php get_template_part( 'template-parts/featured-instructors' ); ?></div>
        <div class="partial-section"><?php get_template_part( 'template-parts/our-services' ); ?></div>
    </div>
    <script>
        $(document).ready(function() {
            $('#cursos-y-sesiones-personales-section .selectable').each(function(index, el) {
                var _placeholder = $(this).find("select").data("placeholder");
                $(el).selectable({placeholder:_placeholder});
            });
        });
    </script>
</div>

<?php get_footer(); ?>
