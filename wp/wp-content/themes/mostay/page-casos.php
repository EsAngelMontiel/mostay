<?php /* Template Name: Cases List */
get_header();
if (have_posts()): while (have_posts()) : the_post();
$main_img = get_the_post_thumbnail_url(get_the_ID(),'cover-size');
?>

<?php
  $args = array(
  'post_type'      => 'casos',
  'posts_per_page' =>  -1 ,
  'order'          => 'DESC'
  );
  query_posts($args);
?>

<!-- ********************** slider ********************** -->
<section class="mostay-cartelera">
  <ul class="home-slider">
    <?php
    while (have_posts()) : the_post();
    $slide_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $slide_url = $slide_thumb['0'];
    $featured = get_field('destacado', $post_id);
    ?>
    <?php if ($featured == true) { ?>
    <li>
      <img src="<?php echo $slide_url ; ?>" alt="<?php the_title(); ?>">
      <div>
        <div class="container">
          <div>
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
            <strong><?php single_cat_title(); ?></strong>
            <h1><?php the_title(); ?></h1>
            <?php the_excerpt(); ?>
            <a class="btn-verde" href="<?php the_permalink(); ?>" alt="nombre del boton">Ver Proyecto</a>
          </div>
        </div>
      </div>
    </li>
    <?php } else {} ?>
    <?php endwhile; ?>
  </ul>
</section>


<!-- ********************** resumen de posts ********************** -->
<section class="portafolio">
  <div class="container">
    <ul class="casos">
      <?php
      while (have_posts()) : the_post();
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumb' );
      $url = $thumb['0'];
      ?>
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
      <?php endwhile; ?>
    </ul>

  </div>
</section>
<?php
  wp_reset_postdata();
  wp_reset_query()
?>


<?php endwhile; ?>
<?php else: ?>
<article>
       <h2></h2>
</article>
<?php endif; ?>

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
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumb' );
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
