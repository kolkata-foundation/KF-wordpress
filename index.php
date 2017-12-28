 <?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<!-- <div id="primary" class="site-content">
		<div id="content" role="main">
		<?php // if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php // while ( have_posts() ) : the_post(); ?>
				<?php // get_template_part( 'content', get_post_format() ); ?>
			<?php // endwhile; ?>

			<?php // kolkatagives_content_nav( 'nav-below' ); ?>

		<?php // else : ?>

			<article id="post-0" class="post no-results not-found">

			<?php // if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php // _e( 'No posts to display', 'kolkatagives' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php // printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'kolkatagives' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->

			<?php // else :
				// Show the default message to everyone else.
			?>
		<!--		<header class="entry-header">
					<h1 class="entry-title"><?php // _e( 'Nothing Found', 'kolkatagives' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php // _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'kolkatagives' ); ?></p>
					<?php // get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php // endif; // end current_user_can() check ?>

	<!--		</article><!-- #post-0 -->

		<?php // endif; // end have_posts() check ?>

<!--		</div><!-- #content -->
<!--	</div><!-- #primary -->
 <div class="main-container about-us-banner">
     <!-- <img src="images/about_banner.jpg" alt="banner-image" class="img-responsive"> -->
     <?php $news_id= 19;?>
     <?php echo get_the_post_thumbnail($news_id); ?>
 </div>

 <div class="main-container news-container">
     <div class="row">
        <div class="col-lg-12 text-center news-title">
            <h1>News & Media</h1>
        </div>
     </div>

     <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 news-column">
           <!-- <h3>Kolkata Foundation In the News</h3> -->
            <?php    if ( have_posts() ) : ?>
            <?php $format = "F jS, Y";
            $categories = get_the_category();
            $separator = ', ';
            $output = ''; ?>
                 <?php /* Start the Loop */ ?>
                 <?php while ( have_posts() ) : the_post(); ?>
                 <article>
                         <!-- <img src="http://www.graycellsweb.in/demo/kolkatagives/wp-content/uploads/2016/06/news-1.jpg" alt="image"> -->
                     <?php the_post_thumbnail(); ?>
                         <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><i><?php kolkatagives_entry_meta();?></span></i></p>
                        <p><?php the_excerpt(); ?> <a href="<?php the_permalink(); ?>"> more</a></p>

                  </article>
                  <div class="clear"></div>
                 <?php endwhile; ?>
            <?php blog_numeric_posts_nav(); ?>

            <?php // kolkatagives_content_nav( 'nav-below' ); ?>
             </div>

             <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pres-release">
                 <?php get_sidebar(); ?>
             </div>
             <?php else : ?>

                 <article id="post-0" class="post no-results not-found">

                     <?php if ( current_user_can( 'edit_posts' ) ) :
                         // Show a different message to a logged-in user who can add posts.
                         ?>
                         <header class="entry-header">
                             <h1 class="entry-title"><?php _e( 'No posts to display', 'kolkatagives' ); ?></h1>
                         </header>

                         <div class="entry-content">
                             <p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'kolkatagives' ), admin_url( 'post-new.php' ) ); ?></p>
                         </div><!-- .entry-content -->

                     <?php else :
                         // Show the default message to everyone else.
                         ?>
                         <header class="entry-header">
                             <h1 class="entry-title"><?php _e( 'Nothing Found', 'kolkatagives' ); ?></h1>
                         </header>

                         <div class="entry-content">
                             <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'kolkatagives' ); ?></p>
                             <?php get_search_form(); ?>
                         </div><!-- .entry-content -->
                     <?php endif; // end current_user_can() check ?>

                 </article><!-- #post-0 -->

             <?php endif; // end have_posts() check ?>
     </div>
 </div>





<?php get_footer(); ?>
