<article id="post-<?php the_ID(); ?>" <?php post_class('pluto-page-box'); ?>>
  <div class="post-body">
    <div class="single-post-top-features">

      <?php osetin_single_top_social_share(); ?>
    </div>

    <h1 class="post-title entry-title"><?php the_title(); ?></h1>
    <div class="post-meta-top entry-meta">
      <div class="post-date"><?php _e('Posted on', 'pluto'); ?> <time class="entry-date updated" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time></div>
      <div class="post-author"><?php _e('by', 'pluto'); ?> <strong class="author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )) ; ?>" class="url fn n" rel="author"><?php echo get_the_author(); ?></a></strong></div>
      <?php echo get_the_category_list(); ?>
      <?php the_tags('<ul class="post-tags"><li>','</li><li>','</li></ul>'); ?>
    </div>
    <?php edit_post_link( __( 'Edit', 'twentyfourteen' ), '<div class="edit-link">', '</div>' ); ?>
    <div class="post-content entry-content">
      <?php if(get_field('audio_shortcode')): ?>
        <?php the_content(); ?>
      <?php else: ?>
        <?php osetin_get_media_content(); ?>
        <?php
        $embedVideo = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' . get_field('video') . '?autoplay=true" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>';

          $embedChat = '<iframe width="100%" height="315" src="https://www.youtube.com/live_chat?v=' . get_field('video') . '&amp;embed_domain=' . url_to_domain(home_url()) . '"></iframe>';
            echo $embedVideo;
            echo $embedChat;
        ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="post-meta">
    <div class="meta-like">
      <?php // if( function_exists('zilla_likes') ) zilla_likes(); ?>
      <?php os_vote_build_button(get_the_ID(), '', false, 'facebook'); ?>
    </div>
    <div class="os_social-foot-w"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
  </div>
</article>