<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package astronauta
 */
get_header(); ?>
<main id="content" class="flex column" role="main">
<?php
get_template_part('specific-page', null, array(
  'slug' => 'nosotros', 
  'image-bg' => false,
  'image-position' => 'left'
));
get_template_part('servicios-tp', null);
get_template_part('specific-page', null, array(
  'slug' => 'expertos', 
  'image-bg' => true,
  'image-position' => 'center'
));
get_template_part('specific-page', null, array(
  'slug' => 'productos', 
  'image-bg' => false,
  'image-position' => 'right'
));
?>

</main>
<?php get_footer(); ?>