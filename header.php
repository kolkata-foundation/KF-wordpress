<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href='<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css' rel='stylesheet' type="text/css">
<link href='<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css' rel='stylesheet' type="text/css">
<link href='<?php echo get_template_directory_uri(); ?>/style.css' rel='stylesheet' type="text/css"> 

<meta property="og:url"         content="https://www.kolkatafoundation.org/" />
<meta property="og:type"        content="website" />
<meta property="og:title"       content="Kolkata Foundation" />
<meta property="og:description" content="Uniting around the world to fight poverty in Kolkata" />
<meta property="og:image"       content="https://www.kolkatafoundation.org/wp-content/uploads/2020/07/logo-300x84.png" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <header>
        <img src="<?php echo get_template_directory_uri(); ?>/images/top-image.jpg" alt="top-image" class="top-image img-responsive">
        
        <div class="main-container top-head">
       	    <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 logo-col">
                    <?php if ( get_header_image() ) : ?>
		       <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image img-responsive" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
                    <?php endif; ?>
                </div> <!-- col-lg-3 -->
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 slogan">
                    <p>Uniting around the world to fight poverty in Kolkata</p>
                    <h4>100% of your donation goes directly to fighting poverty</h4>
                </div> <!-- col-lg-6 -->
                
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 right-head">
                    <ul class="social">
                        <li class="fb"><a href="https://www.facebook.com/kolkatafoundation" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li class="yt"><a href="https://youtu.be/bD6n7KdyPic" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                    <a href="https://kolkatafoundation.org/donation-form/" class="donate-btn">DONATE</a>
                </div> <!-- col-lg-3 -->
        	</div> <!-- row -->            
        </div> <!-- main-container -->
        
        <div class="main-container">
            <nav class="menubar">
                 <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
            </nav>
        </div> <!-- main-container -->
    </header>
