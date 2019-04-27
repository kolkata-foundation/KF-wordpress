<?php
/**
 * Template Name: Leaderboard Template
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
    $campaign = $wp_query->query_vars['campaign'];

    global $wpdb;
    $segments = explode("_", $campaign);
    $volunteer = $segments[0];
 
    $table_name = $wpdb->prefix . 'fundraisers'; 
    $result = $wpdb->get_results("SELECT volunteer_names, campaign_pledge, target, fundraiser_id, " . 
                                 "       campaign_id, aggregator_type " .
                                 "FROM $table_name WHERE volunteer='" . $volunteer . "'");

    $fundraiser_id = $result[0]->fundraiser_id;
    $aggregator_type = 1; # $result[0]->aggregator_type;

    $goal        = $result[0]->target;
    $table_name  = $wpdb->prefix . 'campaign_donations';
    $donations   = $wpdb->get_results("SELECT donor_name, donation_amount, is_recurring, donation_date, fundraiser_aggregator_id  " . 
                                      " FROM $table_name " . # WHERE fundraiser_id=" . $fundraiser_id . 
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

    // Aggregator logic
    if ($aggregator_type > 0) {
        if ($aggregator_type == 1) {
            $aggregator_name = 'State';
        }
        else if ($aggregator_type == 2) {
            $aggregator_name = 'School';
        }

        $table_name  = $wpdb->prefix . 'fundraiser_aggregators';
        $aggregators = $wpdb->get_results("SELECT aggregator_name, aggregator_id from $table_name " .
                                          "WHERE  aggregator_type = $aggregator_type");
        $aggregator_map = []; 
        foreach ($aggregators as $key => $row) { 
            $aggregator_map[$row->aggregator_id] = $row->aggregator_name;
        }
    
        $aggregated_donations = $highest_donations; # start with annualized numbers
        $aggregated_by_amnt = [];
        $aggregated_by_count = [];
        foreach ($aggregated_donations as $key => $row) { 
            $row->fundraiser_aggregator_id = rand(1,14);  #XXXX Testing
            $aggregated_by_amnt[$row->fundraiser_aggregator_id] += $row->annual_donation; 
            $aggregated_by_count[$row->fundraiser_aggregator_id] += 1;
        }
        arsort($aggregated_by_amnt); # reverse sort the dicts by value
        arsort($aggregated_by_count);
    }
     
?>
    <div class="main-container">
        <div class="row ngo-page-banner">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center ngo-title">
                <h1><?php echo $result[0]->volunteer_names; ?></h1>
                <h3>Goal: <?php echo $result[0]->campaign_pledge; ?></h3>
            </div>
        </div>        
    </div>
    <div class="spacer">&nbsp; &nbsp;</div> 

    <div class="main-container ngo-page-content">
      <div class="row">
    	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
           <?php if ($aggregator_type > 0) { ?>
           <table class="table table-condensed">
             <tr><td><b><?php echo $aggregator_name ?></b></td>
                 <td style="text-align:right"><b>Count</b></td>
             </tr>
             <?php foreach ($aggregated_by_count as $key => $value) { ?>
               <tr>
                  <td><?php echo $aggregator_map[$key] ?></td>
                  <td style="text-align:right"><?php echo $value ?></td>
               </tr>
             <?php } ?>
           </table>
           <?php } ?>
	</div>
    	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
           <?php if ($aggregator_type > 0) { ?>
           <table class="table table-condensed">
             <tr><td><b><?php echo $aggregator_name ?></b></td>
                 <td style="text-align:right"><b>Amount</b></td>
             </tr>
             <?php foreach ($aggregated_by_amnt as $key => $value) { ?>
               <tr>
                  <td><?php echo $aggregator_map[$key] ?></td>
                  <td style="text-align:right"><?php echo "$" . $value ?></td>
               </tr>
             <?php } ?>
           </table>
           <?php } ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center donate-col">
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
