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
  <section class="project" data-animate="fade-in">
    <article>
      <div class="cover" data-animate="slide-up">
        <div>
          <?php mostay_imagen('hero'); ?>
        </div>
      </div>

      <div class="container" data-animate="fade-in">
        <div class="contenido">
          <div class="left-column" data-animate="slide-left">
            <h1 data-animate="typing"><?php the_title(); ?></h1>
          </div>
          <div class="right-column">
          </div>
        </div>
        <div class="contenido">
          <div class="left-column" data-animate="slide-left">
            <?php if (!empty($frase)) : ?>
              <h2 data-animate="fade-in"><?php echo esc_html($frase); ?></h2>
            <?php endif; ?>
            <div class="datos" data-animate="stagger">
              <div class="categoria" data-stagger-item>
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
                <div class="rubro" data-stagger-item>
                  <h4>Industria</h4>
                  <p><?php echo esc_html($rubro); ?></p>
                </div>
              <?php endif; ?>
              <div class="year" data-stagger-item>
                <h4>Año</h4>
                <p><?php echo get_the_date('Y'); ?>
                </p>
              </div>
            </div>
            
            
          </div>
          <div class="right-column" data-animate="slide-right">
            <div data-animate="fade-in"><?php the_field('introduccion'); ?></div>
          </div>
        </div>
      </div>

      <div class="galeria" data-animate="fade-in">
        <div data-animate="fade-in"><?php the_content(); ?></div>
      </div>

    </article>
  </section>

  

<?php endwhile; ?>
<?php else: ?>
<?php endif; ?>

<?php get_cta(); ?> 
<?php get_footer(); ?>
