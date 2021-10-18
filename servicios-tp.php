<?php
  $page = get_page_by_path('servicios');
  $post = get_post($page->ID);
  $content = $post->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $image = get_the_post_thumbnail_url($post);
  $title = get_the_title($post);
  wp_reset_postdata();
  $articles = '';
  $query = array(
    'numberposts' => 3,
    'meta_key' => 'order',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'servicios'
  );

  $entries = wp_get_recent_posts( $query);
  $conteo = 0;
  foreach ($entries as $entry) {
    $articles.= "<article class='servicios__article servicios__article-".$conteo."' data-tab=".$conteo.">";
    $articles.= "  <div class='servicios__article-ico'>";
    $articles.= "    <img src='".get_the_post_thumbnail_url($entry['ID'])."' class='servicios__ico'/>";
    $articles.= "  </div>";
    $articles.= "  <div class='servicios__info'>";
    $articles.= "    <h4>".get_the_title($entry['ID'])."</h4>";
    $articles.= "    <div class='servicios__article-text'>".get_post_field('post_content', $entry['ID'])."</div>";
    $articles.= "  </div>";
    $articles.= "</article>";
    $conteo++;
  }
?>

<section class="servicios" style="background-image: url('<?php echo $image; ?>')">
  <a name="servicios"></a>
  <h2><?php echo $title?></h2>
  <div class="container">
    <figure class="servicios__figure">
      <?php echo $content;?>
    </figure>

    <!-- If the image is not a bg, use it inside a figure -->
    <div class="servicios__articles">
      <?php echo $articles?>
    </div>
  </div>
</section>