<?php // Opening PHP tag - nothing should be before this, not even whitespace
add_action( 'wp_enqueue_scripts', 'pluto_child_enqueue_styles' );
function pluto_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );

add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {

    wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );

}
function my_acf_update_value( $value, $post_id, $field  ) {
  // only do it to certain custom fields
  die();
  if( $field['name'] == 'audio' ) {
    die();
      // get the old (saved) value
      // $old_value = get_field('custom_field_name', $post_id);

      // // get the new (posted) value
      // $new_value = $_POST['acf']['field_1234567890abc'];

      // // check if the old value is the same as the new value
      // if( $old_value != $new_value ) {
      //     // Do something if they are different
      // } else {
      //     // Do something if they are the same
      // }
  }

// don't forget to return to be saved in the database
  return $value;

}

// acf/update_value - filter for every field
add_filter('acf/update_value', 'my_acf_update_value', 10, 3);
function get_string_between($string, $start, $end){
  $string = ' ' . $string;
  $ini = strpos($string, $start);
  if ($ini == 0) return '';
  $ini += strlen($start);
  $len = strpos($string, $end, $ini) - $ini;
  return substr($string, $ini, $len);
}
function test_function() {
  // Set variables
  $input_test = $_POST['input-test'];
  // Check variables for fallbacks
  if (!isset($input_test) || $input_test == "") { $input_test = "Fall Back"; }
  // Update the field
  update_field('downloaded', $input_test);
}
add_action( 'wp_ajax_nopriv_test_function',  'test_function' );
add_action( 'wp_ajax_test_function','test_function' );

  function get_manual_content($size = false, $forse_single = false)
  {
    if(get_post_type() == 'live_video') {
      $embedVideo = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' . get_field('video') . '?autoplay=' . get_field("autoplay") . '"  frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>';
      echo $embedVideo;
      return;
    }
    switch(get_post_format()):
      case "video": ?>
        <div class="post-video-box post-media-body"  data-featured-image-url="<?php if(has_post_thumbnail()) the_post_thumbnail_url( 'thumbnail' ); ?>">
          <?php
          global $wp_embed;
          echo $wp_embed->run_shortcode('[embed]'.get_field('video_url').'[/embed]');
          ?>
        </div>
        <?php
      break;
      case "gallery": ?>
        <?php
          $images = get_field('gallery_of_images');
          if( $images ){
            $images_arr = array();
            $padding_style = '';
            $max_proportion = 0;
            foreach( $images as $image ){
              if($size != false){
                $img_size = $size;
              }else{
                if(is_single()){
                  $img_size = 'large';
                }else{
                  if(os_get_use_fixed_height_index_posts() == true){
                    $img_size = 'pluto-fixed-height';
                  }else{
                    if(osetin_get_double_width_class() != ''){
                      $img_size = 'pluto-full-width';
                    }else{
                      $img_size = 'pluto-index-width';
                    }
                  }
                }
              }
              $img_src = $image['sizes']["{$img_size}"];

              if(!empty($image['sizes']["{$img_size}-width"]) && !empty($image['sizes']["{$img_size}-height"])){
                // calculate ratio percentage by dividing height on width and times 100 to get percent
                $max_proportion = max(((floor($image['sizes']["{$img_size}-height"] / $image['sizes']["{$img_size}-width"] * 100) / 100)  * 100), $max_proportion);
              }
              if($img_src) array_push($images_arr, array('src' => $img_src, 'alt' => $image['alt']));
            }
            if($max_proportion > 0) $padding_style = 'padding-bottom: '.$max_proportion.'%;';
            ?>
            <div class="post-gallery-box post-media-body" data-featured-image-url="<?php if(has_post_thumbnail()) the_post_thumbnail_url( 'thumbnail' ); ?>">
              <figure <?php if($padding_style != '') echo 'class="abs-slider" style="'.$padding_style.'"'; ?>>
                <div id="slider-<?php the_ID(); ?>" class="flexslider">
                  <ul class="slides">
                    <?php foreach( $images_arr as $image_arr ){
                      echo '<li><img src="'.$image_arr['src'].'" alt="'.$image_arr['alt'].'" /></li>';
                    } ?>
                  </ul>
                </div>
              </figure>
            </div><?php
          }else{
            os_output_post_thumbnail($size, $forse_single);
          } ?>
        <?php
      break;
      case "image":
        os_output_post_thumbnail($size, $forse_single);
      break;
      default:
        os_output_post_thumbnail($size, $forse_single);
      break;
    endswitch;
  }
function url_to_domain($url)
{
    $host = @parse_url($url, PHP_URL_HOST);
    // If the URL can't be parsed, use the original URL
    // Change to "return false" if you don't want that
    if (!$host)
        $host = $url;
    // The "www." prefix isn't really needed if you're just using
    // this to display the domain to the user
    if (substr($host, 0, 4) == "www.")
        $host = substr($host, 4);
    // You might also want to limit the length if screen space is limited
    if (strlen($host) > 50)
        $host = substr($host, 0, 47) . '...';
    return $host;
}



}
wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/assets/js/custom.js', array ( 'jquery' ), 1.1, true);
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
  register_post_type( 'live_video',
  // CPT Options
    array(
      'labels' => array(
        'name' => __( 'Live video' ),
        'singular_name' => __( 'Live video' )
      ),
      'public' => true,
      'has_archive' => true,
      'taxonomies'  => array( 'category' ),
      'rewrite' => array('slug' => 'lives'),
      'supports' => array( 'title', 'editor', 'custom-fields', 'post-formats' )

    )
  );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
// function create_live_format() {


// }
// // Hooking up our function to theme setup
// add_action( 'init', 'create_live_format' );
// Include tweeets inside archive.php
function include_live_videos( $query ) {
  if( $query->is_date() || $query->is_category() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'live_video'
    ));
    $query->set( 'post__not_in', get_option( 'sticky_posts' ));
    return $query;
  }
}
add_filter( 'pre_get_posts', 'include_live_videos' );
// Include tweeets inside archive.php
function include_tweets( $query ) {
  if( $query->is_date() || $query->is_category() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'tweet'
    ));
    $query->set( 'post__not_in', get_option( 'sticky_posts' ));
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
              echo '<a href="'. ACR18_DAY1URL .'"><button class="index-filter-option">Day 1</button></a>';
              echo '<a href="'. ACR18_DAY2URL .'"><button class="index-filter-option">Day 2</button></a>';
              echo '<a href="'. ACR18_DAY3URL .'"><button class="index-filter-option">Day 3</button></a>';
              echo '<a href="'. ACR18_DAY4URL .'"><button class="index-filter-option">Day 4</button></a>';
          echo '</div>';
		  echo '<div class="index-filter-sub-label index-filter-sub-label-about"><a href="/about-us">About this Site</a></div>';
          if(osetin_get_field('hide_clear_filters_button', $post_id) != true){
            echo '<div class="index-clear-filter-w inactive">';
              echo '<button class="index-clear-filter-btn"><i class="os-icon os-icon-thin-delete-circle"></i> <span>'.esc_html__('Clear Filters', 'pluto').'</span></button>';
            echo '</div>';
          }
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
  add_filter('default_hidden_meta_boxes', 'show_hidden_meta_boxes', 10, 2);

function show_hidden_meta_boxes($hidden, $screen) {
    if ( 'post' == $screen->base ) {
        foreach($hidden as $key=>$value) {
            if ('postexcerpt' == $value) {
                unset($hidden[$key]);
                break;
            }
        }
    }

    return $hidden;
}




}
