<?php get_header(); ?>

<!-- ********************** slider ********************** -->
<?php
$post_id = 101 ;

$post1 = get_field('post_1', $post_id);
$post2 = get_field('post_2', $post_id);
$post3 = get_field('post_3', $post_id);
$post4 = get_field('post_4', $post_id);

$tipo1 = get_field('tipo_1', $post_id);
$tipo2 = get_field('tipo_2', $post_id);
$tipo3 = get_field('tipo_3', $post_id);
$tipo4 = get_field('tipo_4', $post_id);

?>
<section class="mostay-cartelera">
  <?php if( !empty($post1)): ?>
  <ul class="home-slider">
      <li>
        <?php
        // override $post
      	$post = $post1;
      	setup_postdata( $post );
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
        $url = $thumb['0'];
        ?>
        <img src="<?php echo $url ;?>" alt="image">
        <div>
          <div class="container">
            <div>
              <strong><?php echo $tipo1 ; ?></strong>
              <h1><?php the_title(); ?></h1>
              <?php the_excerpt(); ?>
              <a class="btn-verde" href="<?php the_permalink(); ?>" alt="nombre del boton">Ver Artículo</a>
            </div>
          </div>
        </div>
        <?php wp_reset_postdata(); ?>
      </li>
      <?php if( !empty($post2)): ?>
        <li>
          <?php
          // override $post
        	$post = $post2;
        	setup_postdata( $post );
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
          $url = $thumb['0'];
          ?>
          <img src="<?php echo $url ;?>" alt="image">
          <div>
            <div class="container">
              <div>
                <strong><?php echo $tipo2 ; ?></strong>
                <h1><?php the_title(); ?></h1>
                <?php the_excerpt(); ?>
                <a class="btn-verde" href="<?php the_permalink(); ?>" alt="nombre del boton">Ver Artículo</a>
              </div>
            </div>
          </div>
          <?php wp_reset_postdata(); ?>
        </li>
      <?php endif; ?>
      <?php if( !empty($post3)): ?>
        <li>
          <?php
          // override $post
        	$post = $post3;
        	setup_postdata( $post );
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
          $url = $thumb['0'];
          ?>
          <img src="<?php echo $url ;?>" alt="image">
          <div>
            <div class="container">
              <div>
                <strong><?php echo $tipo3 ; ?></strong>
                <h1><?php the_title(); ?></h1>
                <?php the_excerpt(); ?>
                <a class="btn-verde" href="<?php the_permalink(); ?>" alt="nombre del boton">Ver Artículo</a>
              </div>
            </div>
          </div>
          <?php wp_reset_postdata(); ?>
        </li>
      <?php endif; ?>
      <?php if( !empty($post4)): ?>
        <li>
          <?php
          // override $post
        	$post = $post4;
        	setup_postdata( $post );
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
          $url = $thumb['0'];
          ?>
          <img src="<?php echo $url ;?>" alt="image">
          <div>
            <div class="container">
              <div>
                <strong><?php echo $tipo4 ; ?></strong>
                <h1><?php the_title(); ?></h1>
                <?php the_excerpt(); ?>
                <a class="btn-verde" href="<?php the_permalink(); ?>" alt="nombre del boton">Ver Artículo</a>
              </div>
            </div>
          </div>
          <?php wp_reset_postdata(); ?>
        </li>
      <?php endif; ?>
  </ul>
  <?php endif; ?>
</section>

<!-- ********************** resumen de posts ********************** -->
<section class="blog">
  <div class="container">
    <div class="titulo">
      <h1>El blog</h1>
      <p>Información sobre diseño, Branding y mi proceso personal en el desarrollo de Marcas.</p>
    </div>
    <?php
    $argo = array(
      'post_type'      => 'post',
      'posts_per_page' =>  3 ,
      'order'          => 'DESC',
    );

    $the_query = new WP_Query( $argo );

    if ($the_query->have_posts()){ ?>
    <ul>
      <?php while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small' );
        $url = $thumb['0'];
        $my_date01 = get_the_date( 'j F, Y', '', '', false );
        $my_date02 = get_the_date( 'Y-m-d', '', '', false );

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
      <?php } ?>
    </ul>
    <div class="btn-container">
      <a href="<?php echo get_page_link(2); ?>" class="btn btn-blanco">Ver Todos</a>
    </div>
    <?php
    } else { }
    wp_reset_postdata();
    wp_reset_query();
    ?>
  </div>
</section>

