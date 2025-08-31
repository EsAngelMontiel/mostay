<?php /* Template Name: FAQs */
get_header();
if (have_posts()): while (have_posts()) : the_post();
?>

<main class="faqs">
	<!-- Mini hero ahora es full-width con un container interno -->
	<?php mostay_display_hero(['type' => 'mini']); ?>

	<!-- Contenido en dos columnas, ahora envuelto en su propio container -->
	<div class="container">
		<section class="faqs__grid">
			<aside class="faqs__intro">
				<h1><?php the_title(); ?></h1>
				<div class="faqs__content">
					<?php the_content(); ?>
				</div>
			</aside>

			<div class="faqs__accordion">
				<?php
				// Only show FAQs from CPT 'faq', grouped by taxonomy 'faq_group'.
				$faq_query_all = new WP_Query(array(
					'post_type' => 'faq',
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'orderby' => 'menu_order',
					'order' => 'ASC'
				));

				if ($faq_query_all->have_posts()):
					$groups = array();
					while ($faq_query_all->have_posts()): $faq_query_all->the_post();
						$terms = wp_get_post_terms(get_the_ID(), 'faq_group');
						$group_name = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : 'General';
						$groups[$group_name][] = array(
							'title' => get_the_title(),
							'content' => get_the_content()
						);
					endwhile; wp_reset_postdata();

					$gindex = 0;
					$global_open_done = false;
					foreach ($groups as $group_title => $items): $gindex++; $group_parent = 'faqsCPTGroup' . $gindex; ?>
						<section class="faq-group">
							<h2 class="faq-group__title"><?php echo esc_html($group_title); ?></h2>
							<div class="accordion" id="<?php echo esc_attr($group_parent); ?>">
								<?php $j = 0; foreach ($items as $item): $j++; $is_first = ($j === 1); $should_open = (!$global_open_done && $is_first); if ($should_open) { $global_open_done = true; } ?>
									<div class="accordion-item">
										<h3 class="accordion-header" id="<?php echo esc_attr($group_parent . '-heading-' . $j); ?>">
											<button class="accordion-button <?php if (!$should_open) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($group_parent . '-collapse-' . $j); ?>" aria-expanded="<?php echo $should_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($group_parent . '-collapse-' . $j); ?>">
												<?php echo esc_html($item['title']); ?>
											</button>
										</h3>
										<div id="<?php echo esc_attr($group_parent . '-collapse-' . $j); ?>" class="accordion-collapse collapse <?php if ($should_open) echo 'show'; ?>" aria-labelledby="<?php echo esc_attr($group_parent . '-heading-' . $j); ?>" data-bs-parent="#<?php echo esc_attr($group_parent); ?>">
											<div class="accordion-body">
												<?php echo wpautop(wp_kses_post($item['content'])); ?>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</section>
					<?php endforeach;
				else:
					// No FAQs found in CPT
					echo '<p>' . esc_html__('No hay preguntas frecuentes publicadas todavía.', 'mostay') . '</p>';
				endif;
				?>
			</div>
		</section>
	</div>
</main>

<?php get_cta(); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>



