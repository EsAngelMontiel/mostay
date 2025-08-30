<?php /* Template Name: Gracias */
get_header();
if (have_posts()): while (have_posts()) : the_post();
$main_img = get_the_post_thumbnail_url(get_the_ID(),'large');
$main_cover = get_the_post_thumbnail_url(get_the_ID(),'medium');
$video = get_field('el_contenedor_video_cover');
?>



<!-- ********************** resumen de posts ********************** -->
<section class="services">
  <div class="cover">
    <div class="hero__video">
      <?php
        if ($video): ?>
        <video autoplay muted loop playsinline>
            <source src="<?php echo esc_url($video['url']); ?>" type="<?php echo esc_attr($video['mime_type']); ?>">
            Tu navegador no soporta la etiqueta de video.
        </video>
        <?php else: ?>
        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php echo $main_img ; ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>
        <?php endif; ?>
    </div>
  </div>

  <div class="container service-header elcontenedor">
    <div></div>
    <div>
    <h1><?php the_title(); ?></h1>
      <p><?php the_content(); ?></p>
    </div>
  </div>
  
</section>

<?php endwhile; ?>
<?php else: ?>
<article>
       <h2></h2>
</article>
<?php endif; ?>

<?php get_cta(); ?> 



<?php get_footer(); ?>
