<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<footer>

        <div class="main-container footer">
            <div class="row">
                <ol>
                    <li class="foot-1">
                        <h3>Quick Links</h3>
                        <?php wp_nav_menu( array( 'theme_location' => 'quick-link-menu' ) ); ?>
                    </li>

                    <li class="foot-2">
                        <h3>Explore NGOs</h3>
                        <?php wp_nav_menu( array( 'theme_location' => 'explore-ngo-menu' ) ); ?>
                    </li>

                    <li class="foot-3">
                        <?php dynamic_sidebar( 'contact-info-sidebar' ); ?>
                    </li>
                </ol>
            </div>
        </div>

        <div class="container-fluid copyright">    
            <div class="main-container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-left">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/bottom-logo.png" alt="bottom-logo" class="img-responsive">
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 copy-right">
                        <!-- <?php dynamic_sidebar( 'copyright-sidebar' ); ?> -->
                        <p> © Kolkata Foundation, a registered 501 c(3) organization</p>
                    </div>
                </div>
            </div>
        </div>
    
    </footer>
    <script type='text/javascript' src='<?php  echo get_template_directory_uri(); ?>/js/jquery-1.11.0.min.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js'></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $( ".ngo-page-content table" ).addClass("table");
        $( "ul.donors img" ).addClass("img-responsive");
    });
</script>

<?php wp_footer(); ?>
</body>
</html>
