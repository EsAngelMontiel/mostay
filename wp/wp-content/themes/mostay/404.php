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

<?php get_cta(); ?> 
<?php get_newsletter(); ?>
<?php get_footer(); ?>
