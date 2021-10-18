<?php
  $page = get_page_by_path('servicios');
  $post = get_post($page->ID);
  $content = $post->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $image = get_the_post_thumbnail_url($post);
  $title = get_the_title($post);?>

<section class="servicios" style="background-image: url('<?php echo the_post_thumbnail_url(); ?>')">
  <a name="servicios"></a>
  <h2><?php echo $title?></h2>
  <div class="container">
    
    <!-- If the image is not a bg, use it inside a figure -->
    <div class="servicios__articles">
      <article class="servicios__article">

        <div class="section__content servicios__content">
          <?php echo $content?>
        </div>

        <!-- If the btn-label and btn-anchor are filled, please show the button -->
        <?php if( get_post_meta($page->ID, 'btn-label', TRUE) && get_post_meta($page->ID, 'btn-anchor', TRUE) ):
          $btnLabel = get_post_meta($page->ID, 'btn-label', TRUE);
          $btnLink = get_post_meta($page->ID, 'btn-anchor', TRUE);?>
        <a href="<?php echo get_site_url()."#".$btnLink;?>" class="btn"><?php echo $btnLabel;?></a>
        <?php endif;?>
      </article>
    </div>

    <figure class="servicios__figure">
      <img src="<?php echo $image?>"/>
    </figure>
  </div>
</section>