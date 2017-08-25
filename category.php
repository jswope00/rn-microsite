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

          <?php osetin_show_filter_bar('option'); ?>
          <?php require_once(get_template_directory() . '/inc/set-layout-vars.php') ?>
          <div class="content side-padded-content">
            <div class="index-isotope <?php echo $isotope_class; ?>" data-layout-mode="<?php echo $layout_mode; ?>">
              <?php $os_current_box_counter = 1; $os_ad_block_counter = 0; ?>
              <?php
              // Start the Loop.
              while ( have_posts() ) : the_post();
                get_template_part( $template_part, get_post_format() );
                os_ad_between_posts();
              endwhile; ?>

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
