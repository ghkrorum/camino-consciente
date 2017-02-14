<?php

define( 'THEME_DIR', get_template_directory_uri() );
define( 'WP_RP_EXCERPT_SHORTENED_SYMBOL', '' );
define("PAGE_COLABORA", 3467);
define("PERFIL_HECTOR_BONILLA", 101);
define("PERFIL_ROCIO_SIERRA", 98);
define("SUBSCRIBE_URL", "https://www.caminoconsciente.com.mx/smartcheckout/main/?curso=");
define("REDIRECT_URL", "https://www.caminoconsciente.com.mx/registro/?redirect_to=");




add_theme_support( 'post-thumbnails' );

add_image_size( 'venue-featured', 600, 600, array( 'top', 'center' ) );
add_image_size( 'instructor-featured', 808, 816, array( 'top', 'center' ) );
add_image_size( 'home-more-articles', 1920, 1280, array( 'top', 'center' ) );
add_image_size( 'home-slider', 1280, 851, array( 'top', 'center' ) );
add_image_size( 'home-latest', 1025, 681, array( 'top', 'center' ) );
add_image_size( 'featured-courses', 1024, 1024, array( 'top', 'center' ) );
add_image_size( 'venue-thumb', 1282, 555, array( 'top', 'center' ) );
add_image_size( 'video-thumb', 400, 300, array( 'top', 'center' ) );
add_image_size( 'video-thumb-560x360', 560, 360, array( 'top', 'center' ) );

/**
 * Register and enqueue theme's scripts and styles
 *
 * @return void
 */
