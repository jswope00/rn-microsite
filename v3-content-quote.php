<div class="item-isotope <?php echo os_list_categories_for_filtering(get_the_ID()); ?>" <?php echo os_item_data(); ?>>
<article id="post-<?php the_ID(); ?>" <?php post_class('pluto-post-box'); ?>>
  <?php
  $post_thumbnail_arr = wp_get_attachment_image_src( get_post_thumbnail_id(), "post-thumbnail" );
  if($post_thumbnail_arr) {
    $css_style = "background-image: url(". $post_thumbnail_arr[0] .");";
  }else{
    $css_style = "";
  }
  ?>
  <div class="post-body" style="<?php echo $css_style; ?>">

    <?php if(has_post_thumbnail()): ?>
      <div class="image-fader"></div>
    <?php endif?>
    <div class="quote-content">
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
      <div class="quote-icon"><i class="os-icon-thin-042_comment_quote_reply"></i></div>
      <h2 class="post-content entry-content"><a><?php echo os_quote_excerpt(25); ?></a></h2>
      <div class="quote-author">- <?php the_field('quote_author'); ?></div>
    </div>
  </div>
</article>
</div>