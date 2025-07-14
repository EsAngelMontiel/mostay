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
                    class="mostay-button"
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

<section class="cta-wrapper">
  <div class="container">
    <div class="cta">
      <div>
        <img src="<?php echo get_template_directory_uri(); ?>/img/cta.gif" alt="¿Quieres saber si Mostay es lo que tu marca necesita?">
      </div>
      <div>
        <h2>¿Quieres descubrir cómo Mostay puede transformar tu marca?</h2>
        <p>Tu historia merece ser contada de forma única. Estamos aquí para darle vida juntos. <strong>Escríbenos a nuestro WhatsApp para agendar una llamada introductoria de 15 minutos y descubre cómo podemos darle vida a tu proyecto.</strong></p>
        <a href="https://wa.me/34641747158" class="btn btn-whatsapp" target="_blank">
        ¿Cómo te podemos ayudar?
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
      </a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
