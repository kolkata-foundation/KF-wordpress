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
 get_header(); 
?>

<?php 
    global $wp_query;
    $campaign = $wp_query->query_vars['volunteer'];

    global $wpdb;
    $segments = explode("_", $campaign);
    $volunteer = $segments[0];
 
    $table_name = $wpdb->prefix . 'fundraisers'; 
    $result = $wpdb->get_results("SELECT volunteer_names, campaign_pledge, target, fundraiser_id, campaign_id " .
                                 "FROM $table_name WHERE volunteer='" . $volunteer . "'");

    if ($result == null) { # XXX - redirect to the donation page?
    }
    $fundraiser_id = $result[0]->fundraiser_id;

    $goal        = $result[0]->target;
    $table_name  = $wpdb->prefix . 'campaign_donations';
    $donations   = $wpdb->get_results("SELECT donor_name, donation_amount, is_recurring, donation_date " . 
                                      " FROM $table_name WHERE fundraiser_id=" . $fundraiser_id . 
                                      " ORDER BY donation_date DESC");
    $donation_count = $wpdb->num_rows;

    $donation_total = 0; 
    foreach ($donations as $key => $row) { 
      $multiplier = ($row->is_recurring ? 12 : 1);
      $donation_total += $row->donation_amount * $multiplier;
    }

    // Sorting by the largest one first
    $highest_donations = $donations;
    foreach ($highest_donations as $key => $row) { 
      $multiplier = ($row->is_recurring ? 12 : 1);
      $row->annual_donation = $row->donation_amount * $multiplier;
    }

    function compare_donations($a, $b)
    {
        return $b->annual_donation - $a->annual_donation;
    } 

    usort($highest_donations, "compare_donations");
?>
    <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/js.cookie.js'></script>
    <script>
        if (Cookies.get('kf_fundraiser_id') === undefined) {
            // Only set once if it has not been set before
            Cookies.set('kf_fundraiser_id', <?php echo (string)$fundraiser_id ?>, {expires: 1});
        }
    </script>

    <div class="main-container">
        <div class="row ngo-page-banner">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center ngo-title">
                <h1><?php echo $result[0]->volunteer_names; ?></h1>
                <h3>Goal: <?php echo $result[0]->campaign_pledge; ?></h3>
            </div>
        </div>        
    </div>
    <div class="spacer"></div> 

    <div class="main-container ngo-page-content">
      <div class="row">
    	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 tabbed">
            <?php $project_id = $result[0]->campaign_id; ?>
            <?php echo get_post($project_id)->post_content; ?>
	</div>

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center donate-col">
             <div>
             <a href="https://kolkatafoundation.org/donation-form/?fundraiser_id=<?php echo $result[0]->fundraiser_id ?>" class="donate-btn">
                 DONATE HERE
             </a>
             </div>
             <div class="campaign-status">
               <b>$<?php echo $donation_total ?></b> of $<?php echo $goal ?> goal<br/>
               Raised by <?php echo $donation_count ?> donors
             </div>
             <ul class="nav nav-tabs nav-justified">
                <li class="active"><a data-toggle="tab" href="#recent">Recent</a>
                <li><a data-toggle="tab" href="#highest">Highest</a></li>
             </ul>
             <div class="tab-content">
                 <div id="recent" class="tab-pane fade in active">
                 <table class="table table-condensed">
                 <tbody>
                 <?php foreach ($donations as $key => $row) { ?>
                   <tr><td>$
                      <?php 
                        echo $row->donation_amount;
                        if ($row->is_recurring == true) { 
                          echo "/mo";
                        } 
                      ?></td>
                        <td><?php echo $row->donor_name; ?></td>
                   </tr>
                  <?php } ?>
                 </tbody></table>
                 </div><!-- tab-pane -->
                 <div id="highest" class="tab-pane fade">
                 <table class="table table-condensed">
                 <tbody>
                  <?php foreach ($highest_donations as $key => $row) { ?>
                    <tr><td>$
                      <?php 
                        echo $row->donation_amount;
                        if ($row->is_recurring == true) { 
                          echo "/mo";
                        } 
                      ?></td>
                       <td><?php echo $row->donor_name; ?></td>
                    </tr>
                  <?php } ?>
                 </tbody></table>
             </div><!-- tab-panel -->
        </div><!-- col-lg-3 -->
      </div><!-- row -->
    </div><!-- main-container -->
    <div class="spacer"></div> 

<?php get_footer(); ?>
