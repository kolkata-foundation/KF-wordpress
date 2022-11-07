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
    <!--  <img src="https://kolkatafoundation.org/wp-content/uploads/2018/01/kf-banner1.jpg"> -->
		<?php echo do_shortcode('[metaslider id="778"]'); ?>
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

    <div class="main-container approach text-center">
            <?php $approach_id = 23; ?>
            <h1><?php echo get_post($approach_id)->post_title; ?><!-- Our Approach --></h1>
    </div> <!-- container-fluid -->

    <div class="main-container approach-tabs">
           <?php echo get_post($approach_id)->post_content;?>
    </div> <!-- main-container -->

    <div class="main-container impact-ribbon">
            <?php $impact_id = 141; ?>
            <?php echo get_post($impact_id)->post_content;?>
    </div>
<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>
