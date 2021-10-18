<?php if ( $args['slug'] ):
  $slug = $args['slug'];
  $imagePosition = $args['image-position'];
  $imageBg = $args['image-bg'];
  $page = get_page_by_path($args['slug']);
  $post = get_post($page->ID);
  $content = $post->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $image = get_the_post_thumbnail_url($post);
  $title = get_the_title($post);

  if( $imageBg ):?>
  <section class="container <?php echo $slug?> <?php echo $imagePosition?>" style="background-image: url('<?php echo the_post_thumbnail_url(); ?>')">
  <?php else:?>
  <section class="container <?php echo $slug?> section-<?php echo $imagePosition?>">
  <?php endif;?>
    <a name="<?php echo $slug?>"></a>
    <!-- If the image is not a bg, use it inside a figure -->
    <?php if( ! $imageBg ):?>
    <figure class="<?php echo $slug?>__figure">
      <img src="<?php echo $image?>"/>
    </figure>
    <article class="<?php echo $slug?>__article">
      <h2><?php echo $title?></h2>
      <div class="section__content <?php echo $slug?>__content">
        <?php echo $content?>
      </div>

      <!-- If the btn-label and btn-anchor are filled, please show the button -->
      <?php if( get_post_meta($page->ID, 'btn-label', TRUE) && get_post_meta($page->ID, 'btn-anchor', TRUE) ):
        $btnLabel = get_post_meta($page->ID, 'btn-label', TRUE);
        $btnLink = get_post_meta($page->ID, 'btn-anchor', TRUE);?>
      <a href="<?php echo get_site_url()."#".$btnLink;?>" class="btn"><?php echo $btnLabel;?></a>
      <?php endif;?>
    </article>
    <?php endif;?>
  </section>
<?php endif;?>