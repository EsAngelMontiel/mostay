<?php /* Template Name: FAQs */
get_header();
if (have_posts()): while (have_posts()) : the_post();
?>

<main class="faqs">
	<div class="container">
		<!-- Mini hero dentro del main -->
		<?php $mini_hero = get_the_post_thumbnail_url(get_the_ID(),'large'); if ($mini_hero): ?>
			<div class="faqs__mini-hero">
				<img src="<?php echo esc_url($mini_hero); ?>" alt="<?php the_title_attribute(); ?>">
			</div>
		<?php endif; ?>

		<!-- Contenido en dos columnas -->
		<section class="faqs__grid">
			<aside class="faqs__intro">
				<h1><?php the_title(); ?></h1>
				<div class="faqs__content">
					<?php the_content(); ?>
				</div>
			</aside>

			<div class="faqs__accordion">
				<div class="accordion" id="faqsAccordion">
					<?php if (have_rows('faqs')): $i=0; while (have_rows('faqs')): the_row(); $i++;
						$pregunta = get_sub_field('pregunta');
						$respuesta = get_sub_field('respuesta');
						$is_first = ($i === 1);
					?>
						<div class="accordion-item">
							<h2 class="accordion-header" id="faq-heading-<?php echo $i; ?>">
								<button class="accordion-button <?php if (!$is_first) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-<?php echo $i; ?>" aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>" aria-controls="faq-collapse-<?php echo $i; ?>">
									<?php echo esc_html($pregunta); ?>
								</button>
							</h2>
							<div id="faq-collapse-<?php echo $i; ?>" class="accordion-collapse collapse <?php if ($is_first) echo 'show'; ?>" aria-labelledby="faq-heading-<?php echo $i; ?>" data-bs-parent="#faqsAccordion">
								<div class="accordion-body">
									<?php echo wpautop(wp_kses_post($respuesta)); ?>
								</div>
							</div>
						</div>
					<?php endwhile; else: ?>
						<!-- Fallback estático si no hay ACF: reemplazar con contenido real -->
						<div class="accordion-item">
							<h2 class="accordion-header" id="faq-heading-fallback-1">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-fallback-1" aria-expanded="true" aria-controls="faq-collapse-fallback-1">
									¿Qué diferencia a Mostay de otras agencias?
								</button>
							</h2>
							<div id="faq-collapse-fallback-1" class="accordion-collapse collapse show" aria-labelledby="faq-heading-fallback-1" data-bs-parent="#faqsAccordion">
								<div class="accordion-body">
									<p>Nos enfocamos en estrategia, consistencia visual y ejecución ágil. Nuestra red de especialistas nos permite adaptarnos a cada proyecto, garantizando resultados de alto impacto sin la estructura rígida de las agencias tradicionales.</p>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="faq-heading-fallback-2">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-fallback-2" aria-expanded="false" aria-controls="faq-collapse-fallback-2">
									¿Cuánto tiempo toma un proyecto de branding?
								</button>
							</h2>
							<div id="faq-collapse-fallback-2" class="accordion-collapse collapse" aria-labelledby="faq-heading-fallback-2" data-bs-parent="#faqsAccordion">
								<div class="accordion-body">
									<p>Cada proyecto es único, pero un proceso de branding completo suele tomar entre 6 y 12 semanas. Esto incluye investigación, estrategia, diseño y entrega de materiales. Nos aseguramos de cumplir con los plazos acordados sin sacrificar la calidad.</p>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="faq-heading-fallback-3">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-fallback-3" aria-expanded="false" aria-controls="faq-collapse-fallback-3">
									¿Ofrecen servicios de desarrollo web?
								</button>
							</h2>
							<div id="faq-collapse-fallback-3" class="accordion-collapse collapse" aria-labelledby="faq-heading-fallback-3" data-bs-parent="#faqsAccordion">
								<div class="accordion-body">
									<p>¡Sí! Aunque nuestra especialidad es el branding, colaboramos con una red de desarrolladores senior para crear sitios web a medida que no solo se ven bien, sino que también son funcionales, rápidos y están optimizados para SEO.</p>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	</div>
</main>

<?php get_cta(); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>


