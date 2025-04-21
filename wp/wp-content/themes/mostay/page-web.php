<?php 
/**
 * Template Name: Web
 * Description: Descripción del servicio de Branding de Mostay.
 */
get_header(); ?>

<main>
    <?php if ( have_posts() ) : ?>  
        <?php while ( have_posts() ) : the_post(); ?>
            <section class="services">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- ******* Hero Cover ********* -->
                <?php 
                $cover = get_field('cover'); // Obtener el grupo "cover"

                $video = isset($cover['servicio_video']) ? $cover['servicio_video'] : '';
                $imagen = isset($cover['servicio_cover']) ? $cover['servicio_cover'] : '';
                ?>
                <div class="cover">
                    <div class="hero__video">
                        <?php if ($video): ?>
                            <video autoplay loop muted playsinline>
                                <source src="<?php echo esc_url($video['url']); ?>" type="<?php echo esc_attr($video['mime_type']); ?>">
                                Tu navegador no soporta la etiqueta de video.
                            </video>
                        <?php elseif ($imagen): ?>
                            <img src="<?php echo esc_url($imagen['sizes']['hero-lg']); ?>" 
                                srcset="
                                    <?php echo esc_url($imagen['sizes']['hero-md']); ?> 800w, 
                                    <?php echo esc_url($imagen['sizes']['hero-lg']); ?> 1920w, 
                                    <?php echo isset($imagen['sizes']['hero-xl']) ? esc_url($imagen['sizes']['hero-xl']) . ' 3840w' : ''; ?>"
                                sizes="(max-width: 700px) 800px, 
                                        (max-width: 1440px) 1920px, 
                                        3840px"
                                alt="<?php echo esc_attr(get_the_title()); ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ******* End Hero Cover ********* -->
                <!-- ******* Service Header ********* -->
                <div class="container service-header">
                    <div></div>
                    <div>
                    <h1><?php the_title(); ?></h1>
                    <?php echo wpautop(get_the_content()); ?>
                    </div>
                </div>
                <!-- ******* End Service Header ********* -->
                </article>
            </section>
            <!-- ********************** portafolio ********************** -->
            <section class="portafolio portafolio-home">
                <?php
                $argo = array(
                    'post_type'      => 'proyectos',
                    'posts_per_page' => 11,
                    'order'          => 'DESC',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'categorias',
                            'field'    => 'slug',
                            'terms'    => 'web',
                        ),
                    ),
                );

                $the_query = new WP_Query($argo);

                if ($the_query->have_posts()) : ?>
                    <ul id="ultimo" class="casos">
                        <?php while ($the_query->have_posts()) : $the_query->the_post();
                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'hero-md');
                            $url = $thumb ? esc_url($thumb[0]) : ''; // Verificación de la imagen
                            $terms = wp_get_post_terms(get_the_ID(), 'categorias');
                            ?>
                            <li>
                                <article class="trabajos-lista">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if ($url): ?>
                                            <img src="<?php echo $url; ?>" alt="Imagen del artículo">
                                        <?php endif; ?>
                                        <span>
                                            <span>
                                                <?php if ($terms): ?>
                                                    <h2><?php echo esc_html($terms[0]->name); ?></h2> <!-- Mostrar solo el primer término -->
                                                <?php endif; ?>
                                                <h1><?php the_title(); ?></h1>
                                                <p><?php echo esc_html(get_field('frase_descriptiva')); ?></p> <!-- Campo ACF para descripción corta -->
                                                <i class="fas fa-arrow-circle-right"></i>
                                            </span>
                                        </span>
                                    </a>
                                </article>
                            </li>
                        <?php endwhile; ?>

                        <li class="portafolio-cta">
                            <h3>Conoce los sitios web<br>que hemos creado</h3>
                            <p>Tenemos más de 15 años creando sitios web para clientes de Latinoamérica, Estados Unidos  y Europa.</p>
                            <a href="<?php echo esc_url(get_page_link(71)); ?>" class="btn">Ver Todos</a>
                        </li>
                    </ul>
                <?php else: ?>
                    <p>No se encontraron proyectos.</p>
                <?php endif; 
                wp_reset_postdata();
                ?>
            </section>
            <section class="process">
                <div class="frase">
                    <h2><strong>Estamos enfocados en crear sitios visualmente impactantes,</strong> y con una experiencia de usuario única.</h2>
                </div>
                <?php 
                $pasos = get_field('pasos'); // Obtener el grupo de ACF

                if ($pasos): ?>
                    <ol class="pasos">
                        
                        <?php for ($i = 1; $i <= 3; $i++) : ?>
                            <?php
                            $titulo = isset($pasos['titulo_paso_' . $i]) ? $pasos['titulo_paso_' . $i] : '';
                            $descripcion = isset($pasos['descripcion_paso_' . $i]) ? $pasos['descripcion_paso_' . $i] : '';
                            ?>
                            <?php if ($titulo && $descripcion) : ?>
                                <li>
                                    <article>
                                        <div>
                                            <span><?php echo $i; ?></span>
                                        </div>
                                        <div>
                                            <header>
                                                <h3><?php echo esc_html($titulo); ?></h3>
                                            </header>
                                            <?php echo wpautop($descripcion); ?> 
                                        </div>
                                    </article>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ol>
                <?php endif; ?>
            </section>
            <section class="services-list">
                <div class="container">
                    <div>
                        <h2>Descubre como podemos crear tu presencia online.</h2>
                    </div>
                    <ul class="web">
                        <li class="principal">
                            <p>Diseño Web</p>
                        </li>
                        <li>
                            <p>Diseño y Desarrollo de Sitios Web</p>
                        </li>
                        <li>
                            <p>Diseño de Landing Pages</p>
                        </li>
                        <li>
                            <p>Diseño de Apps</p>
                        </li>
                        <li>
                            <p>UX/UI Design</p>
                        </li>
                        <li>
                            <p>Prototipado y Testing</p>
                        </li>
                        <li>
                            <p>Webflow y Wordpress</p>
                        </li>
                    </ul>
                </div>

            </section>

        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e('Lo siento, no se han encontrado entradas.'); ?></p>
    <?php endif; ?>
 </main>

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
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
      </a>
      </div>
    </div>
  </div>
</section> 

<?php get_footer(); ?>