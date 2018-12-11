<?php
/*
Plugin Name: Jerry's Nut House Catalog
Plugin URI: http://davidjulia.wordpress.com
Description: The plugin responsible for adding the jerry's nut house catalog backend functionality.
Version: .01
Author: David Julia
Author URI: http://davidjulia.wordpress.com
License: GPL2
*/


define('JNH_PRODUCT_SET_POST_TYPE', 'jnh_product_set');
//enqueue the scripts on both the post editor page and the post-new (post creation) page
add_action('admin_print_scripts-post.php', 'jnh_scripts_setup');
add_action('admin_print_scripts-post-new.php', 'jnh_scripts_setup');

add_action("admin_menu", "jnh_add_custom_boxes");

		
/* Do something with the data entered */
add_action( 'save_post', 'jnh_save_post_data', 10, 2);
add_action('wp_header', 'add_opengraph_info');

add_action( 'init', 'jnh_create_custom_posts' );
function jnh_create_custom_posts() {
	register_post_type( 'jnh_product_set',
		array(
			'labels' => array(
				'name' => __( 'Product Sets' ),
				'singular_name' => __( 'Product Set' )
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'thumbnail')
		)
	);
	
	register_taxonomy('catalog', 'jnh_product_set', array(
	  'hierarchical'    => true,
	  'label'           => 'Catalog Group',
	  'query_var'       => 'catalog',
	  'rewrite'         => array('slug' => 'catalog-group' ) //Don't know if we want rewrite.
		));
	
}


//Add the custom columns via a filter
add_filter("manage_edit-jnh_product_set_columns", "jnh_product_set_columns"); 
//populate the custom columns
add_action("manage_jnh_product_set_posts_custom_column", "jnh_custom_columns", 10, 2);
//Alternately add_action( 'manage_movie_posts_custom_column', 'devpress_manage_movie_columns', 10, 2 ); what's with the 10,2?
function jnh_product_set_columns($columns)
{
	$columns = array(
		"title" => "Product Set Name",
		"variations" => "Variations", //change to something useful, maybe a custom field
		'catalog_groups' => 'Catalog Groups'
	);
	return $columns;
}

/*function jnh_custom_columns($column)
{
	global $post;
	if ("ID" == $column) echo $post->ID;
	elseif ("description" == $column) echo $post->post_content;
	elseif ("length" == $column) echo "63:50";
	elseif ("speakers" == $column) echo "Joel Spolsky";
}*/


