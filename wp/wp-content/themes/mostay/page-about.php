<?php /* Template Name: About */
get_header();
if (have_posts()): while (have_posts()) : the_post();
$main_img = get_the_post_thumbnail_url(get_the_ID(),'cover-size');
$postid = $post->ID ;
$attachment_id = 687;
$image_url = wp_get_attachment_image_url( $attachment_id, 'full' );

// Redes
$videoCover = get_field('vCover', $postid);
$VideoSquare = get_field('vSquare', $postid);
$videoLogo = get_field('vLogo', $postid);
$youtube = get_field('video_cover', $postid);
$email = get_field('email', $postid);
?>

<!-- ********************** resumen de posts ********************** -->
 <main>
   <section class="services">
     <article>
       <!-- ******* Hero Cover ********* -->
       <div class="cover">
         <div class="hero__video">
           <video src="<?php echo $videoLogo ; ?>" playsinline autoplay muted loop poster="<?php echo $image_url ; ?>"></video>
         </div>
       </div>
       <!-- ******* End Hero Cover ********* -->
       <!-- ******* Service Header ********* -->
       <div class="container service-header">
         <div></div>
         <div>
           <h1><?php the_title(); ?></h1>
           <?php the_content(); ?>
           <p  class="p__bigger">En <strong>Mostay</strong>, entendemos que una marca es más que un logo, es una experiencia completa que debe conectar con tu audiencia de manera auténtica.</p>
         </div>
       </div>
       <!-- ******* End Service Header ********* -->
       <!-- ******* Sticky Section ********* -->
       <div class="scroll-section">
         <div class="container scroll-container">
           <div class="image-container">
           <img src="https://mostay.co/wp-content/uploads/2025/01/Logo_Mockup-800x800.png" alt="Descripción de la imagen">
           </div>
           <div class="text-container">
             <h3>El camino es la recompensa</h3>
             <p>Esta historia comienza en 2015, cuando Mostay comenzó su viaje como un estudio de branding con el objetivo de ayudar a emprendedores a darle vida a sus marcas a través del diseño. Fundada por un equipo diverso de profesionales creativos. Mostay comenzó su viaje en Venezuela, destacando por su compromiso con la calidad, la innovación y una atención al detalle.<br><br>En 2016, se establece a la Ciudad de México en busca de nuevos mercados, lo que significó una reinvención de la agencia, adaptándose a nuevas culturas y entornos de negocios.<br><br>En 2023, abrimos un nuevo capítulo al establecernos en Andalucía, España. Con un enfoque renovado y con más experiencia, con el firme objetivo de establecernos como un referente del diseño de marcas en Andalucía.</p>
             <h3>Enfocados en el crecimiento de nuestros clientes</h3>
             <p>Nuestra misión es y seguirá siendo impulsar el crecimiento de nuestros clientes a través de un diseño innovador y estratégico, conectando emprendimientos con su audiencia ideal. Creando nichos donde las marcas se conviertan en símbolos significativos para sus consumidores, promoviendo un sentido de pertenencia y comunidad.</p>
             <h3>La diferencia está en los detalles</h3>
             <p>Está en nuestro ADN anteponer la calidad a la cantidad, perseguir la innovación constante y una atención meticulosa al detalle. Estos valores guían todas las decisiones estratégicas y tácticas del estudio, asegurando que cada proyecto no solo cumpla, sino que supere las expectativas de nuestros clientes.<br><br>
             Mostay es un estudio de diseño con un espiritu artesanal y experiencia global, capaz de adaptarse a diversos entornos y culturas. Con una historia de resiliencia y crecimiento, el diseño nos ha dado la oportunidad de construir proyectos que nos obligan seguir explorando nuevos límites, tu proyecto no será la excepción.</p>
           </div>
         </div>
       </div>
       <!-- ******* End Sticky Section ********* -->
       
   
   
     </article>
   </section>
 </main>


<?php endwhile; ?>
<?php else: ?>
<article>
       <h2></h2>
</article>
<?php endif; ?>

