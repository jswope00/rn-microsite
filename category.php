<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @since Pluto 1.0
 */

get_header(); ?>

<div class="main-content-w">
  <div class="main-content-m">
    <?php os_the_primary_sidebar('left'); ?>
    <div class="main-content-i">
        <?php if ( have_posts() ) : ?>

          <?php osetin_show_filter_bar_modified('option'); ?>
          <?php require_once(get_template_directory() . '/inc/set-layout-vars.php') ?>
          <?php require_once(get_template_directory() . '/inc/osetin-custom-index-query.php'); ?>
          <div class="content side-padded-content">
            <div class="index-isotope v3 <?php echo $isotope_class; ?>" data-layout-mode="<?php echo $layout_mode; ?>">
              <?php $os_current_box_counter = 1; $os_ad_block_counter = 0; ?>


              <?php
                $stickyArgs = array( 
                  'posts_per_page' => get_option('posts_per_page'), 
                  'post__in'  => get_option( 'sticky_posts' ),
                  'ignore_sticky_posts' => 1
                );
                $osetin_sticky = new WP_Query( $stickyArgs );

                while ($osetin_sticky->have_posts()) : $osetin_sticky->the_post(); ?>
                  <?php get_template_part( 'v3-content', get_post_format() ); ?>
                <?php endwhile; ?>

              if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                   <?php get_template_part( 'v3-content', get_post_format() ); ?>
                   <?php os_ad_between_posts(); ?>
              <?php endwhile; endif; ?>

            </div>
            <?php require_once(get_template_directory() . '/inc/isotope-navigation.php') ?>
          </div>
          <?php
        else :

          // If no content, include the "No posts found" template.
          get_template_part( 'content', 'none' );
        endif; ?>
    </div>
    <?php os_the_primary_sidebar('right'); ?>
  </div>
  <?php os_footer(); ?>
</div>

<?php
get_footer();
