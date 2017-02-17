<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head elements.
 *
 * @package WordPress
 * @subpackage camino_consciente
 * @since Camino Consciente 1.0
 */

$section = '';
$request = $_SERVER[REQUEST_URI];
$parts = explode('/', $request);
if ($parts){
    $section = $parts[2]; // set index to 1 in production environment
}
$theCategory = get_the_category();
$categorySlug = ($theCategory) ? $theCategory[0]->slug : '';
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="widthnpm=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="57x57" href="<?= THEME_DIR ?>/img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= THEME_DIR ?>/img/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= THEME_DIR ?>/img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= THEME_DIR ?>/img/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= THEME_DIR ?>/img/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= THEME_DIR ?>/img/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= THEME_DIR ?>/img/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= THEME_DIR ?>/img/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= THEME_DIR ?>/img/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="<?= THEME_DIR ?>/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= THEME_DIR ?>/img/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?= THEME_DIR ?>/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?= THEME_DIR ?>/img/favicons/manifest.json">
    <link rel="mask-icon" href="<?= THEME_DIR ?>/img/favicons/safari-pinned-tab.svg" color="#e46510">
    <meta name="msapplication-TileColor" content="#e46510">
    <meta name="msapplication-TileImage" content="<?= THEME_DIR ?>/img/favicons/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    
    <?php wp_head(); ?>
</head>
<body>
<div class="body-wrap">
<div class="header-cont">
<header class="section-header header-screen">
    <div class="content-center">
        <div class="content-header">
            <nav id="user-actions" class="menu">
                <ul class="list-inline">
                    <li class="the-search-button"><a href="#" class="btn btn-icon the-search-button" title="Buscar"><span class="icon icon-search"></span></a>
                        <ul class="the-search-form">
                            <li>
                                <form id="desktop-search-form" role="search" action="<?= get_site_url() ?>" method="get">
                                    <input type="text" name="s">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li><a href="<?= get_site_url() ?>/nuestra-filosofia/" class="btn btn-default" title="Nuestra filosofía">Nuestra filosofía</a></li>
                    <li><a href="<?php the_permalink(PAGE_COLABORA); ?>" class="btn btn-orange" title="Colabora con Nosotros">Colabora con Nosotros</a></li>
                    <li><a href="#login-frame" class="btn btn-blue" title="Iniciar Sesión" data-lity>Ingresar</a></li>
                    <li><a href="https://twitter.com/camino_online" target="_blank" class="btn btn-icon" title="Twitter"><span class="icon icon-tw"></span></a></li>
                    <li><a href="https://www.facebook.com/vivecaminoconsciente/" target="_blank" class="btn btn-icon" title="Facebook"><span class="icon icon-fb"></span></a></li>
                </ul>
            </nav>
            <nav id="main-menu" class="menu">
                <div class="content-image">
                    <a class="to-section" href="<?= get_site_url(); ?>" title="Home"><img src="<?= THEME_DIR ?>/img/logo-camino-conciente.jpg" alt="Camino Consciente"></a>
                </div>
                <div class="colum-right">
                    <ul class="submenu-container first-menu">
                        <li><a href="<?= get_site_url() ?>/cursos/" class="to-section <?= ($section == 'cursos')?'active':''; ?>" title="Cursos">Cursos</a></li>
                        <li class="two"><a href="<?= get_site_url() ?>/calendario/" class="to-section <?= ($section == 'calendario')?'active':''; ?>" title="Calendario">Calendario</a></li>
                        <li><a href="<?= get_site_url() ?>/centros-de-ensenanza/" class="to-section <?= ($section == 'centros-de-ensenanza')?'active':''; ?>" title="Centros de Enseñanza">Centros</a></li>
                        <li class="two"><a href="<?= get_site_url() ?>/instructores/" class="to-section <?= ($section == 'instructores')?'active':''; ?>" title="Instructores">Instructores</a></li>
                        
                        
                    </ul>
                    <ul class="content-second">
                        <li>
                            <ul class="second-menu">
                            <li class="<?php if( $categorySlug == 'salud-corporal' ) echo 'category-active'; ?>" ><a class="to-section" href="<?= get_site_url() ?>/category/salud-corporal/" title="Salud Corporal">Salud Corporal</a></li>
                            <li class="<?php if( $categorySlug == 'relaciones-humanas' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/relaciones-humanas/" title="Relaciones Humanas">Relaciones Humanas</a></li>
                            <li class="<?php if( $categorySlug == 'nutricion-consciente' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/nutricion-consciente/" title="Nutrición Consciente">Nutrición Consciente</a></li>
                            </ul>
                        </li>
                        <li><ul class="second-menu">
                             <li class="<?php if( $categorySlug == 'mente-y-emociones' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/mente-y-emociones/" title="Mente y Emociones">Mente y Emociones</a></li>
                            <li class="<?php if( $categorySlug == 'sentido-de-vida' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/sentido-de-vida/" title="Sentido de Vida">Sentido de Vida</a></li>
                            <li class="<?php if( $categorySlug == 'abundancia' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/abundancia/" title="Abundancia">Abundancia</a></li>
                        </ul></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>    
