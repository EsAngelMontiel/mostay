<?php get_header();
$tag_description = tag_description();
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
      <h1><?php single_tag_title(''); ?></h1>
      <?php if ($tag_description !== '') { ?>
        <?php echo $tag_description; ?>
      <?php } ?>
    </div>
    <?php if (have_posts()): ?>
      <ul>
        <?php while (have_posts()): the_post(); ?>
          <?php
          $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumb');
          $url = is_array($thumb) ? $thumb[0] : '';
          ?>
          <li>
            <article class="blog-post">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url($url); ?>" alt="<?php the_title(); ?>">
              </a>
              <div>
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                  <?php echo esc_html(get_the_date()); ?>
                </time>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>">Leer más <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </article>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p>No se encontraron publicaciones.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>