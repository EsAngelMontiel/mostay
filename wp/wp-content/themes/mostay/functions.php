<?php
/*
 *  Author: Ángel Montiel & Héctor Montiel
 *  URL: https://www.mostay.co | IG @mostayco
 *  Custom functions, support, custom post types and more.
 */

/*--------------------------------------------------------------*\

     _/     _/_/ _/_/_/_/  _/_/_/_/  _/_/_/_/_/  _/_/    _/     _/
    _/_/  _/ _/ _/    _/  _/            _/     _/   _/    _/  _/
   _/  _/   _/ _/    _/  _/_/_/_/      _/     _/_/_/_/     _/
  _/       _/ _/    _/        _/      _/     _/     _/    _/
 _/       _/ _/_/_/_/  _/_/_/_/      _/     _/      _/   _/

\*--------------------------------------------------------------*/


/*------------------------------------*\
    Theme Support
\*------------------------------------*/

// Image Size Constants
define('MOSTAY_LARGE_THUMB_WIDTH', 1920);
define('MOSTAY_LARGE_THUMB_HEIGHT', 9999);
define('MOSTAY_MEDIUM_THUMB_WIDTH', 800);
define('MOSTAY_MEDIUM_THUMB_HEIGHT', 9999);
define('MOSTAY_SMALL_THUMB_WIDTH', 480);
define('MOSTAY_SMALL_THUMB_HEIGHT', 9999);
define('MOSTAY_COVER_PROJECT_WIDTH', 480);
define('MOSTAY_COVER_SIZE_WIDTH', 480);
define('MOSTAY_COVER_SIZE_HEIGHT', 280);

if (!isset($content_width)) {
    $content_width = 1170;
}

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('hero-xl', 3840, 2160, true);
    add_image_size('hero-lg', 1920, 1080, true);
    add_image_size('hero-md', 800, 800, true);
    add_image_size('hero-sm', 480, 480, true);

    add_image_size('xlarge', MOSTAY_LARGE_THUMB_WIDTH * 2, MOSTAY_LARGE_THUMB_HEIGHT);
    add_image_size('large', MOSTAY_LARGE_THUMB_WIDTH, MOSTAY_LARGE_THUMB_HEIGHT);
    add_image_size('medium', MOSTAY_MEDIUM_THUMB_WIDTH, MOSTAY_MEDIUM_THUMB_HEIGHT);
    add_image_size('small', MOSTAY_SMALL_THUMB_WIDTH, MOSTAY_SMALL_THUMB_HEIGHT);

    add_image_size('thumb', 480, 280, true);

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    function mostay_load_theme_textdomain() {
        load_theme_textdomain('mostay', get_template_directory() . '/languages');
    }
    
}

/*------------------------------------*\
    Custom Nav Walker Classes
\*------------------------------------*/

class Mostay_Main_Nav_Walker extends Walker_Nav_Menu {
    // Inicia cada elemento del menú
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        static $menu_counter = 1; // Contador para los números en <span>
        $classes = !empty($item->classes) ? implode(' ', $item->classes) : '';
        $classes .= ' mainMenu__item'; // Clase personalizada para cada <li>

        $output .= '<li class="' . esc_attr($classes) . '">';
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        $output .= '<span>' . str_pad($menu_counter++, 2, '0', STR_PAD_LEFT) . '</span>'; // Número con dos dígitos
    }

    // Termina cada elemento del menú
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}

class Secondary_Menu_Walker extends Walker_Nav_Menu {
    private $counter;
    private $start_value;

    // Constructor: inicializa el contador con un valor inicial
    public function __construct($start_value = 6) {
        $this->start_value = $start_value;
        $this->counter = $start_value;
    }