<!-- ********************** los cursos ********************** -->
<!-- <section class="cursos cursos-home">
  <div class="bar"></div>
  <div class="banner-cursos">
    <img src="https://dummyimage.com/1920x600/878787/a1a1a1.jpg" alt="">
    <div>
      <div class="container">
        <h1>Los Cursos</h1>
        <p>Aprende con la lista de cursos sobre diseño gráfico,<br> Branding y Diseño web.</p>
        <a class="btn-verde" href="#">Ver Cursos</a>
      </div>
    </div>
  </div>
  <div class="container">
    <ul>
      <li>
        <article class="curso-lista">
          <a href="#">
            <img src="https://dummyimage.com/300x300/b1b3b6/000000.jpg" alt="imagen del articulo">
          </a>
          <div>
            <h2><a href="#">Branding</a></h2>
            <h1><a href="#">Crear tu Marca Personal</a></h1>
            <p>Crear una marca es más que hacer el logo, es la comunicación, los valores, los objetivos, es decir que hay muchos factores que hay que tomar en cuenta a la hora de crear una marca, aquí aprenderás a crear una desde cero.</p>
            <a href="#">Leer mas <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </article>
      </li>
      <li>
        <article class="curso-lista">
          <a href="#">
            <img src="https://dummyimage.com/300x300/b1b3b6/000000.jpg" alt="imagen del articulo">
          </a>
          <div>
            <h2><a href="#">Organización</a></h2>
            <h1><a href="#">Curso Esencial de Notion</a></h1>
            <p>Crear una marca es más que hacer el logo, es la comunicación, los valores, los objetivos, es decir que hay muchos factores que hay que tomar en cuenta a la hora de crear una marca, aquí aprenderás a crear una desde cero.</p>
            <a href="#">Leer mas <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </article>
      </li>
      <li>
        <article class="curso-lista">
          <a href="#">
            <img src="https://dummyimage.com/300x300/b1b3b6/000000.jpg" alt="imagen del articulo">
          </a>
          <div>
            <h2><a href="#">Marketing</a></h2>
            <h1><a href="#">Introducción a la Creación de Contenido</a></h1>
            <p>Crear una marca es más que hacer el logo, es la comunicación, los valores, los objetivos, es decir que hay muchos factores que hay que tomar en cuenta a la hora de crear una marca, aquí aprenderás a crear una desde cero.</p>
            <a href="#">Leer mas <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </article>
      </li>
    </ul>
    <div class="btn-container">
      <a href="#" class="btn-verde">Ver Todos</a>
    </div>
  </div>
</section> -->


<!-- **********************portafolio ********************** -->
<section class="portafolio portafolio-home">
  <div class="bar"></div>
  <div class="container">
    <div class="titulo">
      <h1>Los Casos de Estudio</h1>
      <p>Conoce en detalle el proceso de como desarrollo una marca en Mostay.</p>
    </div>
    <?php
    $argo = array(
      'post_type'      => 'casos',
      'posts_per_page' =>  3 ,
      'order'          => 'DESC',
    );

    $the_query = new WP_Query( $argo );

    if ($the_query->have_posts()){ ?>
    <ul id="primero" class="casos">
      <?php while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small' );
        $url = $thumb['0']; ?>
      <li>
        <article class="trabajos-lista">
          <a href="<?php the_permalink(); ?>">
            <img src="<?php echo $url ; ?>" alt="imagen del articulo">
            <span>
              <span>
                <?php
                $terms = wp_get_post_terms($post->ID, 'categorias2');
                if ($terms) {
                    $output = array();
                    foreach ($terms as $term) {
                        $categorias = $term->name ;
                    }
                    echo '<h2>'.$categorias.'</h2>';
                }
                ?>
                <h2><?php single_cat_title(); ?></h2>
                <h1><?php the_title(); ?></h1>
                <?php the_excerpt(); ?>
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </span>
          </a>
        </article>
      </li>
      <?php } ?>
    </ul>
    <?php
    } else { }
    wp_reset_postdata();
    wp_reset_query();
    ?>
    <div class="btn-container">
      <a href="<?php echo get_page_link(13); ?>" class="btn btn-blanco">Ver Todos</a>
    </div>
    <div class="titulo">
      <h1>Los Trabajos</h1>
      <p>Conoce todas las marcas y rediseños que se han desarrollado en Mostay.</p>
    </div>
    <?php
    $argo = array(
      'post_type'      => 'proyectos',
      'posts_per_page' =>  6 ,
      'order'          => 'DESC',
    );

    $the_query = new WP_Query( $argo );

    if ($the_query->have_posts()){ ?>
    <ul id="ultimo" class="casos">
      <?php while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small' );
        $url = $thumb['0']; ?>
      <li>
        <article class="trabajos-lista">
          <a href="<?php the_permalink(); ?>">
            <img src="<?php echo $url ; ?>" alt="imagen del articulo">
            <span>
              <span>
                <?php
                $terms = wp_get_post_terms($post->ID, 'categorias');
                if ($terms) {
                    $output = array();
                    foreach ($terms as $term) {
                        $categorias = $term->name ;
                    }
                    echo '<h2>'.$categorias.'</h2>';
                }
                ?>
                <h2><?php single_cat_title(); ?></h2>
                <h1><?php the_title(); ?></h1>
                <?php the_excerpt(); ?>
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </span>
          </a>
        </article>
      </li>
      <?php } ?>
    </ul>
    <?php
    } else { }
    wp_reset_postdata();
    wp_reset_query();
    ?>
    <div class="btn-container">
      <a href="<?php echo get_page_link(71); ?>" class="btn btn-blanco">Ver Todos</a>
    </div>
  </div>

</section>

<?php get_footer(); ?>
