<?php
/**
 * Template Name: NGO Page Template
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

<?php global $wp_query;
    $page_type =  $wp_query->query_vars['pagetype'];
    $page_slug = $wp_query->query_vars['pageslug'];
?>
<?php
    global $wpdb;
    $table_name = $wpdb->prefix . 'ngo_manager'; //Good practice
    $result = $wpdb->get_results("SELECT * FROM $table_name WHERE ngo_slug ='".$page_slug."'");
    $cause_result = $wpdb->get_results("SELECT ngo_donation_cause_one, ngo_donation_cause_two, ngo_donation_cause_three, ngo_donation_cause_four, ngo_donation_cause_five, ngo_donation_cause_six, ngo_donation_cause_seven, ngo_donation_cause_eight, ngo_donation_cause_nine, ngo_donation_cause_ten FROM $table_name WHERE ngo_slug ='".$page_slug."'");
    $cause_array = array();
    $cause_amount_array = array();
    $num_array = array('one','two','three','four','five','six','seven','eight','none','ten');
    for($i=0;$i<10;$i++){
        $cause_array[$i] = 'ngo_donation_cause_'.$num_array[$i];
        $cause_amount_array[$i] = 'ngo_donation_amount_'.$num_array[$i];
    }
?>
    <div class="main-container">
        <div class="row ngo-page-banner">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 text-center ngo-title">
                <h1><a href="#"><?php echo $result[0]->ngo_name; ?></a></h1>
                <h3><?php echo $result[0]->ngo_mission; ?></h3>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center ngo-title">
                <ul class="social">
                    <?php if(!$result[0]->ngo_facebook_url == ""){
                        echo '<li class="fb"><a href="'.$result[0]->ngo_facebook_url.'" target="_blank"><i class="fa fa-facebook"></i></a></li>'; }

                    if(!$result[0]->ngo_youtube_url == ""){
                        echo '<li class="yt"><a href="'.$result[0]->ngo_youtube_url.'" target="_blank"><i class="fa fa-youtube"></i></a></li>'; }

                    if(!$result[0]->ngo_website_url == ""){
                        echo '<li class="web"><a href="'.$result[0]->ngo_website_url.'" target="_blank"><i class="fa fa-globe"></i></a></li>'; }
                    ?>
                </ul>
            </div>
        </div>        
    </div>

    <div class="main-container ngo-page-content">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tabbed">
                <?php if(!$result[0]->ngo_home_image == ""){ ?>
                <?php
                    echo $result[0]->ngo_home_image;
                } else { ?>
                <iframe width="480" height="420" 
                        src="https://www.youtube.com/embed/<?php echo $result[0]->ngo_video_id; ?>" frameborder="0" allowfullscreen>
                </iframe>
                <?php } ?>

                <?php if(!$result[0]->ngo_impact_title_one == "" || 
                         !$result[0]->ngo_impact_title_two == "" || 
                         !$result[0]->ngo_impact_title_three == "" || 
                         !$result[0]->ngo_impact_title_four == ""){ ?>
                <div class="impact-ribbion">
                    <ul>
                        <li>
                            <h1><?php echo $result[0]->ngo_impact_value_one; ?></h1>
                            <p><?php echo $result[0]->ngo_impact_title_one;?></p>
                        </li>

                        <?php if(!$result[0]->ngo_impact_title_two == ""){ ?>
                        <li>
                            <h1><?php echo $result[0]->ngo_impact_value_two; ?></h1>
                            <p><?php echo $result[0]->ngo_impact_title_two; ?></p>
                        </li>
                        <?php } ?>

                        <?php if(!$result[0]->ngo_impact_title_three == ""){ ?>
                        <li>
                            <h1><?php echo $result[0]->ngo_impact_value_three; ?></h1>
                            <p><?php echo $result[0]->ngo_impact_title_three; ?></p>
                        </li>
                        <?php } ?>

                        <?php if(!$result[0]->ngo_impact_title_four == ""){ ?>
                        <li>
                            <h1><?php echo $result[0]->ngo_impact_value_four; ?></h1>
                            <p><?php echo $result[0]->ngo_impact_title_four; ?></p>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>

                <?php if(!$result[0]->ngo_founders_story == ""){ ?>
                    <li><a href="#founders-story" data-toggle="tab">Founders Story</a></li>
                <?php } ?>

                <?php if(!$result[0]->ngo_programs == ""){ ?>
                    <li><a href="#programs" data-toggle="tab">Programs</a></li>
                <?php } ?>

                <?php if(!$result[0]->ngo_growth_plans == ""){ ?>
                    <li><a href="#growth_plans" data-toggle="tab">Growth Plans</a></li>
                <?php } ?>

                <?php if(!$result[0]->ngo_performance == ""){ ?>
                    <li><a href="#metrics" data-toggle="tab">Performance Metrics</a></li>
                <?php } ?>

                <?php if(!$result[0]->ngo_financials == ""){ ?>
                    <li><a href="#financials" data-toggle="tab">Financials</a></li>
                <?php } ?>

                <?php if(!$result[0]->ngo_success_stories == ""){ ?>
                   <li><a href="#success_stories" data-toggle="tab">Success Stories</a></li>
                <?php } ?>

                <?php if(!$result[0]->ngo_awards == ""){ ?>
                    <li><a href="#awards" data-toggle="tab">Awards</a></li>
                <?php } ?>

                <?php if(!$result[0]->ngo_photos_videos == ""){ ?>
                    <li><a href="#photos" data-toggle="tab">Photos and Videos</a></li>
                <?php } ?>

                <?php if(!$result[0]->ngo_media == ""){ ?>
                    <li><a href="#media" data-toggle="tab">Media Mentions</a></li>
                <?php } ?>
            </ul>

            <div id="my-tab-content" class="tab-content">
                    <div class="tab-pane active text-left" id="overview">
                        <div class="ngo">
                            <!-- <h4><?php // echo $result[0]->ngo_mission; ?></h4> -->
                            <div class="ngo-summery">
                                <div class="block1">
                                    <div class="existance">Years in existence: <?php echo $result[0]->years_in_existence; ?></div>
                                    <div class="subblock1">
                                        <p><b>Awards Received:</b> <?php echo $result[0]->awards_received; ?></p>
                                        <p><b>Last Year Impact:</b> <?php echo $result[0]->impact_last_year. " " . $result[0]->last_year_impact_units; ?></p>
                                        <p><b>Lifetime people helped:</b> <?php echo $result[0]->lifetime_people_helped; ?></p>
                                        <p><b>Last Year expenses:</b> <?php echo $result[0]->expenses_last_year; ?></p>
                                    </div>
                                </div>

                                <div class="block2">
                                    <div class="staff">Contact: <?php echo $result[0]->contact_name; ?></div>
                                    <div class="subblock2">
                                        <p class="office"><b>Office:</b> <span><?php echo $result[0]->address; ?></span></p>
                                        <p><b>Email:</b> <?php echo $result[0]->contact_email; ?> </p>
                                        <p><b>Phone:</b> <?php echo $result[0]->contact_phone; ?></p>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <?php echo $result[0]->ngo_overview; ?>
                    </div>

                    <?php if(!$result[0]->ngo_performance == ""){ ?>
                    <div class="tab-pane" id="metrics">
                        <?php echo $result[0]->ngo_performance; ?>
                    </div>
                    <?php } ?>

                    <?php if(!$result[0]->ngo_financials == ""){ ?>
                    <div class="tab-pane" id="financials">
                        <?php echo $result[0]->ngo_financials; ?>
                    </div>
                    <?php } ?>

                    <?php if(!$result[0]->ngo_photos_videos == ""){ ?>
                    <div class="tab-pane" id="photos">
                        <?php echo $result[0]->ngo_photos_videos; ?>
                    </div>
                    <?php } ?>

                    <?php if(!$result[0]->ngo_media == ""){ ?>
                    <div class="tab-pane" id="media">
                        <?php echo $result[0]->ngo_media; ?>
                    </div>
                    <?php } ?>

                    <?php if(!$result[0]->ngo_founders_story == ""){ ?>
                    <div class="tab-pane" id="founders-story">
                        <?php echo $result[0]->ngo_founders_story; ?>
                    </div>
                    <?php } ?>

                    <?php if(!$result[0]->ngo_awards == ""){ ?>
                    <div class="tab-pane" id="awards">
                        <?php echo $result[0]->ngo_awards; ?>
                    </div>
                    <?php } ?>

                    <?php if(!$result[0]->ngo_growth_plans == ""){ ?>
                    <div class="tab-pane" id="growth_plans">
                        <?php echo $result[0]->ngo_growth_plans; ?>
                    </div>
                    <?php } ?>

                    <?php if(!$result[0]->ngo_programs == ""){ ?>
                        <div class="tab-pane" id="programs">
                            <?php echo $result[0]->ngo_programs; ?>
                        </div>
                    <?php } ?>

                    <?php if(!$result[0]->ngo_success_stories == ""){ ?>
                        <div class="tab-pane" id="success_stories">
                            <?php echo $result[0]->ngo_success_stories; ?>
                        </div>
                    <?php } ?>
                </div>
            </div> <!-- col-8 -->

   
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center donate-col">
                <div class="donate-form-container">
                    <div><h3>Impact</h3></div>
                    <div id="my-tab-content" class="tab-content">
                        <div class="tab-pane active" id="donate-once">
                              <?php  for($j=0;$j<10;$j++) { ?>
                                <?php if ($result[0]->$cause_array[$j] != "") { ?>
                                  <div class="donate-cause" href="#">
                                            <span class="amount"><?php echo $result[0]->$cause_amount_array[$j]; ?></span>
                                            <span class="cause"> <?php echo $result[0]->$cause_array[$j]; ?> </span>
                                  </div>
                              <?php }
                                } ?>
                        </div>
                    </div><!-- my-tab-content -->
                </div><!-- donate-form-container -->
            </div> <!-- col-3 -->
        </div>
    </div>

<?php get_footer(); ?>
