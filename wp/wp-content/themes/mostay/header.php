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
    <link href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/touch.png" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="https://use.typekit.net/ybq5geu.css">
    <script src="https://kit.fontawesome.com/64747c8ad2.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1472749472923308');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1472749472923308&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
    <?php wp_head(); ?>
    <?php add_action('init', 'mostay_enqueue_header_assets'); ?>
    <?php add_action('wp_enqueue_scripts', 'mostay_enqueue_styles'); ?>
</head>
<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="loader">
        <div>
         <div class="loader">
           <img src="<?php echo get_template_directory_uri(); ?>/img/mostay.gif" alt="loader" class="logo">
         </div>
        </div>
      </div>
  </div>
  
  <!-- header -->
  <header class="topnav">
    <!-- logo -->
    <h1 class="topnav__logo">
      <a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
        <span><?php bloginfo('name'); ?></span>
        <img src="<?php echo get_template_directory_uri(); ?>/img/mostay.svg" alt="Mostay">
      </a>
    </h1>
    <!-- /logo -->
    <!--  main nav -->
    <nav class="topnav__navigation" role="navigation">
      <span id="nav-label" hidden>Navigation</span> 
      <a href="https://wa.me/34641747158" class="btn topnav__navigation__cta" target="_blank">
        ¡Hablemos!
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
      </a>
      <button id="btnOpen" class="btn topnav__navigation__open" aria-expanded="false" aria-labelledby="nav-label">
        Menú
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/></svg>
      </button>
      <div class="topnav__navigation__menu" role="dialog" aria-labelledby="nav-label" inert="">
        <div>
          <div class="menuWrapper01">
            <div class="menuLogo">
              <span class="topnav__menu-logo-text">Mostay</span>
              <img src="<?php echo get_template_directory_uri(); ?>/img/mostay.svg" alt="Mostay" class="topnav__menu-logo-image">
            </div>
            <button class="topnav__close" alt="" width="48" haight="48" id="btnClose" aria-label="Close">
              <svg xmlns="http://www.w3.org/2000/svg" width="32.662" height="32.66" viewBox="0 0 32.662 32.66">
                  <g id="Group_394" data-name="Group 394" transform="translate(-1804.746 -82.594)">
                    <line id="Line_60" data-name="Line 60" x1="31.953" y2="31.953" transform="translate(1805.1 82.947)" fill="none" stroke="#333132" stroke-width="1"/>
                    <line id="Line_67" data-name="Line 67" x1="31.953" y2="31.953" transform="translate(1837.055 82.947) rotate(90)" fill="none" stroke="#333132" stroke-width="1"/>
                  </g>
                </svg>                        
            </button>
          </div>
          <div class="menuWrapper02">
            <?php mostay_main_nav(); ?>
            <?php mostay_secondary_nav(); ?> 
          </div>
          <div class="menuWrapper03">
                
          </div> 
        </div>
      </div>
    </nav>
    <!--  /main nav -->

  </header>
    <?php wp_footer(); ?>
  <!-- /header -->
