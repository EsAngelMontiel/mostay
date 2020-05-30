<?php get_header(); ?>

<section>
    <!-- main content -->
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <?php if ( is_home() && ! is_front_page() ) : ?>
                <h1><?php _e( 'Latest Posts', 'mostay' ); ?></h1>
        <?php endif; ?>
        <?php get_template_part('pagination'); ?>
    <?php endwhile; ?>
    <?php endif; ?>
    <!-- /main content -->
</section>

<?php get_footer(); ?>
