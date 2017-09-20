<?php // Opening PHP tag - nothing should be before this, not even whitespace
add_action( 'wp_enqueue_scripts', 'pluto_child_enqueue_styles' );
function pluto_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );



}

	  // Our custom post type function
function create_posttype() {

  register_post_type( 'tweet',
  // CPT Options
    array(
      'labels' => array(
        'name' => __( 'Tweets' ),
        'singular_name' => __( 'Tweet' )
      ),
      'public' => true,
      'has_archive' => true,
      'taxonomies'  => array( 'category' ),
      'rewrite' => array('slug' => 'tweets'),
    )
  );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

// Include tweeets inside archive.php
function include_tweets( $query ) {
  if( $query->is_date() || $query->is_category() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'tweet'
    ));
    return $query;
  }
}
add_filter( 'pre_get_posts', 'include_tweets' );

function osetin_show_filter_bar_modified($post_id = false){
  if(!(osetin_get_field('hide_sorting', $post_id) && osetin_get_field('hide_category_filtering', $post_id) && osetin_get_field('hide_format_filtering', $post_id)) && osetin_get_field('show_filter_panel', 'option') && !osetin_get_field('hide_filter_toolbar', $post_id, false)){
    echo '<div class="os-container">';
      $filter_bg_type = os_get_less_var('subBarBackgroundType', 'light');
      $filter_bg_color = osetin_get_field('filter_bar_background_color_option', 'option', false);
      $filter_bg_image_id = osetin_get_field('filter_bar_background_image_option', 'option', false);
      $filter_bg_image_url = false;
      if($filter_bg_image_id){ 
        $filter_bg_image_arr = wp_get_attachment_image_src($filter_bg_image_id, "osetin-for-background");
        if($filter_bg_image_arr && isset($filter_bg_image_arr[0])) $filter_bg_image_url = $filter_bg_image_arr[0];
      }

      $bg_color_css = $filter_bg_color ? 'background-color: '.$filter_bg_color.';' : '';
      $bg_image_css = $filter_bg_image_url ? 'background-image:url('.$filter_bg_image_url.'); background-repeat: repeat;' : '';

      echo '<div class="index-filter-bar color-scheme-'.$filter_bg_type.'" style="'.$bg_color_css.$bg_image_css.'">';
        if(osetin_get_field('hide_sorting', $post_id) != true){
          echo '<div class="index-sort-w">';
            echo '<div class="index-sort-label"><i class="os-new-icon os-new-icon-thin-0245_text_numbered_list"></i><span>'.esc_html__('Order By', 'pluto').'</span></div>';
            echo '<div class="index-sort-options"><button data-sort-value="likes" class="index-sort-option index-sort-hearts">'.esc_html__('Most Likes', 'pluto').'</button><button data-sort-value="views" class="index-sort-option index-sort-views">'.esc_html__('Most Views', 'pluto').'</button></div>';
          echo '</div>';
        }
        echo '<div class="index-filter-w">';
          $categories_to_show_as_buttons = osetin_get_field('categories_to_show_as_buttons', $post_id, false);
          $formats_to_show_in_filter = osetin_get_field('formats_to_show_in_filter', $post_id, false);
          if($formats_to_show_in_filter || $categories_to_show_as_buttons){
            echo '<div class="index-filter-label"><i class="os-new-icon os-new-icon-thin-0041_filter_funnel"></i><span>'.esc_html__('Filter', 'pluto').'</span></div>';
          }
          if(osetin_get_field('hide_category_filtering', $post_id) != true && $categories_to_show_as_buttons){
            //echo '<div class="index-filter-sub-label">'.esc_html__('Category', 'pluto').'</div>';
            echo '<div class="index-filter-categories">';
              $index = 1;
              foreach($categories_to_show_as_buttons as $category_id){
                // if($index == 4) break;
                echo '<button class="index-filter-option" data-filter-value="filter-cat-'.$category_id.'">'.get_the_category_by_ID($category_id).'</button>';
                $index++;
              }
            echo '</div>';
          }
          if(osetin_get_field('hide_format_filtering', $post_id) != true && $formats_to_show_in_filter){
            echo '<div class="index-filter-sub-label">'.esc_html__('Type', 'pluto').'</div>';
            echo '<div class="index-filter-formats">';
              if(in_array( 'standard', $formats_to_show_in_filter )) echo '<div class="index-filter-format" data-filter-value="standard"><i class="os-new-icon os-new-icon-thin-0010_newspaper_reading_news"></i><div class="os-filter-tooltip">'.esc_html__('standard', 'pluto').'</div></div>';
              if(in_array( 'image', $formats_to_show_in_filter )) echo '<div class="index-filter-format" data-filter-value="image"><i class="os-new-icon os-new-icon-thin-0621_polaroid_picture_image_photo"></i><div class="os-filter-tooltip">'.esc_html__('image', 'pluto').'</div></div>';
              if(in_array( 'gallery', $formats_to_show_in_filter )) echo '<div class="index-filter-format" data-filter-value="gallery"><i class="os-new-icon os-new-icon-thin-0618_album_picture_image_photo"></i><div class="os-filter-tooltip">'.esc_html__('gallery', 'pluto').'</div></div>';
              if(in_array( 'video', $formats_to_show_in_filter )) echo '<div class="index-filter-format" data-filter-value="video"><i class="os-new-icon os-new-icon-thin-0587_movie_video_cinema_flm"></i><div class="os-filter-tooltip">'.esc_html__('video', 'pluto').'</div></div>';
              if(in_array( 'quote', $formats_to_show_in_filter )) echo '<div class="index-filter-format" data-filter-value="quote"><i class="os-new-icon os-new-icon-thin-0285_chat_message_quote_reply"></i><div class="os-filter-tooltip">'.esc_html__('quote', 'pluto').'</div></div>';
              if(in_array( 'audio', $formats_to_show_in_filter )) echo '<div class="index-filter-format" data-filter-value="audio"><i class="os-new-icon os-new-icon-thin-0595_music_note_playing_sound_song"></i><div class="os-filter-tooltip">'.esc_html__('audio', 'pluto').'</div></div>';
              if(in_array( 'link', $formats_to_show_in_filter )) echo '<div class="index-filter-format" data-filter-value="link"><i class="os-new-icon os-new-icon-thin-0010_newspaper_reading_news"></i><div class="os-filter-tooltip">'.esc_html__('articles', 'pluto').'</div></div>';
            echo '</div>';
          }
          echo '<div class="index-filter-sub-label">'.esc_html__('Day', 'pluto').'</div>';
          echo '<div class="index-filter-days">';
              echo '<a href="/rnmicrosite/2017/09/06"><button class="index-filter-option">Day 1</button></a>';
              echo '<a href="/rnmicrosite/2017/09/07"><button class="index-filter-option">Day 2</button></a>';
              echo '<a href="/rnmicrosite/2017/09/08"><button class="index-filter-option">Day 3</button></a>';
              echo '<a href="/rnmicrosite/2017/09/09"><button class="index-filter-option">Day 4</button></a>';
          echo '</div>';
          if(osetin_get_field('hide_clear_filters_button', $post_id) != true){
            echo '<div class="index-clear-filter-w inactive">';
              echo '<button class="index-clear-filter-btn"><i class="os-icon os-icon-thin-delete-circle"></i> <span>'.esc_html__('Clear Filters', 'pluto').'</span></button>';
            echo '</div>';
          }
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
}
