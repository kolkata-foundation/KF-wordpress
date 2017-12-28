<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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

	<div class="main-container news-container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 news-title">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php endwhile; // end of the loop. ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>