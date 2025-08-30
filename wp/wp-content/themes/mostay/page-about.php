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
       <div class="container service-header" data-animate="fade-in">
         <div></div>
         <div>
           <h1 data-animate="typing"><?php the_title(); ?></h1>
           <?php the_content(); ?>
           <p class="p__bigger" data-animate="fade-in">En <strong>Mostay</strong>, entendemos que una marca es más que un logo, es una experiencia completa que debe conectar con tu audiencia de manera auténtica.</p>
         </div>
       </div>
       <!-- ******* End Service Header ********* -->
       <!-- ******* Sticky Section ********* -->
       <div class="scroll-section" data-animate="slide-up">
         <div class="container scroll-container">
           <div class="image-container" data-animate="slide-left">
           <img src="https://mostay.co/wp-content/uploads/2025/01/Logo_Mockup-800x800.png" alt="Descripción de la imagen">
           </div>
           <div class="text-container" data-animate="slide-right">
             <h3 data-animate="fade-in">El camino es la recompensa</h3>
             <p data-animate="fade-in">Esta historia comienza en 2015, cuando Mostay comenzó su viaje como un estudio de branding con el objetivo de ayudar a emprendedores a darle vida a sus marcas a través del diseño. Fundada por un equipo diverso de profesionales creativos. Mostay comenzó su viaje en Venezuela, destacando por su compromiso con la calidad, la innovación y una atención al detalle.<br><br>En 2016, se establece a la Ciudad de México en busca de nuevos mercados, lo que significó una reinvención de la agencia, adaptándose a nuevas culturas y entornos de negocios.<br><br>En 2023, abrimos un nuevo capítulo al establecernos en Andalucía, España. Con un enfoque renovado y con más experiencia, con el firme objetivo de establecernos como un referente del diseño de marcas en Andalucía.</p>
             <h3 data-animate="fade-in">Enfocados en el crecimiento de nuestros clientes</h3>
             <p data-animate="fade-in">Nuestra misión es y seguirá siendo impulsar el crecimiento de nuestros clientes a través de un diseño innovador y estratégico, conectando emprendimientos con su audiencia ideal. Creando nichos donde las marcas se conviertan en símbolos significativos para sus consumidores, promoviendo un sentido de pertenencia y comunidad.</p>
             <h3 data-animate="fade-in">La diferencia está en los detalles</h3>
             <p data-animate="fade-in">Está en nuestro ADN anteponer la calidad a la cantidad, perseguir la innovación constante y una atención meticulosa al detalle. Estos valores guían todas las decisiones estratégicas y tácticas del estudio, asegurando que cada proyecto no solo cumpla, sino que supere las expectativas de nuestros clientes.<br><br>
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

<section class="process" data-animate="fade-in">
  <div class="frase" data-animate="fade-in">
    <h2 data-animate="typing"><strong>Creemos que el diseño debe ser funcional y estético,</strong> tener un propósito claro y estar al servicio de las necesidades tanto de nuestros clientes como de sus consumidores.</h2>
    <p class="p__bigger" data-animate="fade-in">Somos creyentes de la estrategia está al servicio del diseño.</p>
  </div>
  <ol class="pasos" data-animate="stagger">
    <li data-stagger-item>
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
    <li data-stagger-item>
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
    <li data-stagger-item>
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
  <div class="frase" data-animate="fade-in">
    <p class="p__bigger" data-animate="fade-in"><strong>Para conocer más sobre nuestro proceso,</strong> visita nuestra página de <a href="<?php echo esc_url(get_page_link(71));?>">Creación de Marcas</a>.</p>
  </div>
</section>

<section class="team-wrapper" data-animate="fade-in">
  <div class="container team">
    <div class="team__info">
      <div data-animate="slide-left">
        <?php $video_id = 470; $video_url = wp_get_attachment_url( $video_id ); $mime = get_post_mime_type( $video_id ); ?> 
          <video autoplay loop muted playsinline poster="<?php echo esc_url( get_template_directory_uri() . '/img/poster.jpg' ); ?>"> <source src="<?php echo esc_url( $video_url ); ?>" type="<?php echo esc_attr( $mime ); ?>"> Tu navegador no soporta la etiqueta de vídeo. </video>
      </div>
      <div data-animate="slide-right">
        <h2 data-animate="typing">Más de 18 años de Experiencia en Branding.</h2>
        <p class="p__big" data-animate="fade-in"><strong>Mi nombre es Ángel Montiel y soy el Director de Arte detrás de Mostay, Ya con casi 2 décadas de dedicarme a esto, descubrí que detrás de cada logo exitoso existe una historia de estrategia, storytelling y creatividad</strong>. Como director de este estudio, he desarrollado proyectos para Venezuela, Estados Unidos, Colombia, Francia, Italia, México y España, siempre con la misma obsesión: crear identidades auténticas que impulsen negocios reales.</p>
        <h3 data-animate="fade-in">Red de Especialistas</h3>
        <p data-animate="fade-in">Cada proyecto que llega a Mostay cuenta con el respaldo de una red de profesionales con mucha experiencia—diseñadores, desarrolladores y estrategas—que se suman de acuerdo al alcance del proyecto. Cada colaborador suma por su dominio específico y por compartir nuestro compromiso con la excelencia. Así, formamos equipos a medida que amplían la visión del estudio y garantizan resultados de alto impacto sin sacrificar la cercanía.</p>
        <div class="team__fotos" data-animate="stagger">
          <ul>
            <li data-stagger-item>
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
            <li data-stagger-item>
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
            
            <li data-stagger-item>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section> 

<?php get_cta(); ?> 

<?php get_footer(); ?>
