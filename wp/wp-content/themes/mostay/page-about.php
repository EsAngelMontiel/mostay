<?php /* Template Name: About */
get_header();
if (have_posts()): while (have_posts()) : the_post();
$main_img = get_the_post_thumbnail_url(get_the_ID(),'cover-size');
$postid = $post->ID ;

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
           <video src="<?php echo $videoLogo ; ?>" playsinline autoplay muted loop poster="posterimage.jpg"></video>
         </div>
       </div>
       <!-- ******* End Hero Cover ********* -->
       <!-- ******* Service Header ********* -->
       <div class="container service-header">
         <div></div>
         <div>
           <h1><?php the_title(); ?></h1>
           <?php the_content(); ?>
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
             <p>Nuestra historia comienza en 2015, cuando Mostay nace con el objetivo de ayudar a emprendedores a darle vida a sus marcas a través del diseño. Fundada por un equipo diverso de profesionales creativos. Mostay comenzó su viaje en Venezuela, destacando por su compromiso con la calidad, la innovación y una atención al detalle.<br><br>
             En 2016, se establece a la Ciudad de México en busca de nuevos mercados, lo que significó una reinvención de la agencia, adaptándose a nuevas culturas y entornos de negocios.<br><br>
             En 2023, abrimos un nuevo capítulo al establecernos en Andalucía, España. Con un enfoque renovado y la incorporación de nuevo talento, con el firme objetivo de establecernos como un referente del diseño en Andalucía. Aunque Mostay tiene raíces en diferentes partes del mundo, su compromiso con la excelencia es universal.</p>
             <h3>Enfocados en el crecimiento de nuestros clientes</h3>
             <p>Nuestra misión es y seguirá siendo impulsar el crecimiento de nuestros clientes a través de un diseño innovador y estratégico, conectando emprendimientos con su audiencia ideal. Creando nichos donde las marcas se conviertan en símbolos significativos para sus audiencias, promoviendo un sentido de pertenencia y comunidad.</p>
             <h3>La diferencia está en los detalles</h3>
             <p>Los valores de Mostay incluyen la calidad sobre la cantidad, la innovación constante, la personalización, y una atención meticulosa al detalle. Estos valores guían todas las decisiones estratégicas y tácticas de la agencia, asegurando que cada proyecto no solo cumpla, sino que supere las expectativas de nuestros clientes.<br><br>
             Somos una agencia con experiencia global con el pulso en lo local, capaz de adaptarse a diversos entornos y culturas. Con una historia de resiliencia y crecimiento, Mostay sigue comprometida con la excelencia en el diseño y la creación de marcas poderosas que conectan profundamente con sus audiencias. La combinación de experiencia internacional y un enfoque personalizado nos permite ofrecer soluciones únicas y efectivas en cualquier mercado.</p>
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

<section class="team-wrapper">
  <div class="container team">
    <div class="team__info">
      <div></div>
      <div>
        <h2>Más de 40 años de experiencia combinada.</h2>
        <p>Nuestra experiencia nos permite abordar cada proyecto con un enfoque estratégico. Cada miembro del equipo aporta una visión única, pero compartimos el mismo objetivo: dar vida a las marcas de nuestros clientes de manera que conecten profundamente con su audiencia.</p>
      </div>
    </div>
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
              <!-- <ul>
                <li><a href="#" target="_blank"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-youtube"></i><span>YouTube</span></a></li>
                <li><a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i><span>X (Twitter)</span></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i><span>LinkedIn</span></a></li>
              </ul> -->
            </div>
          </article>
        </li>
        <li>
          <article>
            <div class="perfil">
              <img src="<?php echo get_template_directory_uri(); ?>/img/Foto-Angel.jpg" alt="Luis Montiel">
            </div>
            <div class="perfil-texto">
              <header>
                <h3>Ángel Montiel</h3>
                <p>Director de Arte</p>
              </header>
              <p>Branding, Marketing Digital y Motion graphics.</p>
              <ul>
                <li><a href="https://www.instagram.com/esangelmontiel" target="_blank"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
                <!-- <li><a href="#" target="_blank"><i class="fab fa-youtube"></i><span>YouTube</span></a></li> -->
                <li><a href="https://x.com/esangelmontiel" target="_blank"><i class="fa-brands fa-x-twitter"></i><span>X (Twitter)</span></a></li>
                <li><a href="https://www.linkedin.com/in/angelmontiel/#" target="_blank"><i class="fab fa-linkedin"></i><span>LinkedIn</span></a></li>
              </ul>
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
              <ul>
                <!-- <li><a href="#" target="_blank"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-youtube"></i><span>YouTube</span></a></li>
                <li><a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i><span>X (Twitter)</span></a></li> -->
                <li><a href="https://www.linkedin.com/in/daniken-espinoza/" target="_blank"><i class="fab fa-linkedin"></i><span>LinkedIn</span></a></li>
              </ul>
            </div>
          </article>
        </li>
        
        <li>
        </li>
      </ul>
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
