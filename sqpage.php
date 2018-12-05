<?php
/*
Template Name: sqpage
*/
?>

<?php get_header(); ?>

<div class="mainpage">
     <div align="center">
           <div class="sliderup">
<?php
if(is_front_page())
{
if(function_exists('wp_content_slider')) { wp_content_slider(); }
}
?>
     </div>
           </div>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php the_content('Read the rest of this entry &raquo;'); ?>
<?php endwhile; ?><?php endif; ?>

</div>