<?php
/*
* Template Name: Masonry Condensed Hearts
*/
get_header(); ?>
<div class="main-content-w">
    <?php require_once(get_template_directory() . '/inc/partials/hero-image.php') ?>
    <?php require_once(get_template_directory() . '/inc/partials/featured-slider.php') ?>
    <?php osetin_show_filter_bar();

  echo '<div class="index-filter-days">';
    echo '<a href="/rnmicrosite/2017/08/06"><button class="index-filter-option">Day 1</button></a>';
    echo '<a href="/rnmicrosite/2017/08/07"><button class="index-filter-option">Day 2</button></a>';
    echo '<a href="/rnmicrosite/2017/08/08"><button class="index-filter-option">Day 3</button></a>';
    echo '<a href="/rnmicrosite/2017/08/09"><button class="index-filter-option">Day 4</button></a>';
  echo '</div>';
    ?>


    <div class="os-container-bottom">
      <div class="index-filter-bar color-scheme-light">
        <div class="index-filter-w">
          <!--<div class="index-filter-label"><i class="os-new-icon os-new-icon-thin-0041_filter_funnel"></i><span>Filter</span></div>-->
            <div class="index-filter-categories">
              <?php {
              $categories_to_show_as_buttons = osetin_get_field('categories_to_show_as_buttons', $post_id, false);
              $index = 1;
              echo '<div class="index-filter-sub-label">'.esc_html__('Category', 'pluto').'</div>';
              foreach($categories_to_show_as_buttons as $category_id){
                // if($index == 4) break;
                echo '<button class="index-filter-option index-filter-option-'.$category_id.'" data-filter-value="filter-cat-'.$category_id.'">'.get_the_category_by_ID($category_id).'</button>';
                $index++;
              }
              } ?>
            </div>
        </div>
      </div>
    </div>
          
<div class="main-content-m">
  <?php os_the_primary_sidebar('left', true); ?>
  <div class="main-content-i">
    <div class="content side-padded-content">
      <?php require_once(get_template_directory() . '/inc/partials/top-ad-sidebar.php') ?>
      <div id="primary-content" data-page-id="<?php echo get_the_ID(); ?>" class="index-isotope v3 <?php echo os_lightbox_posts_enabled_class(); ?>" data-layout-mode="<?php echo (os_get_use_fixed_height_index_posts() == true) ? 'fitRows' : 'masonry'; ?>">
        <?php
        require_once(get_template_directory() . '/inc/osetin-custom-index-query.php');

        $double_width_posts_arr = osetin_get_double_width_posts_arr();
        $os_current_box_counter = 1; $os_ad_block_counter = 0;


        $stickyArgs = array( 
          'posts_per_page' => get_option('posts_per_page'), 
          'post__in'  => get_option( 'sticky_posts' ),
          'ignore_sticky_posts' => 1
        );
        $osetin_sticky = new WP_Query( $stickyArgs );

        while ($osetin_sticky->have_posts()) : $osetin_sticky->the_post(); ?>
           <?php get_template_part( 'v3-content', get_post_format() ); ?>
        <?php endwhile; ?>


        <?php
        if ( $osetin_query->have_posts() ) : while ( $osetin_query->have_posts() ) : $osetin_query->the_post(); ?>
          <?php get_template_part( 'v3-content', get_post_format() ); ?>
          <?php os_ad_between_posts(); ?>
        <?php endwhile; endif; ?>

      </div>
      <?php if(os_get_next_posts_link($osetin_query)): ?>
        <div class="isotope-next-params" data-params="<?php echo os_get_next_posts_link($osetin_query); ?>" data-layout-type="v3"></div>
        <?php if((os_get_current_navigation_type() == 'infinite_button') || (os_get_current_navigation_type() == 'infinite')): ?>
        <div class="load-more-posts-button-w">
          <a href="#"><i class="os-icon-plus"></i> <span><?php _e('Load More Posts', 'pluto'); ?></span></a>
        </div>
        <?php endif; ?>
      <?php endif; ?>
      <?php
      $temp_query = $wp_query;
      $wp_query = $osetin_query; ?>

      <div class="pagination-w hide-for-isotope">
        <?php if(function_exists('wp_pagenavi') && os_get_current_navigation_type() != 'default'): ?>
          <?php wp_pagenavi(); ?>
        <?php else: ?>
          <?php posts_nav_link(); ?>
        <?php endif; ?>
      </div>
      <?php $wp_query = $temp_query; ?>
      <?php wp_reset_postdata(); ?>
    </div>
    </div>
  <?php os_the_primary_sidebar('right', true); ?>
  </div>
    <?php os_footer(); ?>
</div>
<?php
get_footer();
?>