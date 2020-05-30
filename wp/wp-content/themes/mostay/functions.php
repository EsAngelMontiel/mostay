<?php
/*
 *  Author: Mostay C.A | @mostay.co
 *  URL: www.mostay.co | @mostay.co
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
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

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
function mostay_footer_nav(){
    wp_nav_menu(array(
        'theme_location'  => 'footer-menu',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'footer-menu',
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
/*function mostay_side_nav(){
    wp_nav_menu(array(
        'theme_location'  => 'side-menu',
        'menu'            => '',
        'container'       => '',
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
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}*/

// Load mostay scripts (header.php)
function mostay_header_scripts(){
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jQuery', get_template_directory_uri() . '/js/jquery.min.js', array(), '1.9.0', $in_footer = true); // jQuery
        wp_enqueue_script('jQuery'); // Enqueue it!
        wp_register_script('fontawesome', 'https://use.fontawesome.com/releases/v5.10.2/js/all.js', array(), '5.10.2', $in_footer = true); // fontawesome
        wp_enqueue_script('fontawesome'); // Enqueue it!
        wp_register_script('mostayscripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', $in_footer = true); // Custom scripts
        wp_enqueue_script('mostayscripts'); // Enqueue it!
    }
}

// Load mostay styles
function mostay_styles(){
    wp_register_style('mostaystyles', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('mostaystyles'); // Enqueue it!
}

// Register mostay Navigations
function register_mostay_menu(){
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'mostay'), // Main Navigation
        //'side-menu' => __('Sidebar Menu', 'mostay'), // Sidebar Navigation
        'footer-menu' => __('Footer Menu', 'mostay') // Extra Navigation if needed (duplicate as many as you need!)
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
        'prev_text'    => __('«'),
        'next_text'    => __('»'),
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
//add_action('init', 'my_custom_taxonomies' ); //Mostay Custon Taxonomies
add_action( 'init', 'change_post_object_label' ); //Change post Name
add_action( 'admin_menu', 'change_post_menu_label' ); //Change post Name
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
    // Productos Post Types
    $labels = array(
        'name'               => 'Productos',
        'singular_name'      => 'Producto',
        'menu_name'          => 'Productos',
        'name_admin_bar'     => 'Producto',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Producto',
        'new_item'           => 'New Producto',
        'edit_item'          => 'Edit Producto',
        'view_item'          => 'View Producto',
        'all_items'          => 'All Productos',
        'search_items'       => 'Search Productos',
        'parent_item_colon'  => 'Parent Productos:',
        'not_found'          => 'No Productos found.',
        'not_found_in_trash' => 'No Productos found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-cart',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'taxs' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'         => array( 'category', 'post_tag' )
    );
    register_post_type('producto', $args );
    flush_rewrite_rules();

    // Nosotros Post Types
    $labels = array(
        'name'               => 'Nosotros',
        'singular_name'      => 'Nosotros',
        'menu_name'          => 'Nosotros',
        'name_admin_bar'     => 'Nosotros',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Nosotros',
        'new_item'           => 'New Nosotros',
        'edit_item'          => 'Edit Nosotros',
        'view_item'          => 'View Nosotros',
        'all_items'          => 'All Nosotros',
        'search_items'       => 'Search Nosotros',
        'parent_item_colon'  => 'Parent Nosotros:',
        'not_found'          => 'No Nosotro found.',
        'not_found_in_trash' => 'No Nosotros found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-store',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'taxs' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'         => array( 'category', 'post_tag' )
    );
    register_post_type('nosotros', $args );
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

/*
function my_custom_taxonomies() {
    // Type of Product/Service taxonomy
    $labels = array(
        'name'              => 'Type of Products/Services',
        'singular_name'     => 'Type of Product/Service',
        'search_items'      => 'Search Types of Products/Services',
        'all_items'         => 'All Types of Products/Services',
        'parent_item'       => 'Parent Type of Product/Service',
        'parent_item_colon' => 'Parent Type of Product/Service:',
        'edit_item'         => 'Edit Type of Product/Service',
        'update_item'       => 'Update Type of Product/Service',
        'add_new_item'      => 'Add New Type of Product/Service',
        'new_item_name'     => 'New Type of Product/Service Name',
        'menu_name'         => 'Type of Product/Service',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-types' ),
    );

    register_taxonomy( 'product-type', array( 'taxs' ), $args );


     // Mood taxonomy (non-hierarchical)
    $labels = array(
        'name'                       => 'Moods',
        'singular_name'              => 'Mood',
        'search_items'               => 'Search Moods',
        'popular_items'              => 'Popular Moods',
        'all_items'                  => 'All Moods',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit Mood',
        'update_item'                => 'Update Mood',
        'add_new_item'               => 'Add New Mood',
        'new_item_name'              => 'New Mood Name',
        'separate_items_with_commas' => 'Separate moods with commas',
        'add_or_remove_items'        => 'Add or remove moods',
        'choose_from_most_used'      => 'Choose from the most used moods',
        'not_found'                  => 'No moods found.',
        'menu_name'                  => 'Moods',
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'moods' ),
    );

    register_taxonomy( 'mood', array( 'Taxs', 'post' ), $args );

}
*/
?>
