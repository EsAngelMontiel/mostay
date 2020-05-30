    <!-- footer -->
    <footer role="contentinfo">
        <!--  footer nav -->
        <nav class="footer-nav" role="navigation">
            <?php mostay_footer_nav(); ?>
        </nav>
        <!--  /footer nav -->

        <!-- copyright -->
        <div id="footer-icons">
            <!-- Client Name or Logo -->
            <h1>
                <a href="<?php echo home_url(); ?>"  title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
                    <span><?php bloginfo( 'name' ); ?> // <?php bloginfo( 'description' ); ?></span>
                </a>
            </h1>
            <!-- /Client Name or Logo -->
            <!-- Mostay Logo -->
            <h2 id="mostay-footer-logo">
                <a href="<?php echo esc_url( __( 'http://mostay.co/', 'Mostay' ) ); ?>" target="_blank">
                    <span id="mostay-logo-inner"></span>
                    <span id="mostay-logo-outer"><img src="<?php echo get_template_directory_uri(); ?>/images/mostay-footer-logo-outer.png"></span>
                </a>
            </h2>
            <!-- /Mostay Logo -->
            <!-- Disclaimer -->
            <small>
                <span><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span><br/>
                &copy; <?php bloginfo( 'description' ); ?>
            </small>
            <!-- /Disclaimer -->
        </div>
        <!-- /copyright -->
    </footer>
    <!-- /footer -->
    <?php wp_footer(); ?>

    <!-- analytics -->
    <script>
    (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
    (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
    l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
    ga('send', 'pageview');
    </script>
    <!-- /analytics -->

</body>
</html>
