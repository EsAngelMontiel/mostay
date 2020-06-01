<?php get_header();
$cat_description = category_description();
?>

<section class="breadcrumb-espacio">
  <div class="bc-img">
    <img src="<?php echo get_template_directory_uri(); ?>/img/breadcrumb-bg.jpg" alt="Categorias">
    <span class="bc-gradient"></span>
  </div>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
        <li>/</li>
        <li class="breadcrumb-item active"><a href="<?php echo get_page_link(2); ?>">Blog</a></li>
      </ol>
    </nav>
  </div>
</section>

<section class="blog">
  <div class="container">
    <div class="titulo">
      <h1><?php single_cat_title(); ?></h1>
      <?php if ($cat_description !== '') {?>
        <?php echo $cat_description ; ?>
      <?php } else {} ?>
    </div>
    <ul>
      <?php
      if (have_posts()): while (have_posts()) : the_post();
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small' );
      $url = $thumb['0'];
      ?>
        <li>
          <article class="blog-post">
            <a href="<?php the_permalink(); ?>">
              <img src="<?php echo $url; ?>" alt="<?php the_title(); ?>">
            </a>
            <div>
              <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
              <time datetime="<?php echo $my_date02 ; ?>"><?php echo $my_date01 ; ?></time>
              <?php the_excerpt(); ?>
              <a href="<?php the_permalink(); ?>">Leer mas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </article>
        </li>
      <?php endwhile; ?>
      <?php endif; ?>
    </ul>
    <nav class="page-nav" aria-label="Page navigation example">
        <?php mostay_pagination(); ?>
    </nav>
  </div>
</section>


<section class="portafolio portafolio-destacado">
  <div class="bar"></div>
  <div class="container">
    <div class="titulo">
      <h1>Los Casos de Estudio</h1>
      <p>Ve todo lo que implica el desarrollo de cada proyecto que hacemos en mostay.</p>
    </div>
    <ul id="primero" class="casos">
      <li>
        <article class="casos-lista">
          <a href="#">
            <img src="https://dummyimage.com/300x300/b1b3b6/000000.jpg" alt="imagen del articulo">
            <span>
              <span>
                <h2>Branding</h2>
                <h1>Nombre del curso</h1>
                <p>Una pequeña descripción del proyecto, de unas dos lineas.</p>
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </span>
          </a>
        </article>
      </li>

      <li>
        <article class="casos-lista">
          <a href="#">
            <img src="https://dummyimage.com/300x300/b1b3b6/000000.jpg" alt="imagen del articulo">
            <span>
              <span>
                <h2>Branding</h2>
                <h1>Nombre del curso</h1>
                <p>Una pequeña descripción del proyecto, de unas dos lineas.</p>
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </span>
          </a>
        </article>
      </li>
      <li>
        <article class="casos-lista">
          <a href="#">
            <img src="https://dummyimage.com/300x300/b1b3b6/000000.jpg" alt="imagen del articulo">
            <span>
              <span>
                <h2>Branding</h2>
                <h1>Nombre del curso</h1>
                <p>Una pequeña descripción del proyecto, de unas dos lineas.</p>
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </span>
          </a>
        </article>
      </li>
    </ul>
    <div class="btn-container">
      <a href="#" class="btn btn-blanco">Ver Todos</a>
    </div>

  </div>

</section>

<?php get_footer(); ?>
