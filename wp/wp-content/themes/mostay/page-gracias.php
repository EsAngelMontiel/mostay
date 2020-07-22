<?php /* Template Name: Gracias */
get_header();
if (have_posts()): while (have_posts()) : the_post();
$main_img = get_the_post_thumbnail_url(get_the_ID(),'large');
$main_thumb = get_the_post_thumbnail_url(get_the_ID(),'small');

// Img 01
$img_1 = get_field('mockup', $post_id);
$size = 'cover-project';
$mockup = $img_1['sizes'][ $size ];

// Article 01
$art_img_01 = get_field('cover1', $post_id);
$size_02 = 'small';
$art_cover_01 = $art_img_01['sizes'][ $size_02 ];
$title_01 = get_field('titulo_01', $post_id);
$resumen_01 = get_field('resumen_01', $post_id);
$link_01 = get_field('link_01', $post_id);

// Article 02
$art_img_02 = get_field('cover2', $post_id);
$art_cover_02 = $art_img_02['sizes'][ $size_02 ];
$title_02 = get_field('titulo_2', $post_id);
$resumen_02 = get_field('resumen_2', $post_id);
$link_02 = get_field('link_2', $post_id);



?>

<section class="thanks">
  <div class="resource-header">
    <img src="<?php echo $main_img ; ?>" alt="<?php the_title(); ?>">
    <div>
      <div class="container">
        <div>
          <h1><?php the_title(); ?></h1>
          <?php the_excerpt(); ?>
        </div>
      </div>
    </div>
  </div>
  <article class="container">
    <div class="contenido">
      <?php the_content(); ?>
    </div>
  </article>

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

<?php endwhile; ?>
<?php else: ?>
<article>
       <h2></h2>
</article>
<?php endif; ?>

<section class="portafolio portafolio-destacado">
  <div class="bar"></div>
  <div class="container">
    <div class="titulo">
      <h1>Los Casos de Estudio</h1>
      <p>Ve detalles de todo lo que implica el desarrollo de cada proyecto en mostay.</p>
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

  </div>

</section>

<?php get_footer(); ?>
