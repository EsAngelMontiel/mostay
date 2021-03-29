<?php /* Template Name: About */
get_header();
if (have_posts()): while (have_posts()) : the_post();
$main_img = get_the_post_thumbnail_url(get_the_ID(),'cover-size');

// Redes
$videoCover = get_field('vCover', $post_id);
$VideoSquare = get_field('vSquare', $post_id);
$videoLogo = get_field('vLogo', $post_id);
$youtube = get_field('video_cover', $post_id);
$email = get_field('email', $post_id);
?>

<!-- ********************** resumen de posts ********************** -->
<section class="about">
  <article>
    <!-- ********************** about header ********************** -->
    <div class="about-header">
      <div class="video">
        <video src="<?php echo $videoCover ; ?>" playsinline autoplay muted loop poster="posterimage.jpg"></video>
      </div>
      <div class="about-title">
        <div class="container">
          <div>
            <h1>¿Quieres desarrollar tu marca pero no sabes por donde comenzar?</h1>
          </div>

          <a data-scroll href="#bazinga"><i class="fas fa-chevron-circle-down"></i></a>
        </div>
      </div>
    </div>
    <!-- ********************** about content ********************** -->
    <div id="bazinga" class="container contenido">
      <div>
        <video src="<?php echo $VideoSquare ; ?>" playsinline autoplay muted loop poster="posterimage.jpg"></video>
      </div>
      <div>
        <h2>Si no hablas de lo que sabes, nadie se va a enterar.</h2>
        <h4>Tener mucho conocimiento en tu área no te da autoridad, la creación de contenido y el desarrollo de tu marca persona si te la da. </h4>
        <p>En todos mis años como diseñador he encontrado personas talentosas, que se sienten estancadas porque no saben como darse a conocer o no saben como encontrar a su consumidor ideal. Por eso en Mostay trabajo conjuntamente con ellos para ayudarlos a encontrar su audiencia ideal a través de una estrategia de creación de contenido ajustada a su marca y su mensaje.</p>
      </div>
    </div>
    <div class="about-me">
      <div class="container">
        <div class="my-photo">
          <?php echo get_wp_user_avatar(get_the_author_meta(1), 'small'); ?>
        </div>
        <div class="my-bio">
          <h2>Mi nombre es, <span>Ángel Montiel</span></h2>
          <p>Soy Diseñador Gráfico desde hace 13 años, especializado en Branding y estrategias de creación de contenido para creativos y emprendedores.</p>
          <p>Soy firme creyente de que todos tenemos una pasión, una voz y una motivación para hacer algo. Mi objetivo en <a href="#">Mostay</a> es ayudar a la mayor cantidad de personas a alcanzar el sueño de vivir haciendo eso que realmente le gusta.</p>
        </div>
      </div>
    </div>
    <div class="cta">
      <div class="container">
        <div class="my-video">
          <video src="<?php echo $videoLogo ; ?>" playsinline autoplay muted loop poster="posterimage.jpg"></video>
        </div>
        <div class="my-bio">
          <h2>En Mostay te ayudo a construir tu marca, definir tu audiencia y adoptar la creación de contenido como método de promoción, para crear autoridad y posicionarte en tu industria como un referente de eso que tanto te apasiona.</h2>
          <h4>Todo desde un punto estratégico para que tengas una voz propia y le hables directamente a tu consumidor ideal sin importar la plataforma o red social.</h4>
        </div>
      </div>
    </div>
    <div class="cta-2">
      <div class="container">
        <div class="my-bio">
          <h2>Así que bienvenidos a Mostay, dime <span>¿Cómo te puedo ayudar?</span></h2>
        </div>
      </div>
    </div>
    <div id="opt-in" class="opt-in">
      <div class="bar"></div>
      <div class="container">
        <div class="titulo">
          <h1>Conversemos,</h1>
          <p>Llena el formulario y me pondré en contacto contigo en la brevedad posible.</p>
        </div>
        <!-- Begin Mailchimp Signup Form -->
        <div id="mc_embed_signup">
        <form action="https://mostay.us7.list-manage.com/subscribe/post?u=69f0ea2ee71f47064483eec66&amp;id=aeedb7f0ec&ORIGIN=contact" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">

          <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
          <div class="mc-field-group two-columns">
            <label for="mce-FNAME">Nombre(s) <span class="asterisk">*</span>
          </label>
            <input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
          </div>
          <div class="mc-field-group two-columns">
            <label for="mce-LNAME">Apellido(s) <span class="asterisk">*</span>
          </label>
            <input type="text" value="" name="LNAME" class="required" id="mce-LNAME">
          </div>
          <div class="mc-field-group">
            <label for="mce-EMAIL">Email  <span class="asterisk">*</span>
          </label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
          </div>
          <div id="mergeRow-gdpr" class="mergeRow gdpr-mergeRow content__gdprBlock mc-field-group">
            <div class="content__gdpr">
              <label>Permiso</label>
              <p>Este formulario recolecta tu nombre completo y correo para poder agregarte a una lista de correos, hacerte llegar información valiosa, futuros cursos y nuevos recursos gratuitos como esta guía mediante un newsletter. Puedes leer nuestra <a href="https://mostay.co/politicas-privacidad/" target="_blank">política de privacidad</a> para entender cómo protegemos y manejamos tu información de forma segura. ¡Mostay no comparte información con terceros y no te llenará la bandeja con spam! tambien puedes enviarme un mensaje directo a mi Instagram <a href="https://www.instagram.com/mostayco">@MostayCo</a></p>
              <fieldset class="mc_fieldset gdprRequired mc-field-group" name="interestgroup_field">
                <label class="checkbox subfield" for="gdpr_41031">
                  <input type="checkbox" id="gdpr_41031" name="gdpr[41031]" value="Y" class="av-checkbox gdpr">
                  <span>Email</span>
                </label>
              </fieldset>
              <p>Ye puedes dar de baja en cualquier momento dando click en el pie de los  correos. Para mas información visita la pagina de Políticas de Privacidad.</p>
          </div>
          <div class="content__gdprLegal">
            <p>Yo uso Mailchimp como mi plataforma de marketing. Al hacer click en Contáctame, estas aceptando que tu información sea transferida a Mailchimp para ser procesada. <a href="https://mailchimp.com/legal/" target="_blank">Para conocer mas sobre las politicas de privacidad de Mailchimp puedas hacer click aquí.</a></p>
            </div>
            </div>
            <div id="mce-responses" class="clear">
              <div class="response" id="mce-error-response" style="display:none"></div>
              <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_69f0ea2ee71f47064483eec66_aeedb7f0ec" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Enviar" name="subscribe" id="mc-embedded-subscribe" class="button btn-verde"></div>
          </div>
        </form>
        </div>

        <!--End mc_embed_signup-->
      </div>
    </div>
  </article>

</section>




<?php endwhile; ?>
<?php else: ?>
<article>
       <h2></h2>
</article>
<?php endif; ?>

<?php get_footer(); ?>
