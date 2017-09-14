<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Pluto
 * @since Pluto 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php if(get_field("google_plus_authorship_url", "option")): ?>
    <link rel="author" href="<?php the_field('google_plus_authorship_url', 'option'); ?>">
  <?php endif; ?>
  <?php wp_head(); ?>
  <!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
  <![endif]-->
</head>

<body <?php body_class(); ?>>
  <?php if(get_field('google_analytics_code', 'option')): ?>
    <?php the_field('google_analytics_code', 'option'); ?>
  <?php endif; ?>
  <div class="all-wrapper">
  <?php if(get_current_menu_position() == "top"): ?>
    <div class="menu-position-top menu-style-v2">
    <div class="fixed-header-w">
      <div class="menu-block">
        <div class="menu-inner-w">
          <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <?php if(get_field('logo_image', 'option')): ?>
                <img src="<?php the_field('logo_image', 'option'); ?>" alt="">
              <?php endif; ?>
              <?php if(get_field('logo_text', 'option')): ?>
                <div class="logo_text">
                  <span><?php the_field('logo_text', 'option'); single_cat_title($prefix=": ");?></span>
                  <?php if(is_category('gout-crystal')) { ?>
                    <br><h5>Expanded coverage of Gout sponsored by Horizon Pharma</h5>
                  <?php } elseif(is_category('psa-spa')) { ?>
                    <br><h5>Expanded coverage of Psoriatic Arthritis sponsored by Novartis Pharmaceuticals</h5>
                  <?php } elseif(is_category('biologic-novel-rx')) { ?>
                    <br><h5>Expanded coverage of Biologics sponsorsed by AstraZeneca</h5>
                  <?php } ?>
                </div>
              <?php endif; ?>
            </a>
          </div>
          <div class="sponsor">
            <a href="https://www.google.com">
              <span>Sponsored by: </span>
                <?php if(is_category('gout-crystal')) { ?>
                  <img src="https://upload.wikimedia.org/wikipedia/en/f/fd/Horizon_Pharma_logo.jpg" style="width: 100px;" alt="">
                <?php } elseif(is_category('psa-spa')) { ?>
                  <img src="http://www.celgene.com/content/themes/celgene_2016/img/celgene-mobile-logo.png" style="height: 60px;" alt="">
                <?php } elseif(is_category('biologic-novel-rx')) { ?>
                  <img src="biologic" style="height: 60px;" alt="">
                <?php } else { ?>
                <img src="https://upload.wikimedia.org/wikipedia/commons/1/1e/Lilly-Logo.svg" style="width: 100px;" alt="">
                <?php } ?>
            </a>
          </div>
		  <!--Hide Main menu on desktop..
          <div class="menu-activated-on-hover menu-w">
            <?php wp_nav_menu(array('theme_location'  => 'side_menu', 'fallback_cb' => false, 'container_class' => 'os_menu')); ?>
          </div>
		  ..End Hide Main Menu-->
          <?php if(!get_field('hide_search_box_from_top_bar', 'option')){ ?>
            <div class="menu-search-form-w <?php if(!get_field('no_hide_search_box_on_smaller_screens', 'option')) echo 'hide-on-narrow-screens'; ?>">
              <div class="search-trigger"><i class="os-icon-search"></i></div>
            </div>
          <?php } ?>
          <div class="menu-social-w hidden-sm hidden-md">
            <?php if( function_exists('zilla_social') ) zilla_social(); ?>
          </div>
        </div>
      </div>
    </div>
    </div>
  <?php endif; ?>
  <div class="menu-block <?php if(get_field('hide_widgets_under_menu', 'option') == TRUE) echo 'hidden-on-smaller-screens'; ?>">
    <?php if(get_current_menu_position() == "top"): ?>
      <?php if(get_current_menu_style() == 'v2'){ ?>
        <div class="menu-inner-w">
          <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <?php if(get_field('logo_image', 'option')): ?>
                <img src="<?php the_field('logo_image', 'option'); ?>" alt="">
              <?php endif; ?>
              <?php if(get_field('logo_text', 'option')): ?>
              <div class="logo_text">
                <span><?php the_field('logo_text', 'option'); single_cat_title($prefix=": ");?></span>
                <?php if(is_category('gout-crystal')) { ?>
                  <br><h5>Expanded coverage of Gout sponsored by Horizon Pharma</h5>
                <?php } elseif(is_category('psa-spa')) { ?>
                  <br><h5>Expanded coverage of Psoriatic Arthritis sponsored by Novartis Pharmaceuticals</h5>
                <?php } elseif(is_category('biologic-novel-rx')) { ?>
                  <br><h5>Expanded coverage of Biologics sponsorsed by AstraZeneca</h5>
                <?php } ?>
              </div>
              <?php endif; ?>
            </a>
          </div>
          <div class="sponsor">
            <a href="https://www.google.com">
              <span>Sponsored by: </span>
                <?php if(is_category('gout-crystal')) { ?>
                  <img src="https://upload.wikimedia.org/wikipedia/en/f/fd/Horizon_Pharma_logo.jpg" style="width: 100px;" alt="">
                <?php } elseif(is_category('psa-spa')) { ?>
                  <img src="http://www.celgene.com/content/themes/celgene_2016/img/celgene-mobile-logo.png" style="height: 60px;" alt="">
                <?php } elseif(is_category('biologic-novel-rx')) { ?>
                  <img src="biologic" style="height: 60px;" alt="">
                <?php } else { ?>
                <img src="https://upload.wikimedia.org/wikipedia/commons/1/1e/Lilly-Logo.svg" style="width: 100px;" alt="">
                <?php } ?>
            </a>
          </div>
		  <!--Hide Main menu on desktop..
          <div class="menu-activated-on-hover menu-w">
            <?php wp_nav_menu(array('theme_location'  => 'side_menu', 'fallback_cb' => false, 'container_class' => 'os_menu')); ?>
          </div>
	  	  ..End Hide Main menu-->
          <?php if(!get_field('hide_search_box_from_top_bar', 'option')){ ?>
            <div class="menu-search-form-w <?php if(!get_field('no_hide_search_box_on_smaller_screens', 'option')) echo 'hide-on-narrow-screens'; ?>">
              <div class="search-trigger"><i class="os-icon-search"></i></div>
            </div>
          <?php } ?>
          <div class="menu-social-w hidden-sm hidden-md">
            <?php if( function_exists('zilla_social') ) zilla_social(); ?>
          </div>
        </div>
      <?php }else{ ?>
      <div class="menu-inner-w">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-4">
              <?php if( function_exists('zilla_social') ) zilla_social(); ?>
            </div>
            <div class="col-sm-4">
              <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <?php if(get_field('logo_image', 'option')): ?>
                    <img src="<?php the_field('logo_image', 'option'); ?>" alt="">
                  <?php endif; ?>
                  <?php if(get_field('logo_text', 'option')): ?>
                    <span><?php the_field('logo_text', 'option'); ?></span>
                  <?php endif; ?>
                </a>
              </div>
            </div>
            <div class="col-sm-4">
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
      </div>
	  <!--Hide Main menu on desktop..
      <div class="menu-activated-on-hover">
        <?php wp_nav_menu(array('theme_location'  => 'side_menu', 'fallback_cb' => false, 'container_class' => 'os_menu')); ?>
      </div>
	  ..End Hide Main menu-->
      <?php } ?>

    <?php else: ?>

      <div class="menu-left-i">
      <div class="logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php if(get_field('logo_image', 'option')): ?>
            <img src="<?php the_field('logo_image', 'option'); ?>" alt="">
          <?php endif; ?>
          <?php if(get_field('logo_text', 'option')): ?>
            <span><?php the_field('logo_text', 'option'); ?></span>
          <?php endif; ?>
        </a>
      </div>
      <?php if(get_field('search_form_position', 'option') == 'above_menu') get_search_form(); ?>

      <div class="divider"></div>

      <div class="menu-activated-on-click">
        <?php wp_nav_menu(array('theme_location'  => 'side_menu', 'fallback_cb' => false, 'container_class' => 'os_menu')); ?>
      </div>


      <?php if(get_field('search_form_position', 'option') == 'under_menu') get_search_form(); ?>



      <div class="divider"></div>

      <?php if(get_field('search_form_position', 'option') == 'above_social') get_search_form(); ?>


      <?php if( function_exists('zilla_social') ) zilla_social(); ?>


      <?php if(get_field('search_form_position', 'option') == 'under_social') get_search_form(); ?>



      <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
        <div class="under-menu-sidebar-wrapper">
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
        </div>
      <?php endif; ?>


      </div>

    <?php endif; ?>
  </div>
  <div class="os-container">
    <div class="featured-items-header">
      <span class="featured-items-title">FEATURED COVERAGE:</span>
      <div class="dtr-catboxes-wrapper clearfix">

        <ul class="dtr-col-list dtr-col-gap-30px dtr-col-4">
          <li>
            <div class="dtr-catbox dtr-catbox1 clearfix" style="background-image: url(http://www.scrap.johnswope.com/rnmicrosite/wp-content/uploads/2017/08/pills_blue.jpg)"> <a class="dtr-catbox-link" href="<?php echo esc_url( home_url( '/category/gout-crystal' ) ); ?>" title="#"> Gout </a></div>
          </li>
          <li>
            <div class="dtr-catbox dtr-catbox2 clearfix" style="background-image: url(http://www.scrap.johnswope.com/rnmicrosite/wp-content/uploads/2017/08/spine.jpg)"> <a class="dtr-catbox-link" href="<?php echo esc_url( home_url( '/category/gout-crystal' ) ); ?>" title="#"> Ankylosing Spondylitis </a></div>
          </li>
          <li>
            <div class="dtr-catbox dtr-catbox3 clearfix" style="background-image: url(http://www.scrap.johnswope.com/rnmicrosite/wp-content/uploads/2017/08/knee-1406964_1280.jpg)"> <a class="dtr-catbox-link" href="<?php echo esc_url( home_url( '/category/psa-spa' ) ); ?>" title="#"> Psoriatic Arthritis </a></div>
          </li>
          <li>
            <div class="dtr-catbox dtr-catbox4 clearfix" style="background-image: url(http://www.scrap.johnswope.com/rnmicrosite/wp-content/uploads/2017/08/dna-163466_640.jpg)"> <a class="dtr-catbox-link" href="<?php echo esc_url( home_url( '/category/biologic-novel-rx' ) ); ?>" title="#"> Biosimilars </a></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--Comment out menu..
  <?php echo do_shortcode('[slide-anything id="1558"]'); ?>
  ..End Comment out Menu-->
  <div class="menu-toggler-w">
    <a href="#" class="menu-toggler">
      <i class="os-new-icon os-new-icon-menu"></i>
      <span class="menu-toggler-label"><?php _e('Menu', 'pluto') ?></span>
    </a>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
      <?php if(get_field('logo_image', 'option')): ?>
        <img src="<?php the_field('logo_image', 'option'); ?>" alt="">
      <?php endif; ?>
      <?php if(get_field('logo_text', 'option')): ?>
        <span><?php the_field('logo_text', 'option'); ?></span>
      <?php endif; ?>
    </a>
    <?php if(is_category('gout-crystal')) { ?>
      <br><span style="padding-bottom: 10px;">Expanded Gout coverage sponsored by Horizon Pharma<span>
    <?php } elseif(is_category('psa-spa')) { ?>
      <br><span style="padding-bottom: 10px;">Expanded Psoriatic Arthritis coverage sponsored by Novartis Pharmaceuticals<span>
    <?php } elseif(is_category('biologic-novel-rx')) { ?>
      <br><span style="padding-bottom: 10px;">Sponsored by Other<span>
    <?php } else { ?>
      <br><span style="padding-bottom: 10px;">Sponsored by Horizon Pharma<span>
    <?php } ?>

      <a href="#" class="sidebar-toggler">
        <i class="os-new-icon os-new-icon-grid"></i>
        <span class="sidebar-toggler-label"><?php _e('Sidebar', 'pluto') ?></span>
      </a>
  </div>
  <div class="mobile-menu-w">
    <?php wp_nav_menu(array('theme_location'  => 'side_menu', 'fallback_cb' => false, 'container_class' => 'mobile-menu menu-activated-on-click')); ?>
  </div>
  <?php if(get_field('show_sidebar_on_mobile', 'option')){ ?>
    <div class="sidebar-main-toggler">
      <i class="os-new-icon os-new-icon-grid"></i>
    </div>
  <?php } ?>