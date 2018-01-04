<?php get_header(); ?>

<?php global $wp_query;
$ngo_category = $wp_query->query_vars['pagetype'];
?>

    <div class="main-container about-us-banner">
        <?php global $wpdb;
         $category_table = $wpdb->prefix . 'ngo_category'; //Good practice
        $category_result = $wpdb->get_results("SELECT category_image FROM $category_table WHERE category_name = '".$ngo_category."'"); ?>
        <img src="<?php echo $category_result[0]->category_image; ?>" alt="banner-image" class="img-responsive">
    </div>

    <div class="main-container category-bar">
        <div class="explore-bar">
            <?php wp_nav_menu( array( 'theme_location' => 'explore-ngo-top-menu' ) ); ?>
        </div>
    </div> <!-- main-container -->

    <div class="main-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 category-list">
                <?php
                global $wpdb;
                $table_name = $wpdb->prefix . 'ngo_manager'; //Good practice
                $result = $wpdb->get_results("SELECT ngo_name, ngo_image, ngo_slug, ngo_mission, years_in_existence, staff_strength, expenses_last_year, impact_last_year, lifetime_people_helped, 	awards_received, fcra_registration, guidestar_number, description, awards_received, account_num, bank_name, branch, ifsc, micr_code, address, contact_name, contact_email, contact_phone, last_year_impact_units  FROM $table_name WHERE ngo_category = '".$ngo_category."'");
                ?>
                <h1><?php echo $ngo_category;?></h1>
                <?php foreach($result as $row){ ?>
                <div class="ngo">
                    <h3><a href="<?php echo get_site_url(); ?>/ngo/<?php echo $row->ngo_slug; ?>"><?php echo $row->ngo_name; ?><span>Learn More <i class="fa fa-angle-double-right"></i></span></a></h3>
                    <h4><?php echo $row->ngo_mission; ?></h4>
                    <div class="ngo-summary">
                        <?php echo stripslashes($row->ngo_image); ?>
                        <div class="block1">
                            <div class="existance">Years in existence: <?php echo $row->years_in_existence; ?></div>
                            <div class="subblock1">
                                <p><b>Awards Received:</b> <?php echo $row->awards_received; ?></p>
                                <p><b>Last Year Impact:</b> <?php echo $row->impact_last_year. " " .$row->last_year_impact_units; ?> </p>
                                <p><b>Lifetime people helped:</b> <?php echo $row->lifetime_people_helped; ?></p>
                            </div>
                        </div>

                        <div class="block2">
                            <div class="staff"><b>Contacts</b></div>
                            <div class="subblock2">
                                <p><b>Contact:</b> <?php echo $row->contact_name; ?> </p>
                                <p><b>Email:</b> <?php echo $row->contact_email; ?> </p>
                                <p><b>Phone:</b> <?php echo $row->contact_phone; ?></p>
                            </div>
                        </div>

                        <?php if(!$row->description == ""){ ?>
                            <div class="block5"><?php echo $row->description; ?></div>
                        <?php } ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php    }  ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
