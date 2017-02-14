<?php
/**
 * Template Name: Anúnciate
 *
 * @package WordPress
 * @subpackage camino_consciente
 * @since Camino Consciente 1.0
 */

get_header(); ?>

<div id="wrapper">
    <div class="section" id="anunciate-section">
        <div class="container">
            <div class="row">
                <div class="anunciate">
                    <div class="table">
                        <div class="cell-center">
                            <form class="">
                                <img src="<?= THEME_DIR ?>/img/camino-conciente-icon.png" alt="">
                                <p class="top-form-text">Para más información acerca de anunciarte con nosotros, deja tus datos y nos pondremos en contacto contigo</p>
                                <label for="nombre">Nombre*</label>
                                <input type="text" name="nombre">

                                <label for="mail">Correo Electrónico*</label>
                                <input type="email" name="mail">

                                <label for="tel">Teléfono</label>
                                <input type="number" name="tel">
                                <label for="mensaje">Mensaje</label>
                                <textarea name="mensaje" id="mensaje" cols="30" rows="3"></textarea>
                                <a href="" class="btn btn-blue">Enviar</a>
                                <p>Respetamos tu privacidad, tu información nunca será vendida ni cedida a terceros</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
