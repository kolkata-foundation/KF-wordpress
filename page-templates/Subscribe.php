 <?php
/**
 * Template Name: Subscribe Page Template
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

<div class="main-container about-us-banner">
    <?php  while ( have_posts() ) : the_post(); ?>
        <?php  if ( has_post_thumbnail() ) : ?>
            <?php  the_post_thumbnail(); ?>
        <?php endif; ?>
 </div>

 <div class="main-container news-container volunteer-section">
     <div class="row">
        <div class="col-lg-12 text-center news-title">
            <h1>Newsletters Sign Up</h1>
        </div>
     </div>

     <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 news-column Newsletters_Subscription">
            <?php the_content(); ?>
            <?php endwhile; // end of the loop. ?>
        </div>

     </div>
 </div>





<?php get_footer(); ?>