function cc_enqueue_scripts() {

    wp_enqueue_style( 'custom-scrollbar', THEME_DIR . '/lib/custom-scrollbar/jquery.custom-scrollbar.css' );
    wp_enqueue_style( 'style', THEME_DIR . '/css/main.css' );
    wp_enqueue_style( 'ion-icons', THEME_DIR . '/css/ionicons.min.css' );
    wp_enqueue_style( 'lity-css', THEME_DIR . '/css/lity.min.css' );
    wp_enqueue_style( 'jquery-ui', THEME_DIR . '/lib/jquery-ui/jquery-ui.min.css' );

    wp_enqueue_script("jquery");
    wp_register_script( 'jquery-ui', THEME_DIR . '/lib/jquery-ui/jquery-ui.min.js' );
    wp_register_script( 'custom-scrollbar', THEME_DIR . '/lib/custom-scrollbar/jquery.custom-scrollbar.js' );
    wp_register_script( 'custom', THEME_DIR . '/js/main.js' );
    wp_register_script( 'lity-js', THEME_DIR . '/js/lity.min.js' );

    wp_enqueue_script( 'custom' );
    wp_enqueue_script( 'jquery-ui' );
    wp_enqueue_script( 'custom-scrollbar' );
    wp_enqueue_script( 'owl.carousel' );
    wp_enqueue_script( 'lity-js' );
    wp_localize_script( 'custom', 'ajax_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'cc_enqueue_scripts' );

function replace_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-1.12.4.min.js', false, '1.11.3');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'replace_jquery');

add_filter( 'script_loader_tag', 'add_it_to_script', 10, 3 );

function add_it_to_script( $tag, $handle, $src ) {

    if ( 'jquery' == $handle) {
        $tag = '<script type="text/javascript" src="' . $src . '" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>';
    }

    return $tag;
}

// Register Menu
function cc_register_menu() {
  register_nav_menu( 'cc_main_menu', 'Mobile Menu' );
}
add_action( 'init', 'cc_register_menu' );


function cc_custom_mobile_menu_item ( $items, $args ) {
    if ($args->theme_location == 'cc_main_menu') {
        $items .= '<li class="mobile-menu-item-style-1" ><div><span>Conócenos</span><a href="https://www.facebook.com/vivecaminoconsciente/" class="menu-mobile-tw" target="_blank"><img src="'.THEME_DIR.'/img/fb.jpg"></a><a href="https://twitter.com/camino_online" class="menu-mobile-fb" target="_blank"><img src="'.THEME_DIR.'/img/tw.jpg"></a></div></li>';
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'cc_custom_mobile_menu_item', 10, 2 );

/**
 * Returns a truncated text. If the length of such text is greater
 * than the specified limit, the function will return a shorter
 * version with an ellipsis symbol at the end. Otherwise, it will
 * return the text as it is.
 *
 * @param $text
 * @param $max_chars
 *
 * @return string
 */
function wp_rp_text_shorten($text, $max_chars) {
    return mb_strimwidth($text, 0, $max_chars, WP_RP_EXCERPT_SHORTENED_SYMBOL);
}

/**
 * Generates an a tag with the name of the first category of
 * a given post, and a link to category's page.
 *
 * @param $post_id
 * @return string
 */
function get_first_category_link($post_id) {
    $category       = get_the_category( $post_id );

    if( !$category ) return '';

    $category_link  = get_category_link( $category[0]->term_id );
    $category_name  = $category[0]->cat_name;
    $link_tag       = '<a href="%s" class="cat-title" title="%s">%s</a>';
    $link_tag       = sprintf( $link_tag, $category_link, $category_name, $category_name );

    return $link_tag;
}

/**
* Gets all the information related to a specific course and stores it in an array.
 *
 * @return array
 */
function get_course_data() {
    $course_data = array();

    $course_data['length']          = get_field( 'course_duration' );
    $course_data['starting_date']   = get_field( 'course_starting_date' );
    $course_data['end_date']        = get_field( 'course_end_date' );
    $course_data['is_free']          = get_field( 'course_is_free' );
    $course_data['cost']            = get_field( 'course_cost' );
    $course_data['type']            = get_field( 'course_type' );
    $course_data['location']            = get_field( 'course_location' );
    $course_data['location_url']            = get_field( 'course_google_maps_url' );
    $course_data['venue']           = get_field( 'course_centro_de_ensenanza' );
    $course_data['video']           = array(
      'url' => get_field( 'course_main_video' ),  
      'preview' => get_field( 'course_main_video_prev' ), 
    );
    $course_data['testimonials']    = array(
        'video_testimonial_1'           => get_field( 'course_video_testimonial_1' ),
        'video_thumb_testimonial_1'     => get_field( 'course_thumb_video_testimonial_1' ),
        'video_testimonial_2'           => get_field( 'course_video_testimonial_2' ),
        'video_thumb_testimonial_2'     => get_field( 'course_thumb_video_testimonial_2' ),
        'video_testimonial_3'           => get_field( 'course_video_testimonial_3' ),
        'video_thumb_testimonial_3'     => get_field( 'course_thumb_video_testimonial_3' ),
        'quote_testimonial_1'           => get_field( 'course_quote_testimonial_1' ),
        'quote_testimonial_2'           => get_field( 'course_quote_testimonial_2' ),
        'quote_testimonial_3'           => get_field( 'course_quote_testimonial_3' ),
    );

    $course_data['benefits'] = get_field( 'course_benefits' );
    $course_data['custom_author'] = get_field( 'custom_author' );
    $instructor = get_field( 'course_instructor' );
    $course_data['author'] = '';
    $course_data['instructor'] = NULL;

    if ( $course_data['custom_author'] ){
        $course_data['author'] = get_field( 'the_autor' );
    }elseif ( $instructor ){
        $course_data['instructor'] = $instructor;
        $course_data['author'] = kxn_get_instructor_name( $instructor[0] );
    }    
    
    return $course_data;
}

function kxn_get_ws_course_data( $courseId = null ){
    
    if (!$courseId){
        $courseId = get_field('course_id');
    }

    $courseAttrs = array();
    if ( $courseId && is_numeric($courseId) ){

        $courseUrl = "http://caminoconsciente.com.mx/includeslp/ws_is/?producto=".$courseId;
        $courseJson = file_get_contents( $courseUrl );
        if ( $courseJson ){
            $courseAttrs = json_decode($courseJson, true);
        }
    }

    return $courseAttrs;
}

function kxn_get_course_price($course_data = null){
    $price = '';
    if ( isset( $course_data['precio_original'] ) &&  !empty( $course_data['precio_original'] ) ){
        $price = number_format($course_data['precio_original'], 0).' '.$course_data['moneda_original'];
    }else{
        // $price = $course_data['cost'];
    }
    return $price;
}

function kxn_get_course_local_price($course_data = null){
    $price = '';
    if ( isset( $course_data['precio_local'] ) &&  !empty( $course_data['precio_local'] ) ){
        $price = number_format($course_data['precio_local'], 0).' '.$course_data['moneda_local'];
    }
    return $price;
}

function kxn_get_course_title($course_data = null){
    return ( isset( $course_data['titulo'] ) ) ? $course_data['titulo'] : get_the_title();
}

function kxn_get_course_type($course_data = null){
    if ( isset( $course_data['online'] ) ){
        return ( $course_data['online'] ) ? 'online' : 'insite';
    }
    return $course_data['type'];
}

function kxn_get_instructor_name($instructor){
    $name = get_field( 'instructor_name', $instructor->ID );
    $lastName = get_field( 'instructor_last_name', $instructor->ID );
    return sprintf('%s %s', $name, $lastName);
}

function kxn_get_search_tag_url($slug, $searchType){
    return add_query_arg( array(
        's' => '',
        'search-type' => $searchType,
        'tag' => $slug,
    ), esc_url( home_url( ) ) );
}

function kxn_get_post_author($post){
    switch ( $post->post_type ) {
        case 'instructor':
            return kxn_get_instructor_name($post);
            break;
        case 'centros_de_ensenanza':
            return $post->post_title;
            break;
    }

    return '';
}

function kxn_get_single_cat_title(){
    global $post;
    $category = single_cat_title( "", false );
    if ( $category ){
        return $category;
    }else{
        $category = get_the_category($post->ID);
        if ( $category ){
            return $category[0]->name;
        }
    }
    return '';
}

/**
 * Gets the starting date of a specific course. If no date is provided then
 * a placeholder text is returned.
 *
 * @param $date
 * @return string
 */
function get_course_starting_date($date ) {
    $starting_date = '';

    if( !$date ) return 'Abierto';

    setlocale(LC_ALL,"es_ES");

    return strftime("%e de %B %Y", strtotime($date));
}

/**
 * Returns an array with all the countries registered in the site
 * (custom taxonomies).
 *
 * @return array
 */
function get_all_countries() {
    $country_list = array();

    $country_list = get_terms( 'ubicacion', array(
        'orderby'       => 'count',
        'hide_empty'    => 1,
        'parent'        => 0,
        'orderby'       => 'DESC',
    ) );

    return $country_list;
}

/**
 * Returns an array with all the instructors registered in the site
 * (custom post type).
 *
 * @return array
 */
function get_all_instructors() {
    $instructors_list = array();
    $instructors_query_args = array(
        'post_status'   => 'publish',
        'post_type'     => 'instructor',
        'order'         => 'ASC',
        'meta_key'		=> 'instructor_last_name',
        'orderby'		=> 'meta_value',
    );

    $instructors_query = new WP_Query( $instructors_query_args );
    $instructors_list = $instructors_query->get_posts();

    return $instructors_list;
}

/**
 * Returns a list of all the cities belonging to a specific country.
 *
 * @param $country_id
 * @return array
 */
function get_all_cities_from_country( $country_id ) {
    $cities_list = array();

    $terms = get_terms( 'ubicacion',
            array(
                'parent'     => $country_id,
                'orderby'    => 'slug',
                'hide_empty' => false,
            )
    );

    foreach ( $terms as $term ) {
        $city = array(
            'id'    => $term->term_id,
            'name'  => $term->name,
        );
        $cities_list[] = $city;
    }

    return $cities_list;
}

/**
 * Returns a list of all the cities.
 *
 * @return array
 */
function get_all_cities() {
    $cities_list = array();

    $terms = get_terms( 'ubicacion',
        array(
            'orderby'    => 'slug',
            'hide_empty' => false,
        )
    );

    foreach ( $terms as $term ) {
        if( $term->parent != 0 ) {
            $city = array(
                'id'    => $term->term_id,
                'name'  => $term->name,
            );
            $cities_list[] = $city;
        }
    }

    return $cities_list;
}

/**
 * Returns the name of the city where the venue is located.
 *
 * @param $object_id
 * @return string
 */
function get_city_from_object($object_id ) {
    $terms = wp_get_post_terms( $object_id,  'ubicacion', array('childless' => true) );

    foreach ($terms as $term){
        if ($term->parent)
            return $term;
    }
}

/**
 * Returns the country object (parent) from the city id (child term).
 *
 * @param $city_id
 * @return array
 */
function get_country_from_city( $city_id ) {
    $child_term = get_term( $city_id, 'ubicacion' );
    $parent_term = get_term( $child_term->parent, 'ubicacion' );

    return $parent_term;
}

/**
 * Returns the location (city, country) from an object.
 *
 * @param WP_Term $object
 * @return string
 */
function get_location_from_object( $object ) {
    $location = '';
    $city_object = array();
    $city_name = '';
    $country_name = '';
    $terms = array();

    $city_object = get_city_from_object( $object->ID );
    $terms[] = $city_object->name;
    $country =  get_country_from_city( $city_object->term_id );
    if ( isset($country->name) ){
        $terms[] = $country->name;
    }

    // if( $city_name && $country_name )
    $location = implode(', ', $terms);

    return $location;
}

/*
 * Returns a readable name for the course type.
 *
 * @param $course_key
 * @return string
 */
function get_course_type_name( $course_key ) {
    $course_name = '';

    switch ( $course_key ) {
        case 'insite':
            $course_name = 'presencial';
            break;
        case 'online':
        default:
            $course_name = 'en línea';
            break;
    }

    return $course_name;
}

/**
 * Generates HTML markup for a dropdown list with all the months of the current year
 * and if the current month is October (or greater), add the first three months
 * of the next year.
 */
function generate_month_dropdown() {
    $dropdown_name = 'month_select';
    $current_year = date('y');
    $current_month = date('n');
    $month_name = '';
    $month_selected = '';

    echo '<select name="'.  $dropdown_name  .'" class="' . $dropdown_name  . '">';
    for( $month = 1; $month <= 12; $month++) {
        $month_selected = ( $month == $current_month ) ? 'selected="selected"' : '' ;
        $current_date = mktime( 0, 0, 0, $month + 1, 0, $current_year, 0 );
        $month_name = date( 'F Y', $current_date  );
        $data_year = date( 'Y ', $current_date  );
        echo '<option value="' . $month . '" ' . $month_selected . ' data-year="' . $data_year . '">' . $month_name . '</option>';
    }

    // TODO: Refactor mktime code into a function

    if( $current_month > 5 ) {
        for( $month = 1; $month <= 3; $month++) {
            $month_name = date( 'F Y', mktime( 0, 0, 0, $month + 1, 0, $current_year + 1, 0 ) );
            $data_year = date( 'Y', mktime( 0, 0, 0, $month + 1, 0, $current_year + 1, 0 ) );
            echo '<option value="' . $month . '" data-year="' . $data_year . '">' . $month_name . '</option>';
        }
    }
    echo '</select>';
}

/**
 * Generates HTML markup for a dropdown list with all the cities (custom taxonomies)
 * registered in the database.
 */
function generate_cities_dropdown() {
    $dropdown_name = "city";
    $cities_list = get_all_cities();

    if( count($cities_list ) == 0 ) return;

    echo '<select name="'.  $dropdown_name  .'" class="' . $dropdown_name  . '" data-placeholder="Ciudad">';
    echo '<option selected="selected" value="">Elige una ciudad</option>';
    foreach( $cities_list as $city ) :
        echo '<option value="'. $city["id"] .'">' .  $city["name"]. '</option>';
    endforeach;
    echo '</select>';
}

/**
 * Generates HTML markup for a dropdown list with all the countries (custom taxonomies)
 * registered in the database.
 */
function generate_country_dropdown() {
    $countries_list = get_all_countries();
    $dropdown_name = "country";

    if( count($countries_list) == 0 ) return;

    echo '<select name="'.  $dropdown_name  .'" class="' . $dropdown_name  . '" data-placeholder="País">';
    echo '<option selected="selected" value="">Elige un país</option>';
    foreach( $countries_list as $country ) :
        echo '<option value="'. $country->term_id .'">' .  $country->name . '</option>';
    endforeach;
    echo '</select>';
}

/**
 * Generates HTML markup for a dropdown list with all the instructors (custom posts)
 * registered in the database.
 */
function generate_instructors_dropdown() {
    $instructors_list = get_all_instructors();
    $dropdown_name = "instructor";
    $instructor_object = array();

    if( count($instructors_list) == 0 ) return;

    echo '<select name="'.  $dropdown_name  .'" class="' . $dropdown_name  . '" data-placeholder="Instructor">';
    echo '<option value="" >Ver todos</option>';
    foreach( $instructors_list as $instructor ) :
        $instructor_object['ID']    = $instructor->ID;
        $instructor_object['name'] = get_field( 'instructor_name', $instructor->ID );
        $instructor_object['name'] .= " ";
        $instructor_object['name'] .= get_field( 'instructor_last_name', $instructor->ID );
        $permalink = get_permalink($instructor->ID);
        echo '<option value="'. $instructor_object['ID'] .'" data-permalink="'.$permalink.'">' . $instructor_object['name'] . '</option>';
    endforeach;
    echo '</select>';
}

/**
 * Generates HTML markup for a dropdown list with all the categories
 * registered in the database.
 */
function generate_categories_dropdown() {
    $categories_list = get_categories();
    $dropdown_name = "categories";

    if( count($categories_list) == 0 ) return;

    echo '<select name="'.  $dropdown_name  .'" class="' . $dropdown_name  . '" data-placeholder="Tema">';
    echo '<option value="">Ver todos</option>';
    foreach( $categories_list as $category ) :
        echo '<option value="'. $category->term_id .'">' . $category->name . '</option>';
    endforeach;
    echo '</select>';
}

/*
 * Retrieves all the cities (custom taxonomies) that are children of a country
 * and encodes them in a JSON string literal which later will be iterated
 * via JavaScript to fill the cities dropdown list.
 */
function ajax_fill_cities_dropdown() {
    $country_id = $_POST['country_id'];
    $cities_list = get_all_cities_from_country( $country_id );

    echo json_encode( $cities_list );

    wp_die();
}

add_action( 'wp_ajax_nopriv_ajax_fill_cities_dropdown', 'ajax_fill_cities_dropdown' );
add_action( 'wp_ajax_ajax_fill_cities_dropdown', 'ajax_fill_cities_dropdown' );

/**
 * Gets all the information related to a specific venue and stores it in an array.
 *
 * @return array
 */
function get_venue_data() {
    $venue_data = array();

    $venue_data['slogan']           = get_field( 'venue_slogan' );
    $venue_data['phone']            = get_field( 'venue_landline' );
    $venue_data['mobile']           = get_field( 'venue_mobile_phone' );
    $venue_data['email']            = get_field( 'venue_email' );
    $venue_data['website']          = get_field( 'venue_website' );
    $venue_data['address']          = get_field( 'venue_address' );
    $venue_data['is_featured']      = get_field( 'venue_is_featured' );
    $venue_data['gmaps_url']        = get_field( 'venue_google_maps_url' );
    $venue_data['specialty']        = get_field( 'venue_specialty' );
    $venue_data['social_networks']  = array(
        'instagram'     => get_field( 'venue_instagram' ),
        'facebook'      => get_field( 'venue_facebook' ),
        'twitter'       => get_field( 'venue_twitter' ),
    );
    $venue_data['video']            = array(
        'video_url'             => get_field( 'venue_video_url' ),
        'video_preview_image'   => get_field( 'venue_video_preview_image' ),
    );

    

    return $venue_data;
}

/*
 * Prints the slogan of the venue. If no value is specified, nothing
 * will be printed.
 *
 * @param $slogan
 */
function the_venue_slogan( $slogan ) {
    if( $slogan )
        echo sprintf( '<h3>%s</h3>', $slogan );
}

/*
 * Prints the landline of the venue. If no value is specified, nothing
 * will be printed.
 *
 * @param $phone
 */
function the_venue_phone( $phone ) {
    if( $phone ) {
        echo sprintf( '<li><a href="tel:%s"><i class="icon icon-tel"></i>%s</a></li>', $phone, $phone );
    }
}

/*
 * Prints the mobile phone of the venue. If no value is specified, nothing
 * will be printed.
 *
 * @param mobile
 */
function the_venue_mobile( $mobile ) {
    if( $mobile ) {
        echo sprintf( '<li><a href="tel:%s"><i class="icon icon-cel"></i>%s</a></li>', $mobile, $mobile );
    }
}

/*
 * Prints the e-mail of the venue. If no value is specified, nothing
 * will be printed.
 *
 * @param $mail
 */
function the_venue_mail( $mail ) {
    if( $mail ) {
        echo sprintf( '<li><a href="mailto:%s"><i class="icon icon-mail"></i>Contáctame</a></li>', $mail, $mail  );
    }
}

/*
 * Prints the website of the venue. If no value is specified, nothing
 * will be printed.
 *
 * @param website
 */
function the_venue_website( $website ) {
    if( $website) {
        echo sprintf( '<li><a href="%s"><i class="icon icon-connect"></i>%s</a></li>', $website, $website  );
    }
}

/*
 * Prints the link to the instagram profile of the venue.
 * If no value is specified, nothing will be printed.
 *
 * @param link
 */
function the_venue_instagram( $link ) {
    if( $link ) {
        echo sprintf( '<a href="%s" class="share share-instagram" data-network=""><i class="network icon icon-instagram"></i></a>', $link );
    }
}

/*
 * Prints the link to the facebook profile of the venue.
 * If no value is specified, nothing will be printed.
 *
 * @param link
 */

function the_venue_facebook( $link ) {
    if( $link ) {
        echo sprintf( '<a href="%s" class="share share-fb" data-network=""><i class="network icon icon-fb"></i></a>', $link );
    }
}

/*
 * Prints the link to the twitter profile of the venue.
 * If no value is specified, nothing will be printed.
 *
 * @param link
 */
function the_venue_twitter( $link ) {
    if( $link ) {
        echo sprintf( '<a href="%s" class="share share-tw" data-network=""><i class="network icon icon-tw"></i></a>', $link );
    }
}

/**
 * Gets all the information related to a specific instructor and stores it in an array.
 *
 * @return array
 */
function get_instructor_data() {
    $instructor_data = array();

    $instructor_data['name']        = get_field( 'instructor_name' );
    $instructor_data['last_name']   = get_field( 'instructor_last_name' );
    $instructor_data['profession']  = get_field( 'instructor_profession' );
    $instructor_data['phone']       = get_field( 'instructor_phone' );
    $instructor_data['mobile']      = get_field( 'instructor_mobile_phone' );
    $instructor_data['address']     = get_field( 'instructor_address' );
    $instructor_data['email1']      = get_field( 'instructor_email_1' );
    $instructor_data['email2']      = get_field( 'instructor_email_2' );
    $instructor_data['instagram']   = get_field( 'instructor_instagram' );
    $instructor_data['facebook']    = get_field( 'instructor_facebook' );
    $instructor_data['twitter']     = get_field( 'instructor_twitter' );
    $instructor_data['gmaps_url']   = get_field( 'instructor_google_maps_url' );
    $instructor_data['video']            = array(
        'video_url'             => get_field( 'instructor_video_url' ),
        'video_preview_image'   => get_field( 'instructor_video_preview_image' ),
    );
    $instructor_data['type']   = get_field( 'instructor_type' );
    $instructor_data['location']   =  ( $instructor_data['type'] == 'insite' ) ? get_field( 'instructor_location' ) : 'En línea' ;

    return $instructor_data;
}

/*
 * Prints the landline of the instructor. If no value is specified, nothing
 * will be printed.
 *
 * @param $phone
 */
function the_instructor_phone( $phone ) {
    if( $phone )
        echo sprintf( '<li><a href="tel:%s"><i class="icon icon-tel"></i>%s</a></li>', $phone, $phone );
}

/*
 * Prints the mobile phone of the instructor. If no value is specified, nothing
 * will be printed.
 *
 * @param $mobile
 */
function the_instructor_mobile( $mobile ) {
    if( $mobile )
        echo sprintf( '<li><a href="tel:%s"><i class="icon icon-cel"></i>%s</a></li>', $mobile, $mobile );
}

/*
 * Prints the e-mail(s) of the instructor. If no value is specified, nothing
 * will be printed.
 *
 * @param $email1
 * @param $email2
 */
function the_instructor_email( $email1, $email2 ) {
    if( $email1 )
        echo sprintf( '<li class="mail-container"><a href="mailto:%s"><i class="icon icon-mail"></i>Contáctame</a></li>', $email1, $email1 );

    if( $email2 )
        echo sprintf( '<li class="mail-container"><a href="mailto:%s"><i class="icon icon-mail"></i>Contáctame</a></li>', $email2, $email2 );
}

/*
 * Prints the mobile phone of the instructor. If no value is specified, nothing
 * will be printed.
 *
 * @param $address
 */
function the_instructor_address( $address ) {
    if( $address )
        echo sprintf( '<h4>%s</h4>', $address );
}

/*
 * Prints the instagram URL of the instructor. If no value is specified, nothing
 * will be printed.
 *
 * @param $link
 */
function the_instructor_instagram( $link ) {
    if( $link )
        echo sprintf( '<li><a href="%s" target="_blank" class="share share-instagram" data-network=""><i class="network icon icon-instagram"></i></a></li>', $link );
}

/*
 * Prints the facebook URL of the instructor. If no value is specified, nothing
 * will be printed.
 *
 * @param $link
 */
function the_instructor_facebook( $link ) {
    if( $link )
        echo sprintf( '<li><a href="%s" target="_blank" class="share share-fb" data-network=""><i class="network icon icon-fb"></i></a></li>', $link );
}

/*
 * Prints the twitter URL of the instructor. If no value is specified, nothing
 * will be printed.
 *
 * @param $link
 */
function the_instructor_twitter( $link ) {
    if( $link )
        echo sprintf( '<li><a href="%s" target="_blank" class="share share-tw" data-network=""><i class="network icon icon-tw"></i></a></li>', $link );
}

/*
 * Returns a readable version of the course location, taken from the custom taxonomies
 * associated to it, not from the venue's location.
 *
 * @param WP_Term $terms
 * @return string
 */
function the_course_location($terms) {
    $country_name = "";
    $city_name = "";
    $location = "";

    if( $terms ) {
        foreach ($terms as $term) {
            if( $term->parent == 0 )
                $country_name = $term->name;
            else
                $city_name = $term->name;

            if( $country_name && $city_name )
                $location = sprintf( "%s, %s", $city_name, $country_name );
        }
    }

    return $location;
}

/*
 * Allows the search string (s) to be empty in order to use a custom template
 * to show the search results.
 */
function search_filter($query) {
    if ( isset($_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query()){
        $query->is_search = true;
        $query->is_home = false;
    }

    return $query;
}

session_start();

add_filter('posts_orderby', 'edit_posts_orderby');

function edit_posts_orderby($orderby_statement) {

    $seed = $_SESSION['seed'];
    if (empty($seed)) {
      $seed = rand();
      $_SESSION['seed'] = $seed;
    }

    $orderby_statement = 'RAND('.$seed.')';
    return $orderby_statement;
}

add_filter('pre_get_posts','search_filter');

// The function that handles the AJAX request
function cc_ajax_get_calendar() {
    $month = $_GET['month'];
    $year = $_GET['year'];
    $category = $_GET['category'];
    $country = $_GET['country'];
    $city = $_GET['city'];

    $timestamp = strtotime($year.'-'.$month.'-01');

    $nextMonthTime = strtotime('+1 month', $timestamp);

    $nextMonth = date('n', $nextMonthTime);
    $nextYear = date('Y', $nextMonthTime);

    ob_start();
    printCalendar($month, $year, 'sun', $category, $country, $city);
    $calendar = ob_get_clean();

    echo json_encode(array(
        'content' => $calendar,
        'nextMonth' => $nextMonth,
        'nextYear' => $nextYear,
    ));
    
    die(); // this is required to return a proper result
}
add_action( 'wp_ajax_get_calendar', 'cc_ajax_get_calendar' );
add_action( 'wp_ajax_nopriv_get_calendar', 'cc_ajax_get_calendar' );

function getCoursesByDateRange($startDate, $endDate, $cat = '', $country = '', $city = ''){
    
    global $wpdb;

$sql = <<<SQL
    SELECT
        p.*, pm.meta_value start_date, pm2.meta_value end_date, ct.name dcountry, ct2.name dcity, t.name categoria
    FROM 
        wp_posts p 
    LEFT JOIN 
        wp_postmeta pm on pm.post_id = p.ID
    LEFT JOIN
        wp_postmeta pm2 on pm2.post_id = p.ID

    LEFT JOIN
        wp_term_relationships r on r.object_id = p.ID
    LEFT JOIN 
        wp_term_taxonomy tt on r.term_taxonomy_id = tt.term_taxonomy_id and tt.taxonomy = 'category'
    LEFT JOIN 
        wp_terms t on tt.term_id = t.term_id 

    LEFT JOIN
        wp_term_relationships cr on cr.object_id = p.ID
    LEFT JOIN 
        wp_term_taxonomy ctt on cr.term_taxonomy_id = ctt.term_taxonomy_id and ctt.taxonomy = 'ubicacion'
    LEFT JOIN 
        wp_terms ct on ctt.term_id = ct.term_id 

    LEFT JOIN
        wp_term_relationships cr2 on cr2.object_id = p.ID
    LEFT JOIN 
        wp_term_taxonomy ctt2 on cr2.term_taxonomy_id = ctt2.term_taxonomy_id and ctt2.taxonomy = 'ubicacion' and ctt2.parent > 0
    LEFT JOIN 
        wp_terms ct2 on ctt2.term_id = ct2.term_id 
SQL;

    $where = array(
        "p.post_status = 'publish' ",
        "p.post_type = 'cursos'",
        "pm.meta_key = 'course_starting_date'",
        "pm2.meta_key = 'course_end_date'",
        "pm.meta_value <> ''",
        "pm2.meta_value <> ''",
        "(
            ( pm.meta_value >= '$startDate' AND pm2.meta_value <= '$endDate' )
            OR
            ( pm.meta_value <= '$startDate' AND pm2.meta_value >= '$startDate' )
            OR 
            ( pm.meta_value <= '$endDate' AND pm2.meta_value >= '$endDate' ) 
        )",
    );

    if ($cat){
        $where[] = "r.term_taxonomy_id = $cat";
    }

    if ($country){
        $where[] = "cr.term_taxonomy_id = $country";
    }

    if ($city){
        $where[] = "cr2.term_taxonomy_id = $city";
    }

    $sql .= ' WHERE '. implode(' AND ', $where);

    $sql .= ' GROUP BY p.ID';

    $sql .= ' ORDER BY pm.meta_value ASC';
    
    return $wpdb->get_results( $sql );
}

function printCalendar($month, $year, $firstDay = 'sun', $cat = '', $country = '', $city = '')
{

    $twoDigitMonth = str_pad($month, 2, "0", STR_PAD_LEFT);
    $posts = getCoursesByDateRange($year.$twoDigitMonth.'01', date('Ymt', strtotime($year.'-'.$twoDigitMonth.'-01') ), $cat, $country, $city );
    # Get the number of days in the month
    $caltContClass = ($posts)?'the-cal-cont-wrap':'the-cal-cont-wrap no-events';
    echo '<div class="'.$caltContClass.'">';
    $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    # Get the day-of-the-week the 1st starts on
    $date = getDayOfTheWeek($month,$year, $firstDay);
    # print out the table headers
    printTableHeader($date, $firstDay);
    # print table body
    printTableBody($totalDays, $date['startDay'], $month , $year, $posts);
    # print out the table headers
    printTableFooter($firstDay);
    echo '</div>';
}



function printTableHeader($date, $firstDay)
{
    # The standard "Sunday First" calendar of days
    setlocale(LC_ALL,"es_ES");
    $days = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'); 
    # change to the "Monday First" calendar
    if($firstDay == 'mon'){
        # the days of the week
        $days = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'); 
    }

    setlocale(LC_ALL,"es_ES");

    $month = $date['month'];
    $year = $date['year'];

    $fecha = strftime("%B, %Y", strtotime("$year-$month-01"));

    # print the header HTML for the calendar table
    echo '<h1>' . $fecha . '</h1>' . "\n";
    echo '<div class="custom-calendar-cont">' . "\n";
    echo "\t" . '<ul class="custom-calendar-row custom-calendar-head">' . "\n";
    # loop through the days and print them out
    foreach($days as $day){
        echo "\t\t\t" . '<li class="custom-calendar-col"><div><span>' . $day . '</span></div></li>' . "\n"; 
    }
    # close table header HTML
    echo "\t" . '</ul>' . "\n";
}

function printTableBody($totalDays, $startDay, $month , $year, $posts = array() )
{
    
    # value to represent the day the last day of the month falls on
    $endDay = 6;
    # value to represent the current day of the week
    $currDay = 1;
    # Loop through all the days of the month
    for( $todayDate=1; $todayDate <= $totalDays; $todayDate++ ){
        # start a new row every 7 days
        if($currDay % 7 == 1) { echo "\t\t" . '<ul class="custom-calendar-row">' . "\n"; }
        # increment the current day (do this before the closing table row)
        $currDay++;
        # loop through the number of starting days to represent the days of the previous month
        $currDay = printPrevMonthDays($startDay, $currDay);
        $courses = array();
        $currDate = $year.str_pad($month, 2, "0", STR_PAD_LEFT).str_pad($todayDate, 2, "0", STR_PAD_LEFT);

        $counter = 0;
        global $post;
        $thePost = $post;
        foreach ($posts as $post){
            
            if ( $post->start_date <= $currDate && $currDate <= $post->end_date ){
                setup_postdata( $post ); 
                $course_data = get_course_data();
                $courseTitle = kxn_get_course_title($course_data);
                $courseType = kxn_get_course_type($course_data);
                $startDate = get_course_starting_date( $course_data['starting_date'] );
                
                if ($courseType == 'insite'){
                    $location = get_location_from_object($post);
                }
                $location = (empty($location) && $courseType == 'online' )?'En línea':$location;
                $link = get_permalink($post->ID);
                $coursetag = '<a href="'.$link.'"><span>'.$courseTitle.'</span><span>Inicio: '.$startDate.'</span><span>Lugar: '.$location.'</span></a>';
                $courses[] = '<li class="cal-ev-1">'.$coursetag.'</li>';
                $counter = ($counter < 2)?++$counter:0;
            }
        }
        $coursesList = '<ul>'.implode($courses).'</ul>';

        if ($todayDate <= $totalDays){
            $day = str_pad($todayDate, 2, "0", STR_PAD_LEFT);
            $hasCoursesClass = ( empty($courses) )?'no-courses':'has-courses';
            # print out the table cell for this day.  Start a new row for every 7 days
            echo "\t\t\t" . '<li class="custom-calendar-col '.$hasCoursesClass.'"><div class="custom-calendar-col-wrap"><div class="custom-calendar-col-cont"><div class="events-cont"><div class="cal-ev-cont-wrap">'.$coursesList.'</div></div> <div class="month-day">'.$day.'</div> </div></div></li>' . "\n";
        }
        # close the table row every 7 days
        if( ($currDay % 7 == 1) || ($todayDate == $totalDays) ) { 
            while ( !($currDay % 7 == 1) ){
                echo "\t\t\t" . '<li class="custom-calendar-col cal-col-empty"><div class="custom-calendar-col-wrap"><div class="custom-calendar-col-cont"><div class="month-day">&nbsp;</div> <div class="events-cont"></div></div> </div></li>' . "\n";
                $currDay++;
            }
            echo "\t\t" . '</ul>' . "\n"; 
        }
    }
}

function printTableFooter($firstDay)
{
    echo "\t" . '</div>' . "\n";
}

function getDayOfTheWeek($month, $year, $firstDay = 'sun')
{
    $date = array();
    # save out the date values
    $time = mktime(0, 0, 0, $month, 1, $year);
    $date['dotw'] = strtolower( date("D", $time) );
    $date['month'] = strtolower( date("F", $time) );
    $date['year'] = strtolower( date("Y", $time) );

    switch($date['dotw']){
        default:
        case 'sun': $date['startDay'] = 0; break;
        case 'mon': $date['startDay'] = 1; break;
        case 'tue': $date['startDay'] = 2; break;
        case 'wed': $date['startDay'] = 3; break;
        case 'thu': $date['startDay'] = 4; break;
        case 'fri': $date['startDay'] = 5; break;
        case 'sat': $date['startDay'] = 6; break;
    }
    # subtract one if we want to display Monday as the first day of the week
    if($firstDay == 'mon')
        $date['startDay'] = $date['startDay'] - 1;
    # return date array object
    return $date;
}

# passing startDay by reference
function printPrevMonthDays(&$startDay, $currDay)
{
    while($startDay != 0){
        echo "\t\t\t" . '<li class="custom-calendar-col cal-col-empty"><div class="custom-calendar-col-wrap"><div class="custom-calendar-col-cont"><div class="month-day">&nbsp;</div><div class="events-cont"></div></div></div></li>' . "\n";  
        # increment the current day
        $currDay++;
        # decrement the startDay
        $startDay--;    
    }
    # return zero to 
    return $currDay;
}

function kxn_get_acf_image_src($imageObject, $size = ''){
    if ($imageObject){
        if (!empty($size)){
            // vars
            $url = $imageObject['url'];

            // img src
            $imgSrc = $imageObject['sizes'][ $size ];

            return $imgSrc;
        }
    }
    return '';
}

function kxn_search_filter( $query ) {

  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
        $query->set('meta_key', 'course_type' );
        $query->set('orderby', 'meta_value' );
    }
  }
}
add_action('pre_get_posts','kxn_search_filter');

function cc_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'cc_excerpt_more');
