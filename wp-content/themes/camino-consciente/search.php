<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage camino_consciente
 * @since Camino Consciente 1.0
 */

    $type = ( isset( $_GET['search-type'] ) ) ? $_GET['search-type'] : '';

    switch( $type ) {
        case 'search-by-instructor':
            get_template_part( 'template-parts/search-by-instructor' );
            break;
        case 'search-by-criteria':
            get_template_part( 'template-parts/search-by-criteria' );
            break;
        case 'search-venue-by-criteria':
            get_template_part( 'template-parts/search-venue-by-criteria' );
            break;
        case 'search-instructor-by-criteria':
            get_template_part( 'template-parts/search-instructor-by-criteria' );
            break;
        case 'search-instructor-by-instructor':
            get_template_part( 'template-parts/search-instructor-by-instructor' );
            break;
        default:
            get_template_part( 'template-parts/general-search' );
            break;
    }
