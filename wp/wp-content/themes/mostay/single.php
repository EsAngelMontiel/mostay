<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post();
  $main_img = get_the_post_thumbnail_url(get_the_ID(),'large');
  $my_date01 = get_the_date( 'j F, Y', '', '', false );
  $my_date02 = get_the_date( 'Y-m-d', '', '', false );
  ?>

<!-- ********************** resumen de posts ********************** -->
<section class="single" data-animate="fade-in">
  <article>
    <!-- Article Cover -->
    <div class="cover" data-animate="slide-up">
      <div>
        <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
          <img src="<?php echo $main_img ; ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>
      </div>
    </div>
    <!-- End Article Cover -->
    <!-- Article header -->
    <div class="container article-container" data-animate="fade-in">
      <div class="contenido">
        <h1><?php the_title(); ?></h1>
        <div class="datos" data-animate="stagger">
          <div data-stagger-item>
            <h4>Categoría</h4>
            <?php the_category(', '); ?>
          </div>
          <div data-stagger-item>
            <h4>Publicado</h4>
            <time datetime="<?php echo $my_date02 ; ?>"><?php echo $my_date01 ; ?></time>
          </div>
          <div data-stagger-item>
            <h4>autor</h4>
            <span class="author"><?php the_author_link(); ?></span>
          </div>
          <div data-stagger-item>
            <h4>Tiempo de lectura</h4>
            <span class="reading-t"><?php echo do_shortcode('[rt_reading_time label="" postfix="minutos" postfix_singular="minuto."]'); ?></span>
          </div>
        </div>
      </div>
    </div>
    <!-- End Article header -->
    <!-- Article Content -->
    <div class="article-content" data-animate="fade-in">
      <div class="container article-container">
        <div data-animate="fade-in"><?php the_content(); ?></div>
        <div class="tags" data-animate="fade-in">
          <strong>Tags: </strong>
          <?php the_tags( __( '', 'mostay' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
        </div>
        <div class="autor" data-animate="fade-in">
          <?php
            $author_id = get_the_author_meta( 'ID' );
            $author_nicename = get_the_author_meta( 'display_name', $author_id );
            $author_title = get_the_author_meta('title', $author_id);
            $author_youtube = get_the_author_meta('youtube', $author_id);
            $author_instagram = get_the_author_meta('instagram', $author_id);
            $author_facebook = get_the_author_meta('facebook', $author_id);
            $author_twitter = get_the_author_meta('twitter', $author_id);
            $author_behance = get_the_author_meta('behance', $author_id);
            $author_dribbble = get_the_author_meta('dribbble', $author_id);
            $author_linkedin = get_the_author_meta('linkedin', $author_id);
            $author_url = get_the_author_meta( 'url', $author_id );
          ?>
          <?php echo get_wp_user_avatar($author_id, 'thumb'); ?>
          <span>
            <em>Autor</em>
            <h2><a href="<?php echo $author_url ; ?>"><?php echo $author_nicename ; ?></a></h2>
            <?php if ($author_title !== '') {?>
              <strong><?php echo $author_title ; ?></strong>
            <?php } else {} ?>
            <p><?php the_author_description(); ?></p>
            <ul class="autor-rs" data-animate="stagger">
              <?php if ($author_youtube !== '') {?>
                <li data-stagger-item><a href="<?php echo $author_youtube ; ?>" target="_blank"><i class="fab fa-youtube"></i><span>Youtube</span></a></li>
              <?php } else {} ?>
              <?php if ($author_instagram !== '') {?>
                <li data-stagger-item><a href="<?php echo $author_instagram ; ?>" target="_blank"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
              <?php } else {} ?>
              <?php if ($author_twitter !== '') {?>
                <li data-stagger-item><a href="<?php echo $author_twitter ; ?>" target="_blank"><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
              <?php } else {} ?>
              <?php if ($author_behance !== '') {?>
                <li data-stagger-item><a href="<?php echo $author_behance ; ?>" target="_blank"><i class="fab fa-behance-square"></i><span>Behance</span></a></li>
              <?php } else {} ?>
              <?php if ($author_dribbble !== '') {?>
                <li data-stagger-item><a href="<?php echo $author_dribbble ; ?>" target="_blank"><i class="fas fa-basketball-ball"></i></i><span>Dribbble</span></a></li>
              <?php } else {} ?>
              <?php if ($author_linkedin !== '') {?>
                <li data-stagger-item><a href="<?php echo $author_linkedin ; ?>" target="_blank"><i class="fab fa-linkedin"></i><span>LinkedIn</span></a></li>
              <?php } else {} ?>
              <?php if ($author_facebook !== '') {?>
                <li data-stagger-item><a href="<?php echo $author_facebook ; ?>" target="_blank"><i class="fab fa-facebook"></i><span>LinkedIn</span></a></li>
              <?php } else {} ?>
            </ul>
          </span>
        </div>
        <div class="btn-container" data-animate="fade-in">
          <a href="<?php echo get_page_link(2); ?>" class="btn btn-blanco">Volver al Blog</a>
        </div>
      </div>
    </div>
    <!-- Article Content -->
  </article>
  

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
<section class="blog featured-posts" data-animate="fade-in">
  <div class="bar-orange"></div>
  <div class="titulo" data-animate="fade-in">
    <h2 data-animate="typing">Otros artículos que te
    pueden interesar.</h2>
  </div>
  <?php
  $argo = array(
    'post_type'      => 'post',
    'posts_per_page' =>  4 ,
    'post__not_in'   => array(get_the_ID()),
    'order'          => 'DESC',
  );

  $the_query = new WP_Query( $argo );

  if ($the_query->have_posts()){ ?>
  <ul data-animate="stagger">
    <?php while ( $the_query->have_posts() ) {
      $the_query->the_post();
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumb' );
      $url = $thumb['0'];
      $my_date01 = get_the_date( 'j F, Y', '', '', false );
      $my_date02 = get_the_date( 'Y-m-d', '', '', false );

      ?>
      <li data-stagger-item>
        <article class="blog-post">
          <a href="<?php the_permalink(); ?>">
            <img src="<?php echo $url; ?>" alt="<?php the_title(); ?>">
          </a>
          <div>
          <div class="post-info">
              <time datetime="<?php echo $my_date02 ; ?>"><i class="fas fa-calendar-alt"></i> <?php echo $my_date01 ; ?></time>
              <span class="reading-t"><i class="fas fa-stopwatch"></i> <?php echo do_shortcode('[rt_reading_time label="Lectura:" postfix="minutos." postfix_singular="minuto."]'); ?></span>
            </div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
  <div class="btn-container" data-animate="fade-in">
    <a href="<?php echo get_page_link(2); ?>" class="btn btn-blanco">Ver Todos</a>
  </div>
</section>
<!-- /section -->
<?php get_sidebar(); ?>

<?php get_cta(); ?> 

<?php get_footer(); ?>
