<?php
if(get_query_var('page')){
  $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
}else{
  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
}

$args = array(
	'paged' => $paged,
	'posts_per_page' => get_option('posts_per_page'),
	'post_status' => 'publish',
	'post_type' => array('post', 'tweet', 'live_video')

);

$archiveQuery = array(
	'posts_per_page' => get_option('posts_per_page'),
	'post_type' => array('post', 'tweet', 'live_video')

);

$stickyArgs = array(
	'paged'
	'posts_per_page' => get_option('posts_per_page'),
	'post__in'  => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1
);

$osetin_archive = new WP_Query( $archiveQuery );
$osetin_sticky = new WP_Query( $stickyArgs );
$osetin_query = new WP_Query( $args );