    // Función que genera el HTML de cada elemento <li>
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $svg_icons = [
            'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>',
            'youtube' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>',
            'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M100.28 448H7.4V165.49h92.88zM53.79 108.1C24.08 108.1 0 83.55 0 54A53.79 53.79 0 0153.79 0c29.9 0 54 24.58 54 54a53.79 53.79 0 01-53.79 54.1zm394.2 339.9h-92.69v-146.6c0-34.88-.7-79.67-48.54-79.67-48.54 0-55.94 37.93-55.94 77.18V448H158.4V165.49h89V202h1.28c12.38-23.44 42.7-48.18 87.84-48.18 93.88 0 111.2 61.78 111.2 142.3V448z"/></svg>',
            'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M459.4 151.7c.3 4.5 .3 9.1 .3 13.6 0 138.7-105.6 298.6-298.6 298.6-59.5 0-114.7-17.2-161.1-47.1 8.4 1 16.6 1.3 25.3 1.3 49.1 0 94.2-16.6 130.3-44.8-46.1-1-84.8-31.2-98.1-72.8 6.5 1 13 1.6 19.8 1.6 9.4 0 18.8-1.3 27.6-3.6-48.1-9.7-84.1-52-84.1-103v-1.3c14 7.8 30.2 12.7 47.4 13.3-28.3-18.8-46.8-51-46.8-87.4 0-19.5 5.2-37.4 14.3-53 51.7 63.7 129.3 105.3 216.4 109.8-1.6-7.8-2.6-15.9-2.6-24 0-57.8 46.8-104.9 104.9-104.9 30.2 0 57.5 12.7 76.7 33.1 23.7-4.5 46.5-13.3 66.6-25.3-7.8 24.4-24.4 44.8-46.1 57.8 21.1-2.3 41.6-8.1 60.4-16.2-14.3 20.8-32.2 39.3-52.6 54.3z"/></svg>',
        ];

        $classes = (array) $item->classes;
        $icon = '';

        foreach ($svg_icons as $class => $svg) {
            if (in_array($class, $classes)) {
                $icon = $svg;
                break;
            }
        }

        // Añade clases y abre el <li>
        $output .= '<li class="secondaryMenu__item' . ($icon ? ' snLink' : '') . '">';

        // Genera el contenido del enlace
        $output .= '<a href="' . esc_url($item->url) . '"';
        // Add target="_blank" if it's a social link
        if ($icon) {
            $output .= ' target="_blank"';
        }
        
        $output .= '>';
        $output .= $icon ? '<span>' . esc_html($item->title) . '</span>' . $icon : esc_html($item->title);
        $output .= '</a>';


        // Añade el número secuencial si no hay SVG
        if (!$icon) {
            $output .= '<span>' . str_pad($this->counter++, 2, '0', STR_PAD_LEFT) . '</span>';
        }

        // Cierra el <li>
        $output .= '</li>';
    }
}

/*------------------------------------*\
    Custom Navigation Functions
\*------------------------------------*/

// Display Main Navigation
function mostay_main_nav() {
    if (has_nav_menu('header-menu')) {
        wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'container'      => false,
            'menu_class'     => 'mainMenu',
            'walker'         => new Mostay_Main_Nav_Walker(),
        ));
    } else {
        echo '<p>' . __('Please assign a menu to the header menu location in the admin panel.', 'mostay') . '</p>';
    }
}

// Display Secondary Navigation
function mostay_secondary_nav() {
    if (has_nav_menu('secondary-menu')) {
        wp_nav_menu(array(
            'theme_location' => 'secondary-menu',
            'container'      => false,
            'menu_class'     => 'secondaryMenu',
            'walker'         => new Secondary_Menu_Walker(),
        ));
    } else {
        echo '<p>' . __('Please assign a menu to the secondary menu location in the admin panel.', 'mostay') . '</p>';
    }
}

/*------------------------------------*\
    Enqueue Scripts and Styles
\*------------------------------------*/

// Load mostay scripts (header.php)
function mostay_enqueue_header_assets()
{
    if (!is_admin()) {
        //wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jQuery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.7.1', $in_footer = true); // jQuery
        wp_enqueue_script('jQuery'); // Enqueue it!
        wp_register_script('fontawesome', 'https://use.fontawesome.com/fe56756232.js', array(), '5.10.2', $in_footer = true); // fontawesome
        wp_enqueue_script('fontawesome'); // Enqueue it!

        // Only load Slick if it's needed
        if (is_front_page() || is_page(13) || is_page(71) || is_archive()) {
            wp_register_script('slick', get_template_directory_uri() . '/slick/slick.min.js', array(), '1.8.0', true); // slick
            wp_enqueue_script('slick'); // Enqueue it!
        }

        wp_register_script('bodyScrollLock', get_template_directory_uri() . '/js/bodyScrollLock.min.js', array(), '1.0.0', $in_footer = true); // bodyScrollLock
        wp_enqueue_script('bodyScrollLock'); // Enqueue it!
        wp_register_script('mostayscripts', get_template_directory_uri() . '/js/script-min.js', array(), '1.0.0', $in_footer = true); // Custom scripts
        wp_enqueue_script('mostayscripts'); // Enqueue it!
    }
}
/**
 * Enqueue theme styles.
 *
 * Registers and enqueues the theme's stylesheets, including custom styles and third-party styles like Slick.
 * It also ensures that Slick's stylesheet is only loaded if the Slick script is loaded.
 */
