<?php
/**
 * Template Name: Volunteer Campaign Template
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
    global $wp_query;
    $page_slug = $wp_query->query_vars['pageslug'];
?>

<?php
    global $wpdb;

    $table_name = $wpdb->prefix . 'fundraisers'; 
    $result = $wpdb->get_results("SELECT volunteer_names, picture, target, campaign_id FROM $table_name WHERE slug='" . $page_slug . "'");
?>

    <div class="main-container">
        <div class="row ngo-page-banner">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 text-center ngo-title">
                <h1><?php echo $result[0]->volunteer_names; ?> Fundraiser</h1>
            </div>
        </div>        
    </div>
    <div class="spacer"></div> 

    <div class="main-container ngo-page-content">
      <div class="row">
    	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 tabbed">
            <?php $project_id = $result[0]->campaign_id; ?>
            <h1><?php echo get_post($project_id)->post_title; ?></h1>
            <?php echo get_post($project_id)->post_content; ?>
	</div>

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center donate-col">
             <div class="donate-form-container">
                 <div class="donate-btn">DONATE Now</div>
                 <div id="my-tab-content" class="tab-content">
                   <div class="donate-cause" href="#">
                     <span class="amount">$100</span>
                     <span class="cause">Joe Schmoe</span>
                   </div>
                 </div>
                 <div class="indian-donors">Raised $500</div>
             </div><!-- donate-form-container -->
        </div><!-- col-lg-4 -->
      </div>
    </div>

<?php get_footer(); ?>
