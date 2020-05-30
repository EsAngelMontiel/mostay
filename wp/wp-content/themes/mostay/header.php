<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title>
        <?php
        if (function_exists('is_tag') && is_tag()) {
            single_tag_title("Tag Archive for &quot;"); echo '&quot; / '; }
        elseif (is_archive()) {
            wp_title(''); echo ' Archive / '; }
        elseif (is_search()) {
            echo 'Search for &quot;'.wp_specialchars($s).'&quot; / '; }
        elseif (!(is_404()) && (is_single()) || (is_page())) {
            wp_title(''); echo ' / '; }
        elseif (is_404()) {
            echo 'Not Found / '; }
        if (is_home()) {
            bloginfo('name'); echo ' / '; bloginfo('description'); }
        else {
            bloginfo('name'); }
        if ($paged>1) {
            echo ' / page '. $paged; }
        ?>
    </title>
    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body>
    <!-- header -->
    <header>
        <!-- logo -->
        <h1>
            <a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
                <span><?php bloginfo('name'); ?></span>
            </a>
        </h1>
        <!-- /logo -->
        <!--  main nav -->
        <nav class="main-nav" role="navigation">
            <?php mostay_main_nav(); ?>
        </nav>
        <!--  /main nav -->
    </header>
    <!-- /header -->
