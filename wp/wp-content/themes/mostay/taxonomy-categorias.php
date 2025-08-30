<?php get_header();

// Get current term object to get the description
$term = get_queried_object();
$cat_description = term_description();

// WP_Query arguments to get projects from the current category
$args = array(
    'post_type'      => 'proyectos',
    'posts_per_page' => -1,
    'order'          => 'DESC',
    'tax_query'      => array(
        array(
            'taxonomy' => $term->taxonomy,
            'field'    => 'slug',
            'terms'    => $term->slug,
        ),
    ),
);

// The Query
$project_query = new WP_Query($args);
?>

<!-- ********************** resumen de posts ********************** -->
<section class="portafolio" data-animate="fade-in">
    <div class="titulo" data-animate="fade-in">
      <h1 data-animate="typing"><?php single_cat_title(); ?></h1>
      <?php 
      if (!empty($cat_description)) {
        echo '<div class="taxonomy-description" data-animate="fade-in">' . $cat_description . '</div>';
      }
      ?>
    </div>
    
    <?php if ($project_query->have_posts()) : ?>
        <ul class="casos" data-animate="stagger">
            <?php
            while ($project_query->have_posts()) : $project_query->the_post();
                $postid2 = get_the_ID();
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($postid2), 'hero-md');
                $url = $thumb ? $thumb[0] : ''; 
                $frase_descriptiva = get_field('frase_descriptiva', $postid2);
            ?>
                <li data-stagger-item>
                    <article class="trabajos-lista">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ($url): ?>
                                <img src="<?php echo esc_url($url); ?>" alt="Imagen del proyecto">
                            <?php endif; ?>
                            <span>
                                <span>
                                    <?php
                                    $terms = wp_get_post_terms($postid2, 'categorias');
                                    if (!empty($terms) && is_array($terms)) {
                                      echo '<h2>' . esc_html($terms[0]->name) . '</h2>'; 
                                    }
                                    ?>
                                    <h1><?php the_title(); ?></h1>
                                    <?php if ($frase_descriptiva): ?>
                                        <p><?php echo esc_html($frase_descriptiva); ?></p>
                                    <?php endif; ?>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </span>
                        </a>
                    </article>
                </li>
            <?php endwhile; ?>
        </ul>
        <?php wp_reset_postdata(); ?>
    <?php else: ?>
        <div class="container" data-animate="fade-in">
            <p>No se encontraron proyectos en esta categoría.</p>
        </div>
    <?php endif; ?>
</section>

<?php get_cta(); ?> 

<?php get_footer(); ?>