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

