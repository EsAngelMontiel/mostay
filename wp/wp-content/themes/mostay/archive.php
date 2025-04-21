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