<section class="process">
  <div class="frase">
    <h2><strong>Creemos que el diseño debe ser funcional y estético,</strong> tener un propósito claro y estar al servicio de las necesidades tanto de nuestros clientes como de sus consumidores.</h2>
    <p class="p__bigger">Somos creyentes de la estrategia está al servicio del diseño.</p>
  </div>
  <ol class="pasos">
    <li>
      <article>
        <div>
          <span>1</span>
        </div>
        <div>
          <header>
            <h3>Descubrimiento</h3>
          </header>
          <p><strong>Comenzamos escuchándote. Profundizamos en tu historia, tu mercado y tus objetivos para encontrar la chispa que hace única a tu empresa.</strong> Esa visión compartida se convierte en la brújula que guiará todo el proyecto.</p> 
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
            <h3>Estrategia</h3>
          </header>
          <p><strong>Con los hallazgos sobre la mesa destilamos el ADN de tu marca: propósito, personalidad y posicionamiento.</strong> Definimos la narrativa y el plan de acción para que cada decisión futura hable el mismo idioma y conecte con tu audiencia ideal.</p> 
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
            <h3>Diseño</h3>
          </header>
          <p><strong>Transformamos la estrategia en forma y color.</strong> Exploramos conceptos, refinamos detalles y entregamos un sistema visual coherente — logotipo, estilo gráfico y guías de uso — listo para crecer contigo y mantener la consistencia en cada punto de contacto.</p> 
        </div>
      </article>
    </li>
  </ol>
  <div class="frase">
    <p class="p__bigger"><strong>Para conocer más sobre nuestro proceso,</strong> visita nuestra página de <a href="<?php echo esc_url(get_page_link(71));?>">Creación de Marcas</a>.</p>
  </div>
</section>

<section class="team-wrapper">
  <div class="container team">
    <div class="team__info">
      <div>
        <?php $video_id = 470; $video_url = wp_get_attachment_url( $video_id ); $mime = get_post_mime_type( $video_id ); ?> 
          <video autoplay loop muted playsinline poster="<?php echo esc_url( get_template_directory_uri() . '/img/poster.jpg' ); ?>"> <source src="<?php echo esc_url( $video_url ); ?>" type="<?php echo esc_attr( $mime ); ?>"> Tu navegador no soporta la etiqueta de vídeo. </video>
      </div>
      <div>
        <h2>Más de 18 años de Experiencia en Branding.</h2>
        <p class="p__big"><strong>Mi nombre es Ángel Montiel y soy el Director de Arte detrás de Mostay, Ya con casi 2 décadas de dedicarme a esto, descubrí que detrás de cada logo exitoso existe una historia de estrategia, storytelling y creatividad</strong>. Como director de este estudio, he desarrollado proyectos para Venezuela, Estados Unidos, Colombia, Francia, Italia, México y España, siempre con la misma obsesión: crear identidades auténticas que impulsen negocios reales.</p>
        <h3>Red de Especialistas</h3>
        <p>Cada proyecto que llega a Mostay cuenta con el respaldo de una red de profesionales con mucha experiencia—diseñadores, desarrolladores y estrategas—que se suman de acuerdo al alcance del proyecto. Cada colaborador suma por su dominio específico y por compartir nuestro compromiso con la excelencia. Así, formamos equipos a medida que amplían la visión del estudio y garantizan resultados de alto impacto sin sacrificar la cercanía.</p>
        <div class="team__fotos">
          <ul>
            <li>
              <article>
                <div class="perfil">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/Foto-Luis.jpg" alt="Luis Montiel">
                </div>
                <div class="perfil-texto">
                  <header>
                    <h3>Luis Montiel</h3>
                    <p>Diseñador Senior</p>
                  </header>
                  <p>Diseño para Medios Digitales, Web, UX/UI Design.</p>
                </div>
              </article>
            </li>
            <li>
              <article>
                <div class="perfil">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/Foto-Daniken.jpg" alt="Luis Montiel">
                </div>
                <div class="perfil-texto">
                  <header>
                    <h3>Daniken Espinoza</h3>
                    <p>Senior Web Developer</p>
                  </header>
                  <p>Web and App development.</p>
                </div>
              </article>
            </li>
            
            <li>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
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

<?php get_footer(); ?>
