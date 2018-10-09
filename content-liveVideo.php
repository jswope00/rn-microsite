<div class="item-isotope <?php echo os_list_categories_for_filtering(get_the_ID()); ?>" <?php echo os_item_data(); ?>>
<article id="post-<?php the_ID(); ?>" <?php post_class('pluto-post-box'); ?>>

  <div class="post-body">
    <div class="quote-content">
      <div class="quote-icon"><i class="os-icon-thin-042_comment_quote_reply"></i></div>
      <h4 class="post-title entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
    </div>
  </div>
</article>
</div>