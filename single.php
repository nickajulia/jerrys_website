
<?php get_header(); ?>
<body>
  <div id="wrap" class="">
 		<?php if (have_posts()) : 
             genesis(); 
            endif; ?>   
  </div>
</body>
<?php get_footer(); ?>