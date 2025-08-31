<?php get_header(); ?>

<?php mostay_display_hero(['post_id' => 101]); ?>
  <div class="hero__text" data-animate="slide-up">
      <h1 data-animate="typing">Nuestra misión es darle vida a tu marca.</h1>
      <h2 data-animate="fade-in"><strong>Un estudio de diseño de marca enfocado en el crecimiento de nuestros clientes:</strong> Creo que el diseño debe ser tanto funcional como estético; debe tener un propósito claro y estar al servicio de las necesidades de nuestros clientes y sus consumidores.</h2>
    </div>
</section>

<!-- ********************** portafolio ********************** -->
<section class="portafolio portafolio-home">
    <?php
    $argo = array(
        'post_type'      => 'proyectos',
        'posts_per_page' => 11,
        'order'          => 'DESC',
    );

    $the_query = new WP_Query($argo);

    if ($the_query->have_posts()) : ?>
        <ul id="ultimo" class="casos" data-animate="stagger">
            <?php while ($the_query->have_posts()) : $the_query->the_post();
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'hero-md');
                $url = $thumb ? esc_url($thumb[0]) : ''; // Verificación de la imagen
                $terms = wp_get_post_terms(get_the_ID(), 'categorias');
                ?>
                <li data-stagger-item>
                    <article class="trabajos-lista">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ($url): ?>
                                <img src="<?php echo $url; ?>" alt="Imagen del artículo">
                            <?php endif; ?>
                            <span>
                                <span>
                                    <?php if ($terms): ?>
                                        <h4><?php echo esc_html($terms[0]->name); ?></h4> <!-- Mostrar solo el primer término -->
                                    <?php endif; ?>
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo esc_html(get_field('frase_descriptiva')); ?></p> <!-- Campo ACF para descripción corta -->
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </span>
                        </a>
                    </article>
                </li>
            <?php endwhile; ?>

            <li class="portafolio-cta" data-stagger-item>
                <h3>Este no es nuestro <br>primer ruedo</h3>
                <p>Tenemos décadas de experiencia combinada desarrollando proyectos de diseño a nivel internacional.</p>
                <a href="<?php echo esc_url(get_page_link(71)); ?>" class="btn">Ver Todos</a>
            </li>
        </ul>
    <?php else: ?>
        <p>No se encontraron proyectos.</p>
    <?php endif; 
    wp_reset_postdata();
    ?>
</section>

<?php get_cta(); ?> 


<?php get_newsletter(); ?>







<?php get_footer(); ?>
