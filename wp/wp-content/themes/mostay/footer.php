    <!-- footer -->
    <footer>
      <div class="container">
        <h1><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><span><?php bloginfo( 'name' ); ?> // <?php bloginfo( 'description' ); ?></span></a></h1>
        <small>© 2025 Mostay. Damos vida a tu marca desde 2015. </small>
  			<div class="social-networks footer">
          <?php
          $instagram = get_option( 'instagram', 'Instagram' );
          $linkedin = get_option( 'linkedin', 'LinkedIn' );
          $facebook = get_option( 'facebook', 'Facebook' );
          $youtube = get_option( 'youtube', 'YouTube' );
          $twitter = get_option( 'twitter', 'Twitter' );
          ?>
  				<ul>
            <?php if ($instagram !== '') {?>
              <li><a href="https://www.instagram.com/<?php echo $instagram ?>" target="_blank"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
            <?php } else {} ?>
            <?php if ($youtube !== '') {?>
              <li><a href="https://www.youtube.com/channel/<?php echo $youtube ?>" target="_blank"><i class="fab fa-youtube"></i><span>YouTube</span></a></li>
            <?php } else {} ?>
            <?php if ($twitter !== '') {?>
              <li><a href="https://www.twitter.com/<?php echo $twitter ?>" target="_blank"><i class="fa-brands fa-x-twitter"></i><span>Twitter</span></a></li>
            <?php } else {} ?>
            <?php if ($linkedin !== '') {?>
              <li><a href="https://www.linkedin.com/in/<?php echo $linkedin ?>" target="_blank"><i class="fab fa-linkedin"></i><span>LinkedIn</span></a></li>
            <?php } else {} ?>
            <?php if ($facebook !== '') {?>
              <li><a href="https://www.facebook.com/<?php echo $facebook ?>" target="_blank"><i class="fab fa-facebook-square"></i><span>Facebook</span></a></li>
            <?php } else {} ?>
  				</ul>
  			</div>
      </div>
		</footer>
    <!-- /footer -->
    <?php wp_footer(); ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56774363-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-56774363-1');
    </script>
    <script>
      var scroll = new SmoothScroll('a[href*="#"]', {
        speed: 1400
      });
    </script>
    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/69f0ea2ee71f47064483eec66/854fac76c45eaf55bc3a82a34.js");</script>
    <script type="text/javascript" async src="https://embeds.beehiiv.com/attribution.js"></script>


</body>
</html>
