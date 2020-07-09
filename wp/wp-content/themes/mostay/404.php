<?php get_header(); ?>

    <div id="post-0" class="post no-results not-found">
        <h2 class="entry-title"><?php _e( 'Nothing Found', 'mostay' ); ?></h2>
        <div class="entry-content">
            <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'mostay' ); ?></p>
    <div class="buttons-wrap container">
        <h2><a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'mostay' ); ?></a></h2>

    </div>
    <?php //get_search_form(); ?>
        </div><!-- .entry-content -->
    </div><!-- #post-0 -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
