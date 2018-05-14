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
    $campaign = $wp_query->query_vars['volunteer'];
?>

<?php
    global $wpdb;
    $segments = explode("_", $campaign);
    $volunteer = $segments[0];
 
    $table_name = $wpdb->prefix . 'fundraisers'; 
    $result = $wpdb->get_results("SELECT volunteer_names, picture, target, fundraiser_id, campaign_id FROM $table_name WHERE volunteer='" . $volunteer . "'");

    if ($result == null) { # XXX - redirect to the donation page?
    }

    $fundraiser_id = $result[0]->fundraiser_id;
    $table_name  = $wpdb->prefix . 'campaign_donations';
    $donations   = $wpdb->get_results("SELECT donor_name, donation_amount, is_recurring, donation_date from $table_name where fundraiser_id=" . $fundraiser_id);
    $donation_count = $wpdb->num_rows;
?>

    <div class="main-container">
        <div class="row ngo-page-banner">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 text-center ngo-title">
                <h1><?php echo $result[0]->volunteer_names; ?> Fundraiser</h1>
                <h2>Goal $<?php echo $result[0]->target; ?></h2>
          
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
                 
                 <a href="http://kolkatafoundation.org/donation-form/?fundraiser_id=<?php echo $result[0]->fundraiser_id ?>" class="donate-btn">DONATE</a>
		 <?php 
                    $donation_total = 0; 
                    foreach ($donations as $key => $row) { 
                       $donation_total += $row->donation_amount;
                    }
                 ?>
                 <div class="indian-donors">Raised $<?php echo $donation_total ?></div>
                 <div id="my-tab-content" class="tab-content">
		 <?php foreach ($donations as $key => $row) { ?>
                   <div class="donate-cause" href="#">
                     <span class="amount">$
                        <?php 
                            echo $row->donation_amount;
                            if ($row->is_recurring == true) { 
                                echo "/mo";
                            } 
                        ?>
                     </span>
                     <span class="cause"><?php echo $row->donor_name ?></span>
                   </div>
                   <?php } ?>
                 </div>
             </div><!-- donate-form-container -->
        </div><!-- col-lg-4 -->
      </div>
    </div>

<?php get_footer(); ?>
