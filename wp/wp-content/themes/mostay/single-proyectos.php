<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php
$post_id = get_the_ID();

// Frase
$frase = get_field('frase_descriptiva', $post_id);

// Rubro
$rubro = get_field('rubro', $post_id);

// links
$behance = get_field('behance', $post_id);


?>


  <!-- ********************** resumen de posts ********************** -->
  <section class="project">
    <article>
      <div class="cover">
        <div>
          <?php mostay_imagen('hero'); ?>
        </div>
      </div>

      <div class="container">
        <div class="contenido">
          <div class="left-column">
            <h1><?php the_title(); ?></h1>
          </div>
          <div class="right-column">
          </div>
        </div>
        <div class="contenido">
          <div class="left-column">
            <?php if (!empty($frase)) : ?>
              <h2><?php echo esc_html($frase); ?></h2>
            <?php endif; ?>
            <div class="datos">
              <div class="categoria">
                <h4>Servicio</h4>
                <?php
                $terms = wp_get_post_terms($post_id, 'categorias');
                if ($terms) {
                    $term = $terms[0]; 
                    echo '<a class="categoria" href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                }
                ?>
              </div>
              <?php if (!empty($rubro)) : ?>
                <div class="rubro">
                  <h4>Industria</h4>
                  <p><?php echo esc_html($rubro); ?></p>
                </div>
              <?php endif; ?>
              <div class="year">
                <h4>Año</h4>
                <p><?php echo get_the_date('Y'); ?>
                </p>
              </div>
            </div>
            
            
          </div>
          <div class="right-column">
            <?php echo wpautop(get_the_content()); ?>
          </div>
        </div>
      </div>

      <div class="galeria">

      <?php for ($i = 1; $i <= 10; $i++) : ?>
    <?php 
    $grupo = get_field('imagenes_' . $i, $post_id);
    if ($grupo) {
        $imagen = isset($grupo['img_' . $i]) ? $grupo['img_' . $i] : null;
        $video = isset($grupo['vid_' . $i]) ? $grupo['vid_' . $i] : null;
        $tiene_video = is_array($video) && !empty($video['url']);
        $tiene_imagen = is_array($imagen) && !empty($imagen['sizes']['large']);

        if ($tiene_video || $tiene_imagen): ?>
            <div class="media">
                <?php if ($tiene_video): ?>
                    <video autoplay loop muted playsinline>
                        <source src="<?php echo esc_url($video['url']); ?>" type="<?php echo esc_attr($video['mime_type']); ?>">
                        Tu navegador no soporta la etiqueta de video.
                    </video>
                <?php elseif ($tiene_imagen): ?>
                    <img 
                        src="<?php echo esc_url($imagen['sizes']['large']); ?>" 
                        srcset="
                            <?php echo esc_url($imagen['sizes']['medium']); ?> 768w, 
                            <?php echo esc_url($imagen['sizes']['large']); ?> 1024w, 
                            <?php echo isset($imagen['sizes']['xlarge']) ? esc_url($imagen['sizes']['xlarge']) . ' 1920w' : ''; ?>" 
                        sizes="(max-width: 768px) 768w, 
                               (max-width: 1024px) 1024w, 
                               1920w"
                        alt="<?php echo esc_attr($imagen['alt']); ?>">
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php } ?>
<?php endfor; ?>


      </div>

    </article>
  </section>

  

<?php endwhile; ?>
<?php else: ?>
<?php endif; ?>

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