// Load mostay styles
function mostay_enqueue_styles()
{
    // Only load Slick style if the script is loaded
    if (is_front_page() || is_page(13) || is_page(71) || is_archive()) {
        wp_register_style('slick', get_template_directory_uri() . '/slick/slick.css', array(), '1.0', 'all');
        wp_enqueue_style('slick');
    }
    wp_register_style('googlefonts', 'https://fonts.googleapis.com/css?family=Bree+Serif|Roboto+Slab|Roboto:300,400,700&display=swap', array(), '1.0', 'all');
    wp_enqueue_style('googlefonts'); // Enqueue it!
    wp_register_style('mostaystyles', get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all');
    wp_enqueue_style('mostaystyles'); // Enqueue it!
}

/*------------------------------------*\
    Custom Navigation Functions
\*------------------------------------*/

// Register mostay Navigations
function register_mostay_menu()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu', 'mostay'), // Main Navigation
            'side-menu' => __('Sidebar Menu', 'mostay'), // Sidebar Navigation
            // 'footer-menu' => __('Footer Menu', 'mostay') // Extra Navigation if needed (duplicate as many as you need!)
        )
    );
}

// Register secondary menu
function register_mostay_secondary_menus() {
    register_nav_menus([
        'secondary-menu' => __('Secondary Menu'),
    ]);
}

/**
 * Modifies the arguments for the wp_nav_menu function.
 *
 * This function removes the default container (div) that surrounds the dynamic navigation menu,
 * resulting in cleaner markup.
 *
 * @param array $args An array of wp_nav_menu() arguments.
 *
 * @return array The modified array of arguments.
 */
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

/*------------------------------------*\
    Widget functions
\*------------------------------------*/

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')){
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'mostay'),
        'description' => __('Description for this widget-area...', 'mostay'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'mostay'),
        'description' => __('Description for this widget-area...', 'mostay'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

/*------------------------------------*\
    Pagination
\*------------------------------------*/

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function mostay_display_pagination() {
    global $wp_query;
    // Check if there is more than one page
    if ($wp_query->max_num_pages > 1) {
        $big = 999999999; // need an unlikely integer
        $pages = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => __('Atrás'),
            'next_text' => __('Siguiente'),
            'type' => 'array',
        ));
        if (is_array($pages)) {
            echo '<ul class="pagination">';
            foreach ($pages as $page) {
                echo "<li>$page</li>";
            }
            echo '</ul>';
        }
    }
}

/*------------------------------------*\
    Custom functions
\*------------------------------------*/

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'mostay_enqueue_header_assets'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'mostay_enqueue_styles'); // Add Theme Stylesheet
add_action('init', 'register_mostay_menu'); // Add mostay Menu
add_action('init', 'register_mostay_secondary_menus'); // Add secondary Menu
add_action('init', 'mostay_display_pagination'); // Add our mostay Pagination
add_action('init', 'my_custom_posttypes' ); //Mostay Custon Posttypes
add_action('init', 'my_custom_taxonomies' ); //Mostay Custon Taxonomies
add_action( 'init', 'mostay_load_theme_textdomain' );

// Remove unnecessary actions
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version

// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
//add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 99);


/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

function my_custom_posttypes() {
    // Proyectos Post Types
    $labels = array(
        'name'               => 'Proyectos',
        'singular_name'      => 'Proyecto',
        'menu_name'          => 'Proyectos',
        'name_admin_bar'     => 'Proyecto',
        'add_new'            => 'Crear',
        'add_new_item'       => 'Crear Proyecto',
        'new_item'           => 'Nuevo Proyecto',
        'edit_item'          => 'Editar Proyecto',
        'view_item'          => 'Ver los Proyecto',
        'all_items'          => 'Todos los Proyectos',
        'search_items'       => 'Buscar Proyectos',
        'parent_item_colon'  => 'Proyectos Padre:',
        'not_found'          => 'Ningún Proyecto Encontrado.',
        'not_found_in_trash' => 'Ningún Proyecto encontrado en la Papelera.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-buddicons-replies',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'proyectos' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );
    register_post_type('proyectos', $args);
}

