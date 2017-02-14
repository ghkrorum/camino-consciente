            <ul>
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
                    <div class="menu-social-mobile-wrap">
                        <a href="https://twitter.com/camino_online" target="_blank" class="btn btn-icon" title="Twitter"><span class="icon icon-tw"></span></a> 
                        <a href="https://www.facebook.com/vivecaminoconsciente/" target="_blank" class="btn btn-icon" title="Facebook"><span class="icon icon-fb"></span></a>
                        <div class="the-search-form the-search-form-mobile">
                            <form id="mobile-search-form" role="search" action="<?= get_site_url() ?>" method="get">
                                <input type="text" name="s"> <a href="#" class="btn btn-icon the-mobile-search-button" title="Buscar"><span class="icon icon-search"></span></a>
                            </form>
                        </div>
                    </div>
                </li>
                
            </ul>