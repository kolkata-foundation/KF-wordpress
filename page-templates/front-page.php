<?php
/**
 * Template Name: Front Page Template
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

    <div class="main-container ngo-banner">
      <img src="http://kolkatafoundation.org/wp-content/uploads/2017/12/kf-story-1.gif">
    </div>

    <div class="main-container mission">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <?php $my_id = 10; ?>
                <?php echo "<p>".get_post($my_id)->post_excerpt."</p>";?>
                <a href="<?php echo get_permalink($my_id); ?>" class="more"><i class="fa fa-angle-right"></i>LEARN MORE</a>
            </div>
        </div> <!-- row -->
    </div> <!-- main-container -->

    <div class="container-fluid approach">
        <div class="main-container text-center">
            <?php $approach_id = 23; ?>
            <h1><?php echo get_post($approach_id)->post_title; ?><!-- Our Approach --></h1>
        </div> <!-- main-container -->
    </div> <!-- container-fluid -->

    <div class="container-fluid approach-tabs">
        <div class="main-container">
           <?php echo get_post($approach_id)->post_content;?>
        </div> <!-- main-container -->
    </div> <!-- container-fluid -->

    <div class="main-container">
        <div class="impact-ribbion">
            <?php $impact_id = 141; ?>
            <?php echo get_post($impact_id)->post_content;?>
        </div>
    </div> <!-- main-container -->


    <div class="main-container ngo-banner">
        <div class="big-third-left">
            <?php
            $my_id = 306;
            $post_id_5369 = get_post($my_id);
            $content = $post_id_5369->post_content;
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]>', $content);
            echo $content;
            ?>
        </div>
        
        <div class="big-third-middle">
            <?php
            $my_id = 325;
            $post_id_5369 = get_post($my_id);
            $content = $post_id_5369->post_content;
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]>', $content);
            echo $content;
            ?>
        </div>
        
        <div class="big-third-right">
            <?php
            $my_id = 322;
            $post_id_5369 = get_post($my_id);
            $content = $post_id_5369->post_content;
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]>', $content);
            echo $content;
            ?>
        </div>
    </div> <!-- main-container -->

<!--
     <div class="main-container">
       <div class="exlpore-bar">
        <?php wp_nav_menu( array( 'theme_location' => 'explore-ngo-top-menu' ) ); ?> 
       </div>
     </div> 
-->

    <!-- ======= HIDDEN SECTIONS =========
    
    <div class="main-container corporate">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            	<?php $corporate_id = 32; ?>
                <h1><?php echo get_post($corporate_id)->post_title; ?></h1>
               	<?php // echo do_shortcode('[gs_logo]'); ?>
                    <a href="<?php echo get_permalink($corporate_id); ?>" class="view-all"><i class="fa fa-angle-right"></i>View All Companies</a>
            </div>
        </div>
    </div> 
    
    <div class="container-fluid news">
        <div class="main-container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>News & Updates</h1>
                </div>
                <ul>
                	<?php query_posts($query_string."&orderby=date&order=ASC&posts_per_page=3");
					while ( have_posts() ) : the_post();
					$post = get_post(); ?>
                    <li>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_excerpt(); ?></p>

                        <a href="<?php the_permalink(); ?>"><i class="fa fa-angle-right"></i> READ MORE</a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-container international">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <?php $international_id = 57; ?>
                <h1><?php echo get_post($international_id)->post_title; ?> 
                <?php //  echo get_post($international_id)->post_content;?>
            </div>
        </div>
    </div>  

    <div class="main-container newsletter">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
               <?php $newsletter_id = 124; ?>
                <h1><?php echo get_post($newsletter_id)->post_title; ?></h1>
                <?php // echo get_post($newsletter_id)->post_content;?>

                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php  echo get_post($newsletter_id)->post_content;?>
                    </div>

                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                       <i class="fa fa-chevron-left"></i>
                    </a>

                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    ======== END HIDDEN main-container -->

    <div class="container-fluid testimonial">
        <div class="main-container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 text-left quotes">
                    <h1>Testimonials</h1>
                    <?php echo do_shortcode('[show_testimonials]'); ?>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 contact-form">
                    <h1>Join Us</h1>
                    <?php echo do_shortcode('[contact-form-7 id="70" title="Contact form 1"]'); ?>
                </div>
            </div>
        </div>
    </div> 
    

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>
