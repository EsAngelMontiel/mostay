<?php get_header(); ?>
<?php
if (have_posts()): while (have_posts()) : the_post();
$cover_img = get_the_post_thumbnail_url(get_the_ID(),'cover-size');

// Cover
$cover = get_field('cover', $post_id);
$cover_size = 'medium';
$main_cover = $cover['sizes'][ $cover_size ];

// Img 01
$img_1 = get_field('img_1', $post_id);
$size_large_1 = 'medium';
$large_1 = $img_1['sizes'][ $size_large_1 ];
$large_alt_1 = $img_1['alt'];

// Img 02
$img_2 = get_field('img_2', $post_id);
$size_large_2 = 'medium';
$large_2 = $img_2['sizes'][ $size_large_2 ];

// Img 03
$img_3 = get_field('img_3', $post_id);
$size_large_3 = 'medium';
$large_3 = $img_3['sizes'][ $size_large_3 ];

// Img 04
$img_4 = get_field('img_4', $post_id);
$size_large_4 = 'medium';
$large_4 = $img_4['sizes'][ $size_large_4 ];

// Img 05
$img_5 = get_field('img_5', $post_id);
$size_large_5 = 'medium';
$large_5 = $img_5['sizes'][ $size_large_5 ];

// links
$behance = get_field('behance', $post_id);

?>

  <section class="breadcrumb-espacio">
    <div class="bc-img">
      <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
        <img src="<?php echo $cover_img ; ?>" alt="<?php the_title(); ?>">
      <?php endif; ?>
      <span class="bc-gradient"></span>
    </div>
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
          <li>/</li>
          <li class="breadcrumb-item"><a href="<?php echo get_page_link(71); ?>">Proyectos</a></li>
          <li>/</li>
          <li class="breadcrumb-item active"><?php the_title(); ?></li>
        </ol>
      </nav>
    </div>
  </section>

  <!-- ********************** resumen de posts ********************** -->
  <section class="project">
    <article class="container">
      <?php if (!empty($cover)): ?>
        <img src="<?php echo $main_cover ; ?>" alt="<?php the_title(); ?>">
      <?php endif; ?>
      <div class="contenido">
        <?php
        $terms = wp_get_post_terms($post->ID, 'categorias');
        if ($terms) {
            $output = array();
            foreach ($terms as $term) {
                $categorias = $term->name ;
                $url_categorias = get_term_link( $term );
            }
            echo '<a class="categoria" href="'.$url_categorias.'">'.$categorias.'</a>';
        }
        ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
      <?php if (!empty($img_1)): ?>
        <img src="<?php echo $large_1 ; ?>" alt="<?php echo $large_alt_1 ; ?>">
      <?php endif; ?>
      <?php if (!empty($img_2)): ?>
        <img src="<?php echo $large_2 ; ?>" alt="<?php echo $large_alt_2 ; ?>">
      <?php endif; ?>
      <?php if (!empty($img_3)): ?>
        <img src="<?php echo $large_3 ; ?>" alt="<?php echo $large_alt_3 ; ?>">
      <?php endif; ?>
      <?php if (!empty($img_4)): ?>
        <img src="<?php echo $large_4 ; ?>" alt="<?php echo $large_alt_4 ; ?>">
      <?php endif; ?>
      <?php if (!empty($img_5)): ?>
        <img src="<?php echo $large_5 ; ?>" alt="<?php echo $large_alt_5 ; ?>">
      <?php endif; ?>

    </article>
    <div class="btn-container">
      <?php if (!empty($behance)): ?>
        <a href="<?php echo $behance ; ?>" class="btn" target="_blank"><i class="fab fa-behance-square"></i> <span> Ver en Behance</span></a>
      <?php endif; ?>
      <a href="<?php echo get_page_link(71); ?>" class="btn"><i class="fas fa-briefcase"></i><span> Volver a Proyectos</span></a>
      <!-- <a href="#" class="btn"><span>Siguiente Proyecto </span> <i class="fas fa-arrow-right"></i></a> -->
      <?php previous_post_link('%link', '<i class="fas fa-arrow-left"></i><span> Proyecto Anterior</span>'); ?>
      <?php next_post_link('%link', '<span>Siguiente Proyecto</span> <i class="fas fa-arrow-right"></i>'); ?>
    </div>
  </section>

  <!-- ********************** Featured ********************** -->
  <section class="blog featured-posts">
    <div class="bar"></div>
    <div class="container">
      <div class="titulo">
        <h1>Posts Relacionados.</h1>
        <p>También puedes ver el resto de los post al darle click a ver todos.</p>
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
      <?php
      } else { }
      wp_reset_postdata();
      wp_reset_query();
      ?>
      <div class="btn-container">
        <a href="<?php echo get_page_link(2); ?>" class="btn btn-blanco">Ver Todos</a>
      </div>

    </div>
  </section>

<?php endwhile; ?>
<?php else: ?>
<?php endif; ?>
<?php get_footer(); ?>
