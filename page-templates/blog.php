<?php
/**
 * Template Name: Blog Page Template
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
      <div class="blog-page-banner"> 
         <img src="https://www.kolkatafoundation.org/wp-content/uploads/2020/10/Ekatra-Unnayan-1.png" width="1140px"></img>
          <h1><center><?php echo the_title(); ?></center></h1> 
      </div>        
    </div>
    <div class="spacer"/>
    <div class="main-container ngo-page-content">
      <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	  <div class="entry-content">
            <?php  while ( have_posts() ) : the_post(); ?>
              <?php the_content(); ?>
           <?php endwhile; // end of the loop. ?>
          </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
         <?php
                  $my_id = 1358;
                  $post_id_5369 = get_post($my_id);
                  $content = $post_id_5369->post_content;
                  $content = apply_filters('the_content', $content);
                  $content = str_replace(']]>', ']]>', $content);
                  echo $content;
         ?>
      </div><!-- col-lg-3 col-md-3 -->
    </div><!-- main-container ngo-page-content" -->

<?php get_footer(); ?> 
