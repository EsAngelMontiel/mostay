<?php get_header(); ?>
<section class="breadcrumb-espacio">
  <?php if (have_posts()): while (have_posts()) : the_post();
  $main_img = get_the_post_thumbnail_url(get_the_ID(),'cover-size');
  $my_date01 = get_the_date( 'j F, Y', '', '', false );
  $my_date02 = get_the_date( 'Y-m-d', '', '', false );
  ?>
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
        <li class="breadcrumb-item active"><a href="<?php echo get_page_link(2); ?>">Blog</a></li>
      </ol>
    </nav>
  </div>
</section>

<!-- ********************** resumen de posts ********************** -->
<section class="single">
  <article class="container">
    <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
      <?php the_post_thumbnail('medium'); // Fullsize image for the single post ?>
    <?php endif; ?>
    <div class="contenido">
      <span class="categoria"><?php the_category(', '); ?></span>
      <h1><?php the_title(); ?></h1>
      <time datetime="<?php echo $my_date02 ; ?>"><?php echo $my_date01 ; ?></time>
      <?php the_content(); ?>
    </div>
    <div class="tags">
      <strong>Tags: </strong>
      <?php the_tags( __( '', 'mostay' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
    </div>
    <div class="autor">
      <?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'small'); ?>
      <span>
        <?php
          $author_title = get_the_author_meta('title');
          $author_youtube = get_the_author_meta('youtube');
          $author_instagram = get_the_author_meta('instagram');
          $author_facebook = get_the_author_meta('facebook');
          $author_twitter = get_the_author_meta('twitter');
          $author_behance = get_the_author_meta('behance');
          $author_dribbble = get_the_author_meta('dribbble');
          $author_linkedin = get_the_author_meta('linkedin');
        ?>
        <em>Autor</em>
        <h2><a href="#"><?php the_author(); ?></a></h2>
        <?php if ($author_title !== '') {?>
          <strong><?php echo $author_title ; ?></strong>
        <?php } else {} ?>
        <p><?php the_author_description(); ?></p>
        <ul class="autor-rs">
          <?php if ($author_youtube !== '') {?>
            <li><a href="<?php echo $author_youtube ; ?>" target="_blank"><i class="fab fa-youtube"></i><span>Youtube</span></a></li>
          <?php } else {} ?>
          <?php if ($author_instagram !== '') {?>
            <li><a href="<?php echo $author_instagram ; ?>" target="_blank"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
          <?php } else {} ?>
          <?php if ($author_twitter !== '') {?>
            <li><a href="<?php echo $author_twitter ; ?>" target="_blank"><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
          <?php } else {} ?>
          <?php if ($author_behance !== '') {?>
            <li><a href="<?php echo $author_behance ; ?>" target="_blank"><i class="fab fa-behance-square"></i><span>Behance</span></a></li>
          <?php } else {} ?>
          <?php if ($author_dribbble !== '') {?>
            <li><a href="<?php echo $author_dribbble ; ?>" target="_blank"><i class="fas fa-basketball-ball"></i></i><span>Dribbble</span></a></li>
          <?php } else {} ?>
          <?php if ($author_linkedin !== '') {?>
            <li><a href="<?php echo $author_linkedin ; ?>" target="_blank"><i class="fab fa-linkedin"></i><span>LinkedIn</span></a></li>
          <?php } else {} ?>
          <?php if ($author_facebook !== '') {?>
            <li><a href="<?php echo $author_facebook ; ?>" target="_blank"><i class="fab fa-facebook"></i><span>LinkedIn</span></a></li>
          <?php } else {} ?>
        </ul>
      </span>
    </div>
  </article>
  <div class="btn-container">
    <a href="<?php echo get_page_link(2); ?>" class="btn btn-blanco">Volver al Blog</a>
  </div>
<?php endwhile; ?>
  <?php else: ?>
      <!-- article -->
      <article>
          <h1><?php _e( 'Sorry, nothing to display.', 'mostay' ); ?></h1>
      </article>
      <!-- /article -->
  <?php endif; ?>
</section>

<!-- ********************** Featured ********************** -->
<section class="blog featured-posts">
  <div class="bar"></div>
  <div class="container">
    <div class="titulo">
      <h1>Posts Relacionados.</h1>
      <p>Gracias por leer este artículo, aqui te muestro 3 que te pueden interesar.</p>
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
<!-- /section -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
