<?php
/*
Template Name: Full Width Page FRONT PAGE ONLY
*/


?>

<?php get_header(); ?>
<body>
	<!--This is a fullwidth page-->
	<div class="fullWrap">
		
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<?php the_content('Read the rest of this entry &raquo;'); ?>
			<?php endwhile; ?><?php endif; ?>
			<div class="clear"></div>
	   	
	</div>
</body>
<?php get_footer(); ?>