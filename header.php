<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header id="header" role="banner" class="flex header" style="background-image: url('http:<?php echo the_post_thumbnail_url(); ?>')">
    <div class="header__top">
      <div class="container">
        <div id="logo" class="header__logo">
          <?php the_custom_logo();?>
        </div>
        <nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement" class="header__nav">
          <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
        </nav>
      </div>
    </div>
    <div class="header__hero">
       <?php the_content(); ?>
       <a href="<?php echo get_site_url()."#".get_post_meta(get_the_ID(), 'btn-link', TRUE);?>" class="btn"><?php echo get_post_meta(get_the_ID(), 'btn-label', TRUE);?></a>
    </div> 

  </header>