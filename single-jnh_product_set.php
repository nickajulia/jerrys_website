<?php

/*

Template Name: single-jnh_product_set

*/

get_header();

if (have_posts()) :

   while (have_posts()) :

      the_post();

     // the_content(); not using content for jnh_product_set

      //Write template code/html below

      



 



    //TODO: refactor. Make a plugin method that accesses the post custom and returns the desired fields. i.e. accessor methods brah!

    $custom = get_post_custom($post->ID);

  	$main_picture = $custom["main_picture"][0];

  	$heading_text =$custom["heading_text"][0];

  	$top_copy = $custom["top_copy"][0];

  	$bottom_copy = $custom["bottom_copy"][0];  

      

    $name= $post->post_title;

    $variations= jnh_get_variations($post); 

 	?>





<body>



<div class="productpagewrapper container-fluid">

       
    

<div class="productpage ">
	
	<div id="hero" class="hero row ">
		<div id="heroLeft" class="heroLeft">
			<div id="mobileName" class="mobileName hidden-md-up">
				<h1 class="productPageName"><?php echo $name;?></h1>
			</div>
			
			<div  id="product_set_main_picture_container" class="heroImgWrap">
				<img src="<?php echo $main_picture;?>" id="main_picture" class="heroImg">
	   		</div> <!--end picture_container-->
			
		</div><!--hero Left-->
		<div id="heroRight" class="heroRight">
		
			<div id="product_set_name_container" style="visibility: hidden;" class=""> <h1 class="productPageName hidden-sm-down"><?php echo $name;?></h1></div>
			<div id="itemReviewWrap" class="itemReviewWrap">
				
			</div>
			<div id="select" class="select">
				<form id="sendtocart" class="sendToCartForm" action="https://store.jerrysnuthouse.com/cgi-bin/UCEditor?merchantId=2101" method="post">
					<input type="hidden" value="2101" name="merchantId" />
						<?php $varCount=count($variations); ?>

							<div class="variationContainerWrap">

	 						<?php $i=0; 

	 						foreach( $variations as $variation):?>
	 						
	 						


		 						<div id="<?php echo variationContainer.$i ?>" class="variation_selector_container " > <?php //hard coded width for now. 3 items max b/c of the hard coding?>

		 							<div class="variation_descr " >

		 								<span class="gbb"><?php  echo $variation["descriptor"];?></span> <?php //TODO: Change that from h1 to be the text Nick wants ?>

		 							</div>

		 							<div class="variation_size " >

		 								<?php echo $variation["size"];?>

		 							</div>

		 							<div class="variation_price " style="width:100%;">
		 								<script type="text/javascript" src="https://store.jerrysnuthouse.com/cgi-bin/UCPrice?MERCHANTID=2101&ITEM=<?php echo $variation["ultracart_id"];?>&output=Javascript"></script>



		 								
		 							</div>



		 							<?php if(sizeof($variations)>1) ://only output the radio button if there is more than 1 variation?>

		 							<div class ="variation_button" >
		 								

		 									<input  class="radio-custom" type="radio" name="add" value="<?php echo $variation["ultracart_id"];?>" <?php if(sizeof($variations)>3&&$i==0||sizeof($variations)==2&&$i==0||sizeof($variations)==3&&$i==1) echo "checked";?> /><label class="radio-custom-label"></label>
		 								

		 							</div>

		 							<?php else: //if there is only one variation, just default to selecting it ?>

		 							 <input type="hidden" name="add" value="<?php echo $variation['ultracart_id'];?>" />

		 							<?php endif;?>

		 						</div><!--end variation_class_container-->

		 					

	 						<?php 

	 						$i++;

	 						 endforeach;

	 						 ?>


						<div id="perLb" class="perLb">
							
							
						</div>
						</div><!-- Variation Container Wrap-->	
	 					<div id="buy_button_container" class="buyBtnWrap">
							<div id="quantity" class="quantityWrap"> 
								 <input type="number" name="Quantity" value="1" id="qtyinput" class="qtyInput"></div>
                            <div id="buybutton" class="buyBtn">
	 							<input id="sendToCartBtn" class="sendToCartBtn" type="submit"  value="add to cart" >
							</div><!--Buy Button-->
						</div><!--buy button container-->		
 				</form>
 				<div id="belowOrderWrap" class="belowOrderWrap">
	 				<div class="or-spacer">
	 				  <div class="mask"></div>
	 				</div>
	 				<ul id="guaranteeList" class="guaranteeList">
	 					<div class="guaranteeListSection2">
		 					<li class="guaranteeListItem1"><a href="https://www.jerrysnuthouse.com/our-guarantee/"><img src="https://www.jerrysnuthouse.com/wp-content/uploads/gaurantee_badge-e1443726409159.png" alt=""></a></li>
		 					<li class="guaranteeListItem2"><a href="https://www.jerrysnuthouse.com/our-guarantee/">100% Satisfaction Guarantee</a></li>
		 				</div>
		 				<div id="guaranteeListSection2" class="guaranteeListSection2">
		 					<li class="guaranteeListItem1"><a href="https://www.jerrysnuthouse.com/shipping">Shipping Info</a></li>
		 					<li><a href="">Compare sizes</a></li>
							
	 					</div>
	 				</ul>
					
	 				
	 				
			


	 			</div><!--Below Order-->	

			</div><!--Select-->



		</div><!--hero Right-->

	</div><!--Hero-->
	<div id="details" class="details">
		<div id="accordion" role="tablist" aria-multiselectable="true">
			<div id="detailsButtons" class="detailsButtons">
				<div class="panel-heading headingOne" role="tab" id="headingOne">
				  <div class="panel-title">
				    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				      Description
				    </a>
				  </div>
				</div><!--btn1-->
				<div class="panel-heading headingTwo" role="tab" id="headingTwo" >
				  <div class="panel-title">
				    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				      Nutrition
				    </a>
				  </div>
				</div><!--btn2-->
			</div>
			<div class="or-spacer">
			  <div class="mask"></div>
			</div>
		  <div class="panel panel-default">
		    
		    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		     	<?php echo $top_copy;?>
		    </div>
		  </div><!--3rd Item-->
		  <div class="panel panel-default">
		    
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		    	 <?php echo $bottom_copy;?> 
		    </div>
		  </div><!--2nd Item-->
		 
		</div>
		
		
	</div><!-- Details-->

 	

	<div class="clear"></div>



	

</div><!--productpage-->
</div><!--productpage wrapper--> 			









<div style="clear:both;"></div>

		

 	<?php //echo get_the_term_list( get_the_ID(), 'catalog', "Catalog Groups: ", ', ' ); ?>

 	

 	

      

      
</body>

   <?php 

   //Write template code/html above

   endwhile;

else:

//  The very first "if" tested to see if there were any Posts to 

//  display.  This "else" part tells what do if there weren't any.

 ?>

 <p>Sorry, no posts matched your criteria.</p>



 <!-- REALLY stop The Loop. -->

<div id="footer position">  



<?php endif;

get_footer(); 

?> 

</div>


