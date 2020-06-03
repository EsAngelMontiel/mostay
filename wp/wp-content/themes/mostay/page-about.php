<?php /* Template Name: About */
get_header();
if (have_posts()): while (have_posts()) : the_post();
$main_img = get_the_post_thumbnail_url(get_the_ID(),'cover-size');
?>

<section class="breadcrumb-espacio about">
  <div class="bc-img">
    <img src="<?php echo $main_img ; ?>" alt="<?php the_title(); ?>">
    <span class="bc-gradient"></span>
  </div>
</section>

<!-- ********************** resumen de posts ********************** -->
<section class="project">
  <article class="container">
    <div class="contenido">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </div>
  </article>
  <div class="btn-container">
    <a href="#" class="btn btn-blanco"><i class="fab fa-behance-square"></i> <span> Ver en Behance</span></a>
    <a href="#" class="btn btn-blanco"><i class="fas fa-envelope"></i><span> Envíame un Correo</span></a>
    <a href="#" class="btn btn-blanco"><i class="fab fa-instagram"></i><span> DM</span></a>
  </div>
</section>


<?php endwhile; ?>
<?php else: ?>
<article>
       <h2></h2>
</article>
<?php endif; ?>

<?php get_footer(); ?>
