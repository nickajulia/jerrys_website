<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>
<body>
	<div class="container-fluid">
		
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<?php the_content('Read the rest of this entry &raquo;'); ?>
			<?php endwhile; ?><?php endif; ?>
			<div class="clear"></div>
	   	
	</div>
</body>
<?php get_footer(); ?>