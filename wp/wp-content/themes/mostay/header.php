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
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body>
  <!-- Preloader -->
  <div id="loader-wrapper">
      <div id="loader" >
        <div>
         <div class="loader">
           <img src="<?php echo get_template_directory_uri(); ?>/img/mostay.gif" alt="loader">
         </div>
        </div>
      </div>
  </div>
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
      <nav class="nav-main" role="navigation">
          <?php mostay_main_nav(); ?>
      </nav>
      <!--  /main nav -->
      <ul id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn">×</a>
				<?php mostay_side_nav(); ?>
			</ul>
			<button class="nav navbutton" type="button" name="button"><i class="fas fa-bars"></i></button>
      <div class="social-networks">
        <?php
        $instagram = get_option( 'instagram', 'Instagram' );
        $linkedin = get_option( 'linkedin', 'LinkedIn' );
        $facebook = get_option( 'facebook', 'Facebook' );
        $youtube = get_option( 'youtube', 'YouTube' );
        $twitter = get_option( 'twitter', 'Twitter' );
        ?>
        <ul class="sn">
            <?php if ($instagram !== '') {?>
              <li><a href="https://www.instagram.com/<?php echo $instagram ?>" target="_blank"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
            <?php } else {} ?>
            <?php if ($youtube !== '') {?>
              <li><a href="https://www.youtube.com/channel/<?php echo $youtube ?>" target="_blank"><i class="fab fa-youtube"></i><span>YouTube</span></a></li>
            <?php } else {} ?>
            <?php if ($twitter !== '') {?>
              <li><a href="https://www.twitter.com/<?php echo $twitter ?>" target="_blank"><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
            <?php } else {} ?>
            <?php if ($linkedin !== '') {?>
              <li><a href="https://www.linkedin.com/in/<?php echo $linkedin ?>" target="_blank"><i class="fab fa-linkedin"></i><span>LinkedIn</span></a></li>
            <?php } else {} ?>
            <?php if ($facebook !== '') {?>
              <li><a href="https://www.facebook.com/<?php echo $facebook ?>" target="_blank"><i class="fab fa-facebook-square"></i><span>Facebook</span></a></li>
            <?php } else {} ?>
          </ul>
			</div>
  </header>
  <!-- /header -->