function jnh_custom_columns($column) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'variations' :

			/* Get the post meta. */
			$variations = jnh_get_variations($post);

			/* If no variation is found, output a default message. */
			if ( empty( $variations ) )
				echo __( 'No variations' );
			else //output the variation descriptors. Could add some javascript for mouseover popup of other variation info if desired
			{
				for($i=0; $i<sizeof($variations); $i++){
					echo $variations[$i]['descriptor'],' (', $variations[$i]['size'], ')';
					if($i<sizeof($variations)-1)
						echo ', ';
				}
			}	
			
			break;

		/* If displaying the 'genre' column. */
		case 'catalog_groups' :

			/* Get the genres for the post. */
			$terms = get_the_terms( $post->ID, 'catalog' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'catalog' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'catalog', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Catalog Groups' );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}
function jnh_add_custom_boxes(){
	
    add_meta_box("jnh_product_info_meta", "Product Set Information", "jnh_product_set_info_meta", "jnh_product_set", "normal", "low");
  
  	add_meta_box("individual_products_meta", "Individual Products (Variations)", "jnh_individual_product_info_meta", "jnh_product_set", "normal", "low");
  //}
  //add_meta_box("credits_meta", "Design & Build Credits", "credits_meta", "portfolio", "normal", "low");
}

function jnh_product_set_info_meta($post) {
  $custom = get_post_custom($post->ID);
  $main_picture = isset($custom["main_picture"][0])?$custom["main_picture"][0]:'';
  $heading_text = isset($custom["heading_text"][0])?$custom["heading_text"][0]:'';
  $top_copy = isset($custom["top_copy"][0])?$custom["top_copy"][0]:'';
  $bottom_copy = isset($custom["bottom_copy"][0])?$custom["bottom_copy"][0]:'';
  ?>
  
  <p><label>Picture URL</label><br />
  <input type="text" name="main_picture" value="<?php echo $main_picture; ?>"></p>
  <p><label>Heading Text</label><br />
  <textarea cols="50" rows="3" name="heading_text"><?php echo $heading_text; ?></textarea></p>
  <p><label>Top Copy:</label><br />
  <textarea cols="50" rows="5" name="top_copy" ><?php echo $top_copy; ?></textarea></p>
  <p><label>Bottom Copy:</label><br />
  <textarea cols="50" rows="5" name="bottom_copy" ><?php echo $bottom_copy; ?></textarea></p>
  
  <?php
}

function jnh_individual_product_info_meta_helper($variation, $variation_index)
{
	$ultracart_id = $variation["ultracart_id"];
	
	$product_size=$variation["size"];
	$product_price = $variation["price"];
	$product_descriptor=$variation["descriptor"];
	$mouseover_image= $variation["image"];
	?>
	
	<div id="individual_product_meta_<?php echo $variation_index;?>" class="postbox individual_product_container">
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3>Variation #<?php echo $variation_index+1;?></h3>
		<div class="inside">
			<p><label>Product Descriptor (Good, Better, Best, etc)</label><br />
			<input type="text" name="product_descriptor_<?php echo $variation_index; ?>" rows="5" value="<?php echo $product_descriptor;?>"></p>
			<p><label>Ultracart Item ID</label><br />
			<input type="text" name="ultracart_id_<?php echo $variation_index; ?>" rows="5" value="<?php echo $ultracart_id;?>"></p>
			<p><label>Product Size or Weight</label><br />
			<input type="text" name="product_size_<?php echo $variation_index; ?>" rows="5" value="<?php echo $product_size;?>"></p>
			<p><label>Price</label><br />
			<input type="text" name="product_price_<?php echo $variation_index; ?>" rows="5" value="<?php echo $product_price;?>"></p>
			<p><label>Mouseover Popup Image URL (optional)</label><br />
			<input type="text" name="mouse_over_image_<?php echo $variation_index; ?>" rows="5" value="<?php echo $mouseover_image;?>"></p>
		</div>
	</div>
	<?php 
}

function jnh_scripts_setup(){
	 wp_enqueue_script('add_product_variation',plugins_url( 'js/add_product_variation.js' , __FILE__ ), array('jquery'), '1.0');
		
}

function jnh_individual_product_info_meta($post){
	//TODO: implement validation
	$custom = get_post_custom($post->ID);
	
	$variations=unserialize($custom["variations"][0]);
	$num_variations=sizeof($variations);
	if($num_variations==0) $num_variations=1; //Even if there are no product variations created yet, still display one set of product variation info
	for($i=0;$i<$num_variations; $i++)
	{
		
		$variation=$variations[$i];
		jnh_individual_product_info_meta_helper($variation, $i); 
	}
	?>
	<span id="jnh_add_product_variation_button" class="button">Add A Variation </span>
	
	<?php  
 
}
/*Return the variations for a given post
 * @param mixed the post object or id
 */ 
function jnh_get_variations($post)
{
	
	if($post->post_type=='jnh_product_set')
	{
		if(!isset($post->post_type))//if they passed in an ID
			$custom= get_post_custom($post);
		else $custom = get_post_custom($post->ID);//if they passed in a post object
		$variations=unserialize($custom["variations"][0]);
		return $variations;
	}
	
	else return false;
}
function jnh_add_opengraph_info($post)
{
	if($post->post_type==JNH_PRODUCT_SET_POST_TYPE)
	{
		wp_enqueue_script('facebook_ml', 'http://connect.facebook.net/en_US/all.js#xfbml=1');
		$custom = get_post_custom($post->ID);
		echo '<meta property="og:title" content="',$post->post_title,'"/>';
	    echo '<meta property="og:type" content="food"/>';
	    echo '<meta property="og:url" content="',get_permalink($post->ID),'"/>';
	    echo '<meta property="og:image" content="',$custom['main_picture'],'"/>';
	    echo '<meta property="og:site_name" content="jerrysnuthouse.com"/>';
	    echo '<meta property="fb:admins" content="1075980345"/>';
	    echo '<meta property="og:description" content="',$custom['top_copy'],'"/>'; //can change this or add a field specifically for this info if need be. nbd.
	}
}
function jnh_save_post_data($post_ID, $post)
{    
	if(isset($_POST['post_type'])&& $post->post_type=='jnh_product_set')
	{
		
		//The product set fields
		$main_picture = $_POST["main_picture"];
		$heading_text = $_POST["heading_text"];
		$top_copy = $_POST["top_copy"];
		$bottom_copy = $_POST["bottom_copy"];
		
		update_post_meta($post_ID, "main_picture", $main_picture);
		update_post_meta($post_ID, "heading_text", $heading_text);
		update_post_meta($post_ID, "top_copy", $top_copy);
		update_post_meta($post_ID, "bottom_copy", $bottom_copy);
				
		//note that the field names for added boxes just have increasing indices.
		
		//The individual variation fields
		$variations_new= array();
		$i=0;
		
		while(isset($_POST["ultracart_id_$i"]))
		{
			$current_variation = array();
			$current_variation["ultracart_id"]=$_POST["ultracart_id_$i"];
			$current_variation["size"]=$_POST["product_size_$i"];
			$current_variation["price"]=$_POST["product_price_$i"];
			$current_variation["descriptor"]=$_POST["product_descriptor_$i"];
			$current_variation["image"]=$_POST["mouse_over_image_$i"];
			$variations_new[$i]= $current_variation;
			$i++;
			
		}
	
		update_post_meta($post_ID, "variations", $variations_new);
	}
	
}

/*
Custom Post Type, Template Redirect the right way.
Okay, after reading many tutorials on how to create post types, I could not seem to find on that did the template redirect for my custom post types. But thanks to someone out there I was able to find what I needed to accomplish this. IÕm sorry I donÕt have a link to where I got this example, but kudos to him that help me solve it. There are two parts to this.

First we will need to setup the template redirect
*/
add_action("template_redirect", 'jnh_template_redirect');
function jnh_template_redirect()
 {
 	//TODO: Change this code to allow for specifying the template on a per-item basis if need be.
	 global $wp;
	
	       $custom_post_types = array("portfolio");
	
	 if (in_array($wp->query_vars["post_type"], $custom_post_types))
	 {
	       if ( is_robots() ) :
	       do_action('do_robots');
	       return;
	 elseif ( is_feed() ) :
	       do_feed();
	       return;
	 elseif ( is_trackback() ) :
	       include( ABSPATH . 'wp-trackback.php' );
	       return;
	 elseif($wp->query_vars["name"]):
	       include(TEMPLATEPATH . "/single-".$wp->query_vars["post_type"].".php");
	       die();
	 else:
	       include(TEMPLATEPATH . "/".$wp->query_vars["post_type"].".php");
	       die();
	 endif;

 	}
 }
 
 /*
 Second we will need to add a rewrite rule to wordpress to do the redirecting properly.
add_new_rules()
*/
function add_new_rules(){

 global $wp_rewrite;

 $rewrite_rules = $wp_rewrite->generate_rewrite_rules(JNH_PRODUCT_SET_POST_TYPE.'/');
 $rewrite_rules[JNH_PRODUCT_SET_POST_TYPE.'/?$'] = 'index.php?paged=1';

 foreach($rewrite_rules as $regex => $redirect)
 {
       if(strpos($redirect, 'attachment=') === false)
       {
       $redirect .= '&post_type='.JNH_PRODUCT_SET_POST_TYPE;
       }
       if(0 < preg_match_all('@\$([0-9])@', $redirect, $matches))
       {
             for($i = 0; $i < count($matches[0]); $i++)
             {
                   $redirect = str_replace($matches[0][$i], '$matches['.$matches[1][$i].']', $redirect);
             }
       }
       $wp_rewrite->add_rule($regex, $redirect, 'top');
 }

 }
 /*
Adding these two functions to you custom post type class will enable you to create listing page (like index.php) Ôcustom_post_typeÕ.php 
and a single-Õcustom_post_typeÕ.php. Doing so will already create the query for that post type, so all you have to do is create the loop 
as you normally would and go to town formatting your custom post type with easy.
*/

	/*Example code
	 * 
	 * add_action("manage_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-podcast_columns", "my_podcast_columns");

function my_podcast_columns($columns)
{
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Podcast Title",
		"description" => "Description",
		"length" => "Length",
		"speakers" => "Speakers",
		"comments" => 'Comments'
	);
	return $columns;
}

function my_custom_columns($column)
{
	global $post;
	if ("ID" == $column) echo $post->ID;
	elseif ("description" == $column) echo $post->post_content;
	elseif ("length" == $column) echo "63:50";
	elseif ("speakers" == $column) echo "Joel Spolsky";
}

	 */
