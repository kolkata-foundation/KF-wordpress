<?php
/**
 * Template Name: Share Page Template
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

<?php
require_once('vendor/autoload.php');

  global $wp_query;
  $fundraiser_id = $wp_query->query_vars['fundraiser_id'] ?: 0; // Find in the URL

  global $wpdb;
  $table_name = $wpdb->prefix . 'fundraisers';
  $result = $wpdb->get_results("SELECT volunteer_names, campaign_pledge, target, fb_redirect " .
                               "FROM $table_name WHERE fundraiser_id='" . $fundraiser_id . "'");

  $campaign = $result[0]->volunteer_names;
  $redirect = $result[0]->fb_redirect;
  $FB_app_id = "1568779430226087";
?>
    <div class="main-container">
      <div class="row">
    	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 tabbed" style="font-family: 'Roboto', sans-serif; font-size:14px; font-weight:400">
            <?php echo "Thank you for contributing to the <b>" . $campaign . "</b> campaign for Kolkata Foundation." ?>
            <div id="fb-root"></div>
            <div class="fb-share-button" data-href="https://www.kolkatafoundation.org/" data-layout="button_count">
               <a target="_blank" 
                  href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.kolkatafoundation.org%2F&amp;src=sdkpreparse" 
                  class="fb-xfbml-parse-ignore">Share on Facebook</a>
            </div>
	</div>
      </div><!-- row -->
      <div class="row">
        <h2>Woohoo</h2>
      </div>
      <div class="row">
        <?php  while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; // end of the loop. ?>
      </div><!-- row -->
     
    </div><!-- main-container -->
<?php get_footer(); ?>