function my_rewrite_flush() {
    my_custom_posttypes();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'my_rewrite_flush');

//Changing Admin Menu Labels
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Mostay';
    $submenu['edit.php'][5][0] = 'Mostay';
    $submenu['edit.php'][10][0] = 'Agregar Nuevo';
    $submenu['edit.php'][15][0] = 'Categorias'; // Change name for categories
    $submenu['edit.php'][16][0] = 'Etiquetas'; // Change name for tags
    echo '';
}
function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Mostay';
        $labels->singular_name = 'Mostay';
        $labels->add_new = 'Add New';
        $labels->add_new_item = 'Add Mostay';
        $labels->edit_item = 'Edit Mostay';
        $labels->new_item = 'New Mostay';
        $labels->view_item = 'View Mostay';
        $labels->search_items = 'Search Mostay';
        $labels->not_found = 'No Mostay found';
        $labels->not_found_in_trash = 'No Mostay found in Trash';
    }

flush_rewrite_rules();

/*------------------------------------*\
         Custom Taxonomies
\*------------------------------------*/


function my_custom_taxonomies() {
    // Categoria taxonomy (non-hierarchical)
    $labels = array(
      'name'                       => 'Categorías',
      'singular_name'              => 'Categoría',
      'search_items'               => 'Buscar Categorías',
      'popular_items'              => 'Categorías Populares',
      'all_items'                  => 'Todas las Categorías',
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => 'Editar Categoría',
      'update_item'                => 'Actualizar Categoría',
      'add_new_item'               => 'Crear Categoría',
      'new_item_name'              => 'Nuevo Nombre de Categoría',
      'separate_items_with_commas' => 'Separar categorías con comas',
      'add_or_remove_items'        => 'Crear o Eliminar Categorías',
      'choose_from_most_used'      => 'Seleccionar la categoría mas usada',
      'not_found'                  => 'Ninguna Categoría Encontrada.',
      'menu_name'                  => 'Categorías',
    );

    $args = array(
      'hierarchical'          => true,
      'labels'                => $labels,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
      'rewrite'               => array( 'slug' => 'categorias' ),
    );

    register_taxonomy( 'categorias', array( 'proyectos' ), $args );


}


//General Custom Fields
$new_general_setting = new new_general_setting();

class new_general_setting {
  function new_general_setting( ) {
      add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
  }
  function register_fields() {
      register_setting( 'general', 'company_phone', 'esc_attr' );
      add_settings_field('comp_phone', '<label for="company phone">'.__('company phone' , 'company_phone' ).'</label>' , array(&$this, 'fields_html') , 'general' );
      register_setting( 'general', 'company_email', 'esc_attr' );
      add_settings_field('comp_email', '<label for="company email">'.__('company email' , 'company_email' ).'</label>' , array(&$this, 'fields_html1') , 'general' );
      register_setting( 'general', 'facebook', 'esc_attr' );
      add_settings_field('faceb', '<label for="facebook">'.__('Facebook' , 'facebook' ).'</label>' , array(&$this, 'fields_html2') , 'general' );
      register_setting( 'general', 'instagram', 'esc_attr' );
      add_settings_field('insta', '<label for="instagram">'.__('instagram' , 'instagram' ).'</label>' , array(&$this, 'fields_html3') , 'general' );
      register_setting( 'general', 'youtube', 'esc_attr' );
      add_settings_field('you', '<label for="youtube">'.__('YouTube' , 'youtube' ).'</label>' , array(&$this, 'fields_html4') , 'general' );
      register_setting( 'general', 'linkedin', 'esc_attr' );
      add_settings_field('linkedin', '<label for="linkedin">'.__('LinkedIn' , 'linkedin' ).'</label>' , array(&$this, 'fields_html5') , 'general' );
      register_setting( 'general', 'twitter', 'esc_attr' );
      add_settings_field('twitter', '<label for="twitter">'.__('Twitter' , 'twitter' ).'</label>' , array(&$this, 'fields_html6') , 'general' );
  }
  function fields_html() {
      $value = get_option( 'company_phone', '' );
      echo '<input type="text" id="company_phone" name="company_phone" value="' . esc_attr($value) . '" />';
  }
  function fields_html1() {
      $value = get_option( 'company_email', '' );
      echo '<input type="text" id="company_email" name="company_email" value="' . esc_attr($value) . '" />';
  }
  function fields_html2() {
      $value2 = get_option( 'facebook', '' );
      echo '<input type="text" id="facebook" name="facebook" value="' . esc_attr($valu2) . '" />';
  }
  function fields_html3() {
      $value3 = get_option( 'instagram', '' );
      echo '<input type="text" id="instagram" name="instagram" value="' . esc_attr($value3) . '" />';
  }
  function fields_html4() {
      $value4 = get_option( 'youtube', '' );
      echo '<input type="text" id="youtube" name="youtube" value="' . esc_attr($value4) . '" />';
  }
  function fields_html5() {
      $value5 = get_option( 'linkedin', '' );
      echo '<input type="text" id="linkedin" name="linkedin" value="' . esc_attr($value5) . '" />';
  }
  function fields_html6() {
      $value6 = get_option( 'twitter', '' );
      echo '<input type="text" id="twitter" name="twitter" value="' . esc_attr($value6) . '" />';
  }
}

