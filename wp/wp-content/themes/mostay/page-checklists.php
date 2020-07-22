<?php /* Template Name: Resources */
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

<section class="resource">
  <div class="resource-header">
    <img src="<?php echo $main_img ; ?>" alt="<?php the_title(); ?>">
    <div>
      <div class="container">
        <div>
          <h1><?php the_title(); ?></h1>
          <?php the_excerpt(); ?>
          <a class="btn-verde" href="#opt-in" alt="Descarga Gratis"><i class="fas fa-file-download"></i> Descarga Gratis</a>
        </div>
      </div>
    </div>
  </div>
  <article class="container">
    <img src="<?php echo $mockup ; ?>" alt="<?php the_title(); ?>">
    <div class="contenido">
      <?php the_content(); ?>
      <div class="relacionado">
        <ul>
          <?php if (!empty($link_01)):?>
          <li>
            <article>
              <a href="<?php echo $link_01 ; ?>">
                <img src="<?php echo $art_cover_01 ; ?>" alt="titulo">
                <h1><?php echo $title_01 ; ?></h1>
              </a>
              <p><?php echo $resumen_01 ; ?></p>
              <a href="<?php echo $link_01 ; ?>" target="_blank">Ver Video en YouTube <i class="fas fa-arrow-circle-right"></i></a>
            </article>
          </li>
          <?php endif; ?>
          <?php if (!empty($link_02)):?>
          <li>
            <article>
              <a href="#">
                <img src="<?php echo $art_cover_02 ; ?>" alt="titulo">
                <h1><?php echo $title_02 ; ?></h1>
              </a>
              <p><?php echo $resumen_02 ; ?></p>
              <a href="<?php echo $link_02 ; ?>">Ver Artículo del Blog <i class="fas fa-arrow-circle-right"></i></a>
            </article>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

  </article>
  <div id="opt-in" class="opt-in">
    <div class="bar"></div>
    <div class="container">
      <div class="titulo">
        <h1>Descarga la Guía.</h1>
        <p>Llena el formulario y te llegara un correo con el enlace de descarga de la Guía.</p>
      </div>
      <!-- Begin Mailchimp Signup Form -->
      <div id="mc_embed_signup">
        <form action="https://mostay.us7.list-manage.com/subscribe/post?u=69f0ea2ee71f47064483eec66&amp;id=aeedb7f0ec" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
          <div id="mc_embed_signup_scroll">
            <div class="indicates-required"><span class="asterisk">*</span> Datos Requeridos</div>
            <div class="mc-field-group">
              <label for="mce-EMAIL">Email  <span class="asterisk">*</span>
              </label>
              <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
            </div>
            <div class="mc-field-group">
              <label for="mce-FNAME">Nombre </label>
              <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
            </div>
            <div class="mc-field-group">
              <label for="mce-LNAME">Apellido </label>
              <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
            </div>
            <div id="mce-responses" class="clear">
              <div class="response" id="mce-error-response" style="display:none"></div>
              <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_69f0ea2ee71f47064483eec66_aeedb7f0ec" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button btn-verde"></div>
          </div>
        </form>
      </div>

      <!--End mc_embed_signup-->
      <small>Este formulario recolecta tu nombre completo y correo para poder agregarte a una lista de correos, hacerte llegar información valiosa, futuros cursos y nuevos recursos gratuitos como esta guía mediante un newsletter. Puedes leer nuestra <a href="https://mostay.co/politicas-privacidad/" target="_blank">política de privacidad</a> para entender cómo protegemos y manejamos tu información de forma segura. ¡Mostay no comparte información con terceros y no te llenará la bandeja con spam!</small>
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
