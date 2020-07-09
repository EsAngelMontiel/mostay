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

if (!isset($content_width)){ $content_width = 1170 ;}

if (function_exists('add_theme_support')){
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 1920, 1080, true); // Large Thumbnail
    add_image_size('medium', 1200, 600, true); // Medium Thumbnail
    add_image_size('small', 500, 500, true); // Small Thumbnail
    add_image_size('cover-project', 1200, '', false); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    add_image_size('cover-size', 1200, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('mostay', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

// mostay main navigation
function mostay_main_nav(){
    wp_nav_menu(array(
        'theme_location'  => 'header-menu',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'main-menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}

// mostay footer navigation
// function mostay_footer_nav(){
//     wp_nav_menu(array(
//         'theme_location'  => 'footer-menu',
//         'menu'            => '',
//         'container'       => '',
//         'container_class' => '',
//         'container_id'    => '',
//         'menu_class'      => 'footer-menu',
//         'menu_id'         => '',
//         'echo'            => true,
//         'fallback_cb'     => 'wp_page_menu',
//         'before'          => '',
//         'after'           => '',
//         'link_before'     => '',
//         'link_after'      => '',
//         'items_wrap'      => '<ul>%3$s</ul>',
//         'depth'           => 0,
//         'walker'          => ''
//         )
//     );
// }

// mostay footer navigation
function mostay_side_nav(){
    wp_nav_menu(array(
          'theme_location'  => 'side-menu',
          'menu'            => '',
          'container'       => false,
          'container_class' => '',
          'container_id'    => '',
          'menu_class'      => 'side-menu',
          'menu_id'         => '',
          'echo'            => true,
          'fallback_cb'     => 'wp_page_menu',
          'before'          => '',
          'after'           => '',
          'link_before'     => '',
          'link_after'      => '',
          'items_wrap'      => '%3$s',
          'depth'           => 0,
          'walker'          => ''
        )
    );
}

// Load mostay scripts (header.php)
function mostay_header_scripts(){
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jQuery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.4.1', $in_footer = true); // jQuery
        wp_enqueue_script('jQuery'); // Enqueue it!
        wp_register_script('fontawesome', 'https://use.fontawesome.com/fe56756232.js', array(), '5.10.2', $in_footer = true); // fontawesome
        wp_enqueue_script('fontawesome'); // Enqueue it!
        wp_register_script('slick', get_template_directory_uri() . '/slick/slick.min.js', array(), '1.8.0', $in_footer = true); // slick
        wp_enqueue_script('slick'); // Enqueue it!
        wp_register_script('mostayscripts', get_template_directory_uri() . '/js/script-min.js', array(), '1.0.0', $in_footer = true); // Custom scripts
        wp_enqueue_script('mostayscripts'); // Enqueue it!
    }
}

// Load mostay styles
function mostay_styles(){
  wp_register_style('slick', get_template_directory_uri() . '/slick/slick.css', array(), '1.0', 'all');
  wp_enqueue_style('slick'); // Enqueue it!
  wp_register_style('mostaystyles', get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all');
  wp_enqueue_style('mostaystyles'); // Enqueue it!
}

// Register mostay Navigations
function register_mostay_menu(){
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'mostay'), // Main Navigation
        'side-menu' => __('Sidebar Menu', 'mostay'), // Sidebar Navigation
        // 'footer-menu' => __('Footer Menu', 'mostay') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
// Revisar funcionamiento
function my_wp_nav_menu_args($args = ''){
    $args['container'] = false;
    return $args;
}

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

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function mostay_pagination(){
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'prev_next' => false,
        'type'  => 'array',
        'prev_next'   => TRUE,
        'prev_text'    => __('Atrás'),
        'next_text'    => __('Siguiente'),
    ) );
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<ul class="pagination">';
        foreach ( $pages as $page ) {
                echo "<li>$page</li>";
        }
       echo '</ul>';
    }
}

// Remove Admin bar (Active if is necessary)
/*function remove_admin_bar(){
    return false;
}*/


/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'mostay_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'mostay_styles'); // Add Theme Stylesheet
add_action('init', 'register_mostay_menu'); // Add mostay Menu
add_action('init', 'mostay_pagination'); // Add our mostay Pagination
add_action('init', 'my_custom_posttypes' ); //Mostay Custon Posttypes
add_action('init', 'my_custom_taxonomies' ); //Mostay Custon Taxonomies
// add_action( 'init', 'change_post_object_label' ); //Change post Name
// add_action( 'admin_menu', 'change_post_menu_label' ); //Change post Name
// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
//add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar


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
    register_post_type('proyectos', $args );
    flush_rewrite_rules();

    // Nosotros Post Types
    $labels = array(
        'name'               => 'Casos',
        'singular_name'      => 'Caso',
        'menu_name'          => 'Casos',
        'name_admin_bar'     => 'Casos',
        'add_new'            => 'Crear',
        'add_new_item'       => 'Crear Casos',
        'new_item'           => 'Nuevo Caso',
        'edit_item'          => 'Edit Casos',
        'view_item'          => 'Ver Casos',
        'all_items'          => 'Todos los Casos',
        'search_items'       => 'Buscar Caso',
        'parent_item_colon'  => 'Caso Padre:',
        'not_found'          => 'Ningún Caso entontrado.',
        'not_found_in_trash' => 'Ningún caso encontrado en la papelera.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-visibility',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'casos' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );
    register_post_type('casos', $args );
    flush_rewrite_rules();
}

function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry,
    // when you add a post of this CPT.
    my_custom_posttypes();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );

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
      'rewrite'               => array( 'slug' => 'categorias2' ),
    );

    register_taxonomy( 'categorias2', array( 'casos' ), $args );

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
      echo '<input type="text" id="company_phone" name="company_phone" value="' . $value . '" />';
  }
  function fields_html1() {
      $value = get_option( 'company_email', '' );
      echo '<input type="text" id="company_email" name="company_email" value="' . $value . '" />';
  }
  function fields_html2() {
      $value2 = get_option( 'facebook', '' );
      echo '<input type="text" id="facebook" name="facebook" value="' . $value2 . '" />';
  }
  function fields_html3() {
      $value3 = get_option( 'instagram', '' );
      echo '<input type="text" id="instagram" name="instagram" value="' . $value3 . '" />';
  }
  function fields_html4() {
      $value4 = get_option( 'youtube', '' );
      echo '<input type="text" id="youtube" name="youtube" value="' . $value4 . '" />';
  }
  function fields_html5() {
      $value5 = get_option( 'linkedin', '' );
      echo '<input type="text" id="linkedin" name="linkedin" value="' . $value5 . '" />';
  }
  function fields_html6() {
      $value6 = get_option( 'twitter', '' );
      echo '<input type="text" id="twitter" name="twitter" value="' . $value6 . '" />';
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
  // unset($contactmethods['yim']);
  // unset($contactmethods['aim']);
  // unset($contactmethods['jabber']);
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

?>
