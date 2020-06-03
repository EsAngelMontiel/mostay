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
        <li class="breadcrumb-item active"><a href="<?php echo get_page_link(71); ?>">Proyectos</a></li>
        <li>/</li>
        <li class="breadcrumb-item active"><?php single_cat_title(); ?></li>
      </ol>
    </nav>
  </div>
</section>


<!-- ********************** resumen de posts ********************** -->
<section class="portafolio">
  <div class="container">
    <div class="titulo">
      <h1><?php single_cat_title(); ?></h1>
      <?php if ($cat_description !== '') {?>
        <?php echo $cat_description ; ?>
      <?php } else {} ?>
    </div>
    <ul class="casos">
      <?php
      if (have_posts()): while (have_posts()) : the_post();
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small' );
      $url = $thumb['0'];
      ?>
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
                <h1><?php the_title(); ?></h1>
                <?php the_excerpt(); ?>
                <i class="fas fa-arrow-circle-right"></i>
              </span>
            </span>
          </a>
        </article>
      </li>
      <?php endwhile; ?>
      <?php endif; ?>
    </ul>

  </div>
</section>


<!-- ********************** Blog ********************** -->
<section class="blog featured-posts">
  <div class="bar"></div>
  <div class="container">
    <div class="titulo">
      <h1>Conoce del Blog.</h1>
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

<?php get_footer(); ?>
