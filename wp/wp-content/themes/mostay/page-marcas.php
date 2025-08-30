<?php 
/**
 * Template Name: Marcas
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
                            'terms'    => 'branding',
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
                            <h3>Conoce las marcas<br>que hemos creado</h3>
                            <p>Tenemos mas de 15 años creando marcas para clientes de Latinoamérica y Estados Unidos.</p>
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
                    <h2><strong>Mediante nuestro proceso creativo</strong>, cuidamos cada aspecto de tu marca para crear una identidad impactante y coherente con tus objetivos.</h2>
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
                        <h2>Descubre todo lo que podemos hacer por tu marca.</h2>
                    </div>
                    <ul class="branding">
                        <li class="principal">
                            <p>Branding</p>
                        </li>
                        <li>
                            <p>Diseño de Logo</p>
                        </li>
                        <li>
                            <p>Identidad Visual</p>
                        </li>
                        <li>
                            <p>Naming</p>
                        </li>
                        <li>
                            <p>Manual de Marca</p>
                        </li>
                        <li>
                            <p>Aplicaciones de Marca</p>
                        </li>
                        <li>
                            <p>Diseño Tipográfico</p>
                        </li>
                    </ul>
                </div>

            </section>

        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e('Lo siento, no se han encontrado entradas.'); ?></p>
    <?php endif; ?>
 </main>

 <?php get_cta(); ?> 

<?php get_footer(); ?>