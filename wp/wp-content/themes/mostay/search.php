<?php get_header(); ?>

<!-- section -->
<section>

    <h1><?php echo sprintf( __( '%s Search Results for ', 'mostay' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

    <?php get_template_part('pagination'); ?>

</section>
<!-- /section -->


<?php get_footer(); ?>
