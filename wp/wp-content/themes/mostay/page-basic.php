<?php /* Template Name: Basic */
get_header();
if (have_posts()): while (have_posts()) : the_post();
$main_img = get_the_post_thumbnail_url(get_the_ID(),'cover-size');

$post_id = get_the_ID();

// Redes
$behance = get_field('behance', $post_id);
$linkedin = get_field('linkedin', $post_id);
$instagram = get_field('instagram', $post_id);
$youtube = get_field('video_cover', $post_id);
$email = get_field('email', $post_id);
?>

<section class="breadcrumb-espacio">
  <div class="bc-img">
    <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
      <img src="<?php echo $main_img ; ?>" alt="<?php the_title(); ?>">
    <?php endif; ?>
    <span class="bc-gradient"></span>
  </div>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
        <li>/</li>
        <li class="breadcrumb-item active"><?php the_title(); ?></li>
      </ol>
    </nav>
  </div>
</section>

<!-- ********************** resumen de posts ********************** -->
<section class="contacto">
  <article class="container">
    <?php if (!empty($youtube)): ?>
      <div class="video-cover">
        <?php echo $youtube ; ?>
      </div>
    <?php endif; ?>
    <div class="contenido">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </div>
  </article>
  <div class="btn-container">
    <?php if (!empty($behance)):?>
      <a href="https://www.behance.net/<?php echo $behance ; ?>" class="btn btn-blanco" target="_blank"><i class="fab fa-behance-square"></i> <span> Behance</span></a>
    <?php endif ; ?>
    <?php if (!empty($linkedin)):?>
      <a href="https://www.linkedin.com/in/<?php echo $linkedin ; ?>" class="btn btn-blanco" target="_blank"><i class="fab fa-linkedin-square"></i> <span> LinkedIn</span></a>
    <?php endif ; ?>
    <?php if (!empty($instagram)):?>
      <a href="https://www.instagram.com/<?php echo $instagram ; ?>" class="btn btn-blanco" target="_blank"><i class="fab fa-instagram"></i><span> Instagram</span></a>
    <?php endif ; ?>
    <?php if (!empty($email)):?>
      <SCRIPT TYPE="text/javascript">
        emailE = 'mostay.co'
        emailE = ('<?php echo $email ; ?>' + '@' + emailE)
        document.write('<A class="btn btn-blanco" href="mailto:' + emailE + '"><i class="fas fa-envelope"></i><span> Email</span></a>')
      </script>
    <?php endif ; ?>
  </div>
</section>

<!-- ********************** Featured ********************** -->
<section class="blog featured-posts">
  <div class="bar"></div>
  <div class="container">
    <div class="titulo">
      <h1>El Blog.</h1>
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


<?php endwhile; ?>
<?php else: ?>
<article>
       <h2></h2>
</article>
<?php endif; ?>

<?php get_footer(); ?>
