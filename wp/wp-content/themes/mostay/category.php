<?php /* Template Name: Blog List */
get_header();
// Aquí ya NO va el if (have_posts()): while (have_posts()) : the_post(); de la página en sí.
// Nos enfocamos directamente en la sección del blog que lista los artículos.
?>

<section class="blog">
  <h1 class="titulo-oculto">Blog</h1>
    <?php
      // ********** INICIO: Modificación de la Query Principal **********
      // Define el tipo de post para esta página (entradas de blog)
      $query_post_type = 'post';

      // Obtiene el número de página actual. Esencial para la paginación.
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

      $current_term = get_queried_object(); // Obtiene el objeto de la taxonomía actual (en este caso, la etiqueta)

      // Argumentos para la consulta de WordPress (WP_Query)
      $args = array(
        'post_type'      => $query_post_type, // Tipo de contenido: 'post' para el blog
        'posts_per_page' => 8,                 // Número de artículos por página
        'order'          => 'DESC',            // Orden descendente
        'paged'          => $paged,            // Página actual
        'post_status'    => 'publish',         // Solo posts publicados
        'tax_query'      => array(             // Añade la consulta de taxonomía
            array(
                'taxonomy' => $current_term->taxonomy,
                'field'    => 'term_id',
                'terms'    => $current_term->term_id,
            ),
        ),
      );

      // Crea una nueva instancia de WP_Query
      $main_query = new WP_Query($args);
      // ********** FIN: Modificación de la Query Principal **********
    ?>
    <ul id="posts-container" class="blog-posts-list"> 
      <?php
        // Verifica si hay posts para mostrar
        if ($main_query->have_posts()) :
            while ($main_query->have_posts()) : $main_query->the_post();
            // ********** INICIO: Estructura HTML de un Artículo de Blog **********
            // Este HTML debe ser IDÉNTICO al que generas en la función mostay_load_more_posts()
            // en functions.php cuando $post_type es 'post'.
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumb' );
            $url = $thumb ? esc_url($thumb[0]) : ''; // Asegura que $url sea seguro y no nulo
            $my_date01 = get_the_date( 'j F, Y', '', '', false );
            $my_date02 = get_the_date( 'Y-m-d', '', '', false );
          ?>
            <li>
              <article class="blog-post">
                <a href="<?php the_permalink(); ?>">
                  <?php if ($url): ?>
                      <img src="<?php echo $url; ?>" alt="<?php the_title_attribute(); ?>">
                  <?php endif; ?>
                </a>
                <div>
                  <div class="post-info">
                    <time datetime="<?php echo esc_attr($my_date02) ; ?>"><i class="fas fa-calendar-alt"></i> <?php echo esc_html($my_date01) ; ?></time>
                    <span class="reading-t"><i class="fas fa-stopwatch"></i> <?php echo do_shortcode('[rt_reading_time label="Lectura:" postfix="minutos." postfix_singular="minuto."]'); ?></span>
                  </div>
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>">Leer mas <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </article>
            </li>
          <?php
            endwhile; // Fin del bucle while
        else: // Si no hay posts
          ?>
            <li><p>No se encontraron entradas de blog.</p></li>
          <?php
        endif; // Fin del if ($main_query->have_posts())
        ?>
    </ul>
    <?php
    // Solo muestra el botón "Cargar más" si hay más posts de los que se muestran inicialmente.
    if ( $main_query->max_num_pages > $paged ) :
    ?>
        <div class="load-more-wrapper" style="text-align: center; margin-top: 30px; margin-bottom: 30px;">
            <button id="load-more-button"
                    class="btn"
                    data-paged="<?php echo esc_attr( $paged ); ?>"
                    data-max-pages="<?php echo esc_attr( $main_query->max_num_pages ); ?>"
                    data-post-type="<?php echo esc_attr( $query_post_type ); ?>"
                    data-taxonomy="<?php echo esc_attr( $current_term->taxonomy ); ?>"
                    data-taxonomy-id="<?php echo esc_attr( $current_term->term_id ); ?>">
                Cargar más artículos
            </button>
            <div id="load-more-preloader" class="mostay-preloader">
            </div>
        </div>
    <?php
    endif; // ********** FIN: Botón "Cargar más" y Preloader ********** ?>
    

    <?php
    // wp_reset_postdata() es crucial después de una WP_Query personalizada para restaurar los datos del post global.
    wp_reset_postdata();
    ?>
    </section>

<?php get_cta(); ?>

<?php get_footer(); ?>
