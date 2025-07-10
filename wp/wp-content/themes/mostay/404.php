<?php get_header(); 
$attachment_id = 812;
$image_url = wp_get_attachment_image_url( $attachment_id, 'full' );
?>

<section class="services">
    <div class="cover cover--half">
        <div>
            <?php if ( $image_url ) : // Check if Thumbnail exists ?>
                <img src="<?php echo $image_url ; ?>" alt="Página no encontrada">
            <?php endif; ?>
        </div>
    </div>

    <div class="header-404">
        <div class="frase">
            <h1 class="entry-title"><?php _e( '¡Algo ha pasado! Tenemos un misterio entre manos.', 'mostay' ); ?></h1>
            <p class="p--big"><?php _e( 'Parece que la página que buscas ya no existe o cambio de nombre. Pero no te vayas todavía...', 'mostay' ); ?></p>
        </div>
    </div><!-- #post-0 -->
</section>
<section class="process">
    <div class="frase">
        <h2><strong>Encuentra un nuevo destino</strong>, quizás puedas encontrar lo que buscabas con estas tres opciones.</h2>
    </div>
        <ol class="pasos">
            <li>
                <article>
                    <div>
                        <span>1</span>
                    </div>
                    <div>
                        <header>
                            <h3>¿Buscabas un Proyecto?</h3>
                        </header>
                        <p>Nuestro portafolio evoluciona constantemente para mostrar solo los trabajos más relevantes. Es posible que ese proyecto haya dado paso a uno nuevo. ¡Descubre nuestros casos de éxito más recientes!</p>
                        <a href="<?php echo esc_url( get_permalink( 71 ) ); ?>" class="btn btn-whatsapp">Ir al Portafolio</a>
                    </div>
                </article>
            </li>
            <li>
                <article>
                    <div>
                        <span>2</span>
                    </div>
                    <div>
                        <header>
                            <h3>¿Venías por el Blog?</h3>
                        </header>
                        <p>Nuestros artículos sobre branding y diseño son para siempre. Si buscabas inspiración o un consejo, seguro lo encontrarás en nuestra colección de contenidos.</p>
                        <a href="<?php echo esc_url( get_permalink( 2 ) ); ?>" class="btn btn-whatsapp">Ir al Blog</a>
                    </div>
                </article>
            </li>
            <li>
                <article>
                    <div>
                        <span>3</span>
                    </div>
                    <div>
                        <header>
                            <h3>¿Quieres que hablemos de tu Proyecto?</h3>
                        </header>
                        <p>Si no encuentras lo que buscas o simplemente quieres empezar a crear algo increíble, el mejor lugar para empezar es aquí. Cuéntanos tu idea.</p>
                        <a href="https://wa.me/34641747158" class="btn btn-whatsapp">Agenda una Llamada</a>
                    </div>
                </article>
            </li>
        </ol>
</section>

<section class="cta-wrapper">
  <div class="container">
    <div class="cta">
      <div>
        <img src="<?php echo get_template_directory_uri(); ?>/img/cta.gif" alt="¿Quieres saber si Mostay es lo que tu marca necesita?">
      </div>
      <div>
        <h2>¿Quieres descubrir cómo Mostay puede transformar tu marca?</h2>
        <p>Tu historia merece ser contada de forma única. Estamos aquí para darle vida juntos. <strong>Escríbenos a nuestro WhatsApp para agendar una llamada introductoria de 15 minutos y descubre cómo podemos darle vida a tu proyecto.</strong></p>
        <a href="https://wa.me/34641747158" class="btn btn-whatsapp" target="_blank">
        ¿Cómo te podemos ayudar?
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
      </a>
      </div>
    </div>
  </div>
</section> 
<section class="newsletter">
  <div class="container">
    <div class="newsletter-logo">
    </div>
    <div>
      <h2>¿Buscas consejos efectivos para mejorar tu marca?</h2>
      <p>Suscríbete a El Contenedor. Nuestro newsletter con estrategias semanales para impulsar tu marca y negocio con ideas accionables y directas. <strong>¡Inscríbete ahora y dale a tu marca el impulso que necesita!</strong></p>
    <iframe src="https://embeds.beehiiv.com/7a0d530c-aa21-40f5-a3bf-3a024f27906c?slim=true" data-test-id="beehiiv-embed" height="52" frameborder="0" scrolling="no" style="width:100% ; margin: 0; border-radius: 0px !important; background-color: transparent;"></iframe>

    </div>
  </div>
</section>
<?php get_footer(); ?>
