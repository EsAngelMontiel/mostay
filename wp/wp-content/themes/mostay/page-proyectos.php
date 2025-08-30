<?php /* Template Name: Project List */
get_header();
if (have_posts()): while (have_posts()) : the_post();
?>

<?php
$args = array(
    'post_type'      => 'proyectos',
    'posts_per_page' => -1,
    'order'          => 'DESC'
);
$project_query = new WP_Query($args);
?>

<!-- ********************** resumen de posts ********************** -->
<section class="portafolio" data-animate="fade-in">
    <h1 class="titulo-oculto" data-animate="typing">Portafolio</h1>
    <ul class="casos" data-animate="stagger">
        <?php
        if ($project_query->have_posts()) :
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
                                    if ($terms) {
                                        echo '<h4>' . esc_html($terms[0]->name) . '</h4>'; 
                                    }
                                    ?>
                                    <h3><?php the_title(); ?></h3>
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
        <?php else: ?>
            <li data-stagger-item><p>No se encontraron proyectos.</p></li>
        <?php endif; ?>
    </ul>
</section>

<?php
wp_reset_postdata(); 
endwhile; else: ?>
<article>
    <h2>No hay contenido disponible.</h2>
</article>
<?php endif; ?>



<?php get_cta(); ?> 

<?php get_footer(); ?>
