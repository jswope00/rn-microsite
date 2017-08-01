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

  register_post_type( 'tweets',
  // CPT Options
    array(
      'labels' => array(
        'name' => __( 'Tweets' ),
        'singular_name' => __( 'Tweet' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'tweets'),
    )
  );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
