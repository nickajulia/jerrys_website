<?php

/**

 * The template for displaying Catalog Group pages for the jnh_catalog plugin.

 *

 */

get_header(); 

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

$term_descr = $term->description;

$term_name = $term->name;

$term_slug= $term->slug;

?>

<div class="catPageWrapper">
	<div class="catPage">
		<div id="heading_container" class="catHeadingContainer">
				<h1 class="catHeadingText">
					<?php printf( __( $term_name ));  ?>
				</h1>
		</div> <!--Heading container-->
		<div id="main_content_container" class="catMainContent">
			<div id="post_container" class="catPostContainer">
				<?php

					//$col_count=0;

					$post_type = 'jnh_product_set';

					$tax = 'catalog';

					$tax_terms = get_terms( $tax );

				    $args = array(

			        'post_type' => $post_type,

			        "$tax" => $term_slug,

			        'post_status' => 'publish',

			        'posts_per_page' => -1,

			        'caller_get_posts'=> 1);

			        $my_query = new WP_Query($args);

					if($my_query->have_posts()) :

					while($my_query->have_posts()) : $my_query->the_post();  
				?>

				<div id="post-<?php the_ID();?>" class="catPostItem" >
					<div id="itemnameholder" class="itemNameHolder">
						<h2>
							<a class="itemNameLink" href="<?php the_permalink(); ?>"><?php the_title();?></a>
						</h2>
						
					</div><!--Item Name Holder-->
					<div id="itemNameDivider" class="itemNameDivider">
						<div class="mask"></div>
					</div>
					
					<div id="itemImg">

						<!--Insert custom field and custom taxonomies code here-->

						<?php 

						$custom = get_post_custom($post->ID);

						$main_picture = $custom["main_picture"][0];

						?>

						<a href="<?php the_permalink(); ?>"><!--link to single product set-->
							<img class="catProductImg" src="<?php echo $main_picture ?>" id="<?php echo 'thumbnail-', $post->ID; ?>" /><!--product set img-->
						</a>

						<?php 

							/* I think below is for displaying the links for this post, but am unsure. keep until we know it's not needed

							<?php wp_link_pages( array( 'before'=>  '

							<div>' . __( 'Pages:', 'jerry' ), 'after' =>  '</div>

							' ) ); ?>

							*/ 

						?>
					</div><!-- Item Img -->

				</div><!--Post ID-->
				<?php 

				endwhile; 



				else: ?>

				<div id="oops" >

				</div>

				<h1  class="entry-title">Oops.</h1>

				<div  class="entry-content">

				Sorry, no items in this category are avaiable for  sale. Try coming back later.

				</div><!--  .entry-content -->

				<?php 

					endif; 

					wp_reset_query();

				?>
			</div><!-- #post_container -->
		</div><!--Main Content Container-->
		<div id="catalog_description" class="">
			<div id="catEmpty">
				<?php
				//If it's not empty, echo the description

				if ( ''!= trim($term_descr) ) 

				echo "<p>$term_descr</p>\n";

				//	printf( __( 'Tag Archives: %s', 'twentyten' ), '<span>' . single_tag_title( '', false ) . '</span>' );

				?>
			</div><!--Cat Empty-->
		</div><!-- #catalog_description -->
	</div><!--Catolog page-->
</div><!-- Catalog Page Wrapper-->
<?php get_footer(); ?>





<!-- took widget code out of here-->