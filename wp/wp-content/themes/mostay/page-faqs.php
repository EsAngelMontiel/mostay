<?php /* Template Name: FAQs */
get_header();
if (have_posts()): while (have_posts()) : the_post();
?>

<main class="faqs">
	<div class="container">
		<!-- Mini hero dentro del main -->
		<div class="faqs__mini-hero">
			<?php
			// Permitir imagen destacada como fondo, con fallback a un placeholder del tema
			$mini_hero = get_the_post_thumbnail_url(get_the_ID(),'large');
			$mini_hero = $mini_hero ? $mini_hero : get_template_directory_uri() . '/img/breadcrumb-bg.jpg';
			?>
			<img src="<?php echo esc_url($mini_hero); ?>" alt="<?php the_title_attribute(); ?>">
		</div>

		<!-- Contenido en dos columnas -->
		<section class="faqs__grid">
			<aside class="faqs__intro">
				<h1><?php the_title(); ?></h1>
				<?php if (has_excerpt()) : ?>
					<p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
				<?php else: ?>
					<p><?php echo wp_kses_post(get_the_content(null, false)); ?></p>
				<?php endif; ?>
			</aside>

			<div class="faqs__accordion" id="faqsAccordion" role="region" aria-label="Preguntas frecuentes">
				<?php if (have_rows('faqs')): $i=0; while (have_rows('faqs')): the_row(); $i++;
					$pregunta = get_sub_field('pregunta');
					$respuesta = get_sub_field('respuesta');
					$expanded = 'false';
				?>
					<article class="faq-item">
						<button class="faq-item__question" aria-expanded="<?php echo $expanded; ?>" aria-controls="faq-panel-<?php echo $i; ?>">
							<span class="faq-item__label"><?php echo esc_html($pregunta); ?></span>
							<span class="faq-item__icon" aria-hidden="true" data-icon-closed="+" data-icon-open="−">+</span>
						</button>
						<div id="faq-panel-<?php echo $i; ?>" class="faq-item__panel" hidden>
							<p><?php echo wp_kses_post($respuesta); ?></p>
						</div>
					</article>
				<?php endwhile; else: ?>
					<!-- Fallback estático si no hay ACF: reemplazar con contenido real -->
					<article class="faq-item">
						<button class="faq-item__question" aria-expanded="false" aria-controls="faq-panel-fallback-1">
							<span class="faq-item__label">¿Qué diferencia a Mostay de otras agencias?</span>
							<span class="faq-item__icon" aria-hidden="true" data-icon-closed="+" data-icon-open="−">+</span>
						</button>
						<div id="faq-panel-fallback-1" class="faq-item__panel" hidden>
							<p>Nos enfocamos en estrategia, consistencia visual y ejecución ágil.</p>
						</div>
					</article>
				<?php endif; ?>
			</div>
		</section>
	</div>
</main>

<?php endwhile; endif; ?>

<?php get_template_part('page', 'cta'); ?>
<?php get_footer(); ?>


