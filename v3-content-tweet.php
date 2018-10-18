<div class="item-isotope <?php echo os_list_categories_for_filtering(get_the_ID()); ?>" <?php echo os_item_data(); ?>>
  <article id="post-<?php the_ID(); ?>" <?php post_class('pluto-post-box'); ?>>
    <div class="post-body">
      <?php osetin_top_social_share_index(); ?>
<!-- 	  Hide double photo from tweets..
 -->      <?php osetin_get_media_content(); ?>
<!-- 	  ..End Hide double photo from tweets
 -->
      <?php if(os_is_post_element_active('title') || os_is_post_element_active('category') || os_is_post_element_active('excerpt')){ ?>

        <div class="post-content-body">
              <!-- :: AUDIO PLAYING LOGIC START :: -->
          <?php

            $tempAuthor = get_field('audio_author');
            $author = wp_get_current_user();
            $fileString =  get_the_ID() . '+';
            $files = glob(ABSPATH . 'sounds/' . $fileString . '*.mp3');
            if(count($files) > 0) {
              usort($files, function($a,$b){
                return filemtime($b) - filemtime($a);
              });
              $audioExists = true;
              $audioSrc = get_site_url() . '/sounds/' . basename($files[0]);
              $email = get_string_between(basename($audioSrc), '+', '+');
            };
            if(!isset($audioSrc)) {
              $audioSrc = get_field('audio');
              $email = get_field('audio_author') ? get_field('audio_author')['user_email'] : '';
            }

            $user =  get_avatar($email);
            if(isset($audioSrc)) {
              // $avatar = get_url_avatar($user);
              $doc = new DOMDocument();
              $doc->loadHTML($user);
              $imageTags = $doc->getElementsByTagName('img');

              foreach($imageTags as $tag) {
                  $avatar = $tag->getAttribute('src');
              }
            }

            ?>
         <?php
         if($audioSrc) {
          $tempAuthor = get_field('audio_author');
          ?>
          <div class="audio" id="audio" data-id="<?php echo the_ID(); ?>" data-audio="<?php echo $audioSrc; ?>">
            <div class="avatar-audio" style="background-image: url('<?php echo $avatar; ?>')">
              <i class='fa fa-play'></i>
            </div>
              <div class="d-none">
                <?php echo get_field('audio'); ?>
              </div>
            </div>
            <?php } ?>
          <!-- :: AUDIO PLAYING LOGIC START :: -->
                       <!-- :: AUDIO RECORDING LOGIC START :: -->
           <?php if(is_user_logged_in()){ ?>

            <div class="record" id="record" data-id="<?php echo the_ID(); ?>" data-user="<?php echo $author->user_email ?>"  data-audio="<?php echo get_field('audio'); ?>">
              <div class="record-audio">
                <i class='fa fa-microphone'></i>
              </div>
              <div class="d-none">
                <?php echo get_field('audio'); ?>
              </div>
            </div>
            <form id="test-form" action="">
              <input type="hidden" id="input-test" name="input-test" value="<?php the_field('downloaded'); ?>">
            </form>
         <?php } ?>
          <!-- :: AUDIO RECORDING LOGIC START :: -->
          <?php if('tweet' == get_post_type() ){ ?>
            <?php the_content(); ?>
          <?php }else{ ?>
            <?php if(os_is_post_element_active('title')): ?>
              <h4 class="post-title entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
            <?php endif; ?>
            <?php if(os_is_post_element_active('excerpt')): ?>
              <div class="post-content entry-summary"><?php echo os_excerpt(get_field('index_excerpt_length', 'option'), os_is_post_element_active('read_more')); ?></div>
            <?php endif; ?>
            <?php if(os_is_post_element_active('external_link_button')): ?>
              <?php echo osetin_get_external_link_button(); ?>
            <?php endif; ?>
          <?php } ?>
          <?php if(os_is_post_element_active('category')): ?>
            <?php echo get_the_category_list(); ?>
          <?php endif; ?>
        </div>
      <?php } ?>
    </div>
    <?php if(os_is_post_element_active('date') || os_is_post_element_active('author') || os_is_post_element_active('like') || os_is_post_element_active('view_count')): ?>
      <div class="post-meta entry-meta">

        <?php global $show_author_face; ?>
        <?php if(!isset($show_author_face)) $show_author_face = false; ?>
        <?php if($show_author_face){ ?>


            <div class="meta-author-face">
              <div class="meta-author-avatar">
                <?php echo get_avatar(get_the_author_meta('ID')); ?>
              </div>
              <div class="meta-author-info">
                <div class="meta-author-info-by"><?php _e('Written by', 'pluto') ?></div>
                <div class="meta-author-name vcard"><strong><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )) ; ?>" class="url fn n" rel="author"><?php echo get_the_author(); ?></a></strong></div>
              </div>
            </div>

        <?php }else{ ?>
        
          <?php if(os_is_post_element_active('date')): ?>
            <div class="meta-date">
              <i class="fa os-icon-clock-o"></i>
              <time class="entry-date updated" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date('M j'); ?></time>
            </div>
          <?php endif; ?>
          <?php if(os_is_post_element_active('view_count')): ?>
            <div class="meta-view-count">
              <i class="fa os-icon-eye"></i>
              <span><?php if(function_exists('echo_tptn_post_count')) echo do_shortcode('[tptn_views]'); ?></span>
            </div>
          <?php endif; ?>

        <?php } ?>

        <?php if(os_is_post_element_active('like')){ ?>
          <div class="meta-like">
            <?php
            global $likes_type;
            if(!isset($likes_type)) $likes_type = 'regular';
            os_vote_build_button(get_the_ID(), '', false, $likes_type, get_the_permalink()); ?>
          </div>
        <?php } ?>



      </div>
    <?php endif; ?>
  </article>
</div>