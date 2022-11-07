<?php
/**
 * Template Name: SideMenu Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
    <div class="main-container">
       <?php echo do_shortcode( '[ubermenu config_id="main" menu="19"]'); ?>
    </div>
    <div class="spacer"/>
    <div class="d-none">
    <?php echo do_shortcode( '[flexy_breadcrumb]'); ?>
    </div>
    <div class="main-container ngo-page-content">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-6 col-xs-12 text-left">
            <?php wp_nav_menu( array( 'theme_location' => 'left-navigation-menu' ) ); ?>
            </div>
            <div class="col-lg-9 col-md-10 col-sm-6 col-xs-12">
                <div class="entry-content">
                    <?php  while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        </div>
    </div>
<!-- main-container ngo-page-content" -->

<!-- below here goes the footer -->
<footer>
  <div class="main-container footer_v2">
      <div class="row d-none d-lg-block">
        <ol>
          <li class="foot-1_v2">
            <h3>Learn More</h3>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-1' ) ); ?>
          </li>

          <li class="foot-2_v2">
            <h3>&nbsp</h3>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-2' ) ); ?>
          </li>

			<li class="foot-3_v2">
            <h3>NGO Links</h3>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-ngos' ) ); ?>
          </li>
            
         <li class="foot-3_v2">
            <h3>Get Involved</h3>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-3' ) ); ?>
          </li>

            <li class="foot-4_v2">
            <h3>Donate Now</h3>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-4' ) ); ?>
          </li>     
        </ol>
      </div>
    </div>

    <div class="container-fluid copyright_v2">    
      <!--<div class="main-container">-->
        <div class="row foot-low-1">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-left">
            <img src="https://www.kolkatafoundation.org/wp-content/uploads/2020/07/logo.png" alt="bottom-logo" class="img-responsive bottom-logo-img">
          </div>
            
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 right-mid">
            <p>
              <b>Kolkata Foundation</b><br>
              54 Clarke Court<br>
              Princeton, NJ  08540
            </p>
         </div>
         
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 right-bottom">
            <ul class="social_v2">
                <li class="mail"><a href="mailto:info@kolkatafoundation.org" target="_blank"><i class="fas fa-envelope"></i><!--&nbsp;&nbsp;info@kolkatafoundation.org--></a></li>
                <li class="fb"><a href="https://www.facebook.com/kolkatafoundation" target="_blank"><i class="fab fa-facebook"></i></a></li>
                <li class="yt"><a href="https://youtu.be/bD6n7KdyPic" target="_blank"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>
     </div>
          <div class="row foot-low-2">
              <div class="footer-menu-horizontal">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-horizontal' ) ); ?>
            </div>
          </div>
          <div class="row foot-low-3">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 copyright-text">
              <p>© 2021 Kolkata Foundation. All rights reserved.</p>
              <p>Kolkata Foundation is a global non-profit working to improve the lives of the neediest in Kolkata through high impact social interventions in education, women's empowerment, and healthcare. It is a call to action: to unite, give, change lives, and kindle hope.</p>
              <p>Kolkata Foundation is a registered 501(c)(3) organization. Gifts are tax deductible to the full extent allowable under the law.</p>
          </div>
          </div>
  </div>
<!--</div>-->
    <img src="<?php echo get_template_directory_uri(); ?>/images/top-image.jpg" alt="top-image" class="top-image img-responsive">
</footer>