// **************** Auhor Info ****************
function edit_contactmethods( $contactmethods ) {
  $contactmethods['title'] = 'title';
  $contactmethods['facebook'] = 'Facebook';
  $contactmethods['twitter'] = 'Twitter';
  $contactmethods['youtube'] = 'YouTube';
  $contactmethods['instagram'] = 'Instagram';
  $contactmethods['linkedin'] = 'LinkedIn';
  $contactmethods['behance'] = 'Behance';
  $contactmethods['dribbble'] = 'Dribbble';
  return $contactmethods;
}
add_filter('user_contactmethods','edit_contactmethods',10,1);

// **************** Add class to next btn ****************
function posts_link_next_class($format){
     $format = str_replace('href=', 'class="btn" href=', $format);
     return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="btn" href=', $format);
     return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');

// remove permalink problem

remove_filter('template_redirect', 'redirect_canonical');

// Security

function add_security_headers() {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'Strict-Transport-Security: max-age=10886400' );
}
add_action( 'send_headers', 'add_security_headers' );

// Add Page Excerpt support
add_post_type_support( 'page', 'excerpt' );


// Get Image
function mostay_imagen($tipo = 'normal', $post_id = null, $acf_campo = 'mi_imagen') {
    if (!$post_id) {
        $post_id = get_the_ID(); 
    }

    if ($tipo === 'hero') {
        $imagen_id = get_post_thumbnail_id($post_id);
        $size_default = 'hero-lg';
        $size_srcset = 'hero-xl';
        $sizes = "(max-width: 700px) 480px, 
                  (max-width: 1024px) 800px, 
                  (max-width: 1440px) 1920px, 
                  3840px";
    } else {
        $imagen = function_exists('get_field') ? get_field($acf_campo, $post_id) : null;
        $imagen_id = $imagen ? $imagen['ID'] : null;
        $size_default = 'large';
        $size_srcset = 'xlarge';
        $sizes = "(max-width: 700px) 480px, 
                  (max-width: 1024px) 800px, 
                  (max-width: 1440px) 1920px, 
                  3840px";
    }

    if (!$imagen_id) return;

    $image_url = wp_get_attachment_image_url($imagen_id, $size_default);
    $image_srcset = wp_get_attachment_image_srcset($imagen_id, $size_srcset);

    if ($image_url && $image_srcset) {
        echo '<img src="' . esc_url($image_url) . '" 
                    srcset="' . esc_attr($image_srcset) . '" 
                    sizes="' . esc_attr($sizes) . '" 
                    alt="' . esc_attr(get_the_title($post_id)) . '">';
    }
    /**
     * Remove shortlink from head and HTTP header.
     */
    add_action('after_setup_theme', 'remove_shortlink');
    function remove_shortlink() {
        // remove HTML meta tag
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);
        // remove HTTP header
        remove_action( 'template_redirect', 'wp_shortlink_header', 11);
    }
} ?>