</header>

<div ></div>

<header id="main-header" class="header header-movil">
    <a href="#" id="burger-icon">
        <i class="ion-navicon-round" aria-hidden="true"></i>
    </a>
    <nav id="main-menu" class="menu">
        <ul>
            <li class="top-logo">
                <div class="top-logo-wrap">
                    <a class="to-section" href="<?= get_site_url(); ?>" title="Home">
                        <img class="big" src="<?= THEME_DIR ?>/img/camino-conciente-logo.png" alt="Camino Consciente">
                        
                        <img class="small" src="<?= THEME_DIR ?>/img/logo-camino-conciente_small.png" alt="Camino Consciente">
                    </a>
                </div>
            </li>

            <?php /*<li><a class="to-section" href="tienda.html" title="Tienda">Tienda</a></li> */ ?>
            <li class="menu-sections">
                <a class="<?php if( is_category() ) echo 'to-section category-disabled'; else echo 'to-section'; ?> js-submenu-holder" href="<?= get_site_url() ?>/cursos-y-sesiones-personales/" title="Cursos y Sesiones Personales">Instructores y Cursos</a>
                <ul class="submenu-container">
                    <li><a href="<?= get_site_url() ?>/cursos/" class="to-section <?= ($section == 'cursos')?'active':''; ?>" title="Cursos">Cursos</a></li>
                    <li><a href="<?= get_site_url() ?>/instructores/" class="to-section <?= ($section == 'instructores')?'active':''; ?>" title="Instructores">Instructores</a></li>
                    <li><a href="<?= get_site_url() ?>/centros-de-ensenanza/" class="to-section <?= ($section == 'centros-de-ensenanza')?'active':''; ?>" title="Centros de Enseñanza">Centros de Enseñanza</a></li>
                    <li><a href="<?= get_site_url() ?>/calendario/" class="to-section <?= ($section == 'calendario')?'active':''; ?>" title="Calendario">Calendario</a></li>
                </ul>
            </li>

            <li class="<?php if( $categorySlug == 'salud-corporal' ) echo 'category-active'; ?>" ><a class="to-section" href="<?= get_site_url() ?>/category/salud-corporal/" title="Salud Corporal">Salud Corporal</a></li>
            <li class="<?php if( $categorySlug == 'mente-y-emociones' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/mente-y-emociones/" title="Mente y Emociones">Mente y Emociones</a></li>
            <li class="<?php if( $categorySlug == 'relaciones-humanas' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/relaciones-humanas/" title="Relaciones Humanas">Relaciones Humanas</a></li>
            <li class="<?php if( $categorySlug == 'sentido-de-vida' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/sentido-de-vida/" title="Sentido de Vida">Sentido de Vida</a></li>
            <li class="<?php if( $categorySlug == 'nutricion-consciente' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/nutricion-consciente/" title="Nutrición Consciente">Nutrición Consciente</a></li>
            <li class="<?php if( $categorySlug == 'abundancia' ) echo 'category-active'; ?>"><a class="to-section" href="<?= get_site_url() ?>/category/abundancia/" title="Abundancia">Abundancia</a></li>
            <?php if( wp_is_mobile() ): ?>
            <li><a href="<?= get_site_url() ?>/nuestra-filosofia/" class="btn btn-default" title="Nuestra filosofía">Nuestra filosofía</a></li>
            <li><a href="colabora-con-nosotros/" class="btn btn-orange" title="Colabora con Nosotros">Colabora con Nosotros</a></li>
            <!--li><a href="#" class="btn btn-blue" title="Iniciar Sesión">Ingresar</a></li-->
            <?php endif; ?>
            <li class="menu-social-mobile">
                <a href="https://twitter.com/camino_online" target="_blank" class="btn btn-icon" title="Twitter"><span class="icon icon-tw"></span></a> 
                <a href="https://www.facebook.com/vivecaminoconsciente/" target="_blank" class="btn btn-icon" title="Facebook"><span class="icon icon-fb"></span></a>
                <div class="the-search-form the-search-form-mobile">
                    <form id="mobile-search-form" role="search" action="<?= get_site_url() ?>" method="get">
                        <input type="text" name="s"> <a href="#" class="btn btn-icon the-mobile-search-button" title="Buscar"><span class="icon icon-search"></span></a>
                    </form>
                </div>
            </li>
            
        </ul>
    </nav>

    <nav id="main-menu-mobile" class="menu-mobile">
        <div class="menu-mobile-wrap">
            
            <?php wp_nav_menu( array( 
                'theme_location' => 'cc_main_menu',
            )); ?>

        </div>
    </nav>
</header>
</div>
<div class="login-frame-cont">
    <div id="login-frame" class="login-frame">
        <iframe src="https://caminoconsciente.com.mx/registro/" scrolling="no"  width="320" height="auto"></iframe>
    </div>
</div>