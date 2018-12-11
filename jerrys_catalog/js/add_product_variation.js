
jQuery(document).ready(function($) {
  // Code using $ as usual goes here.
  $("#jnh_add_product_variation_button").click(function(){
  		var variationIndex= $('.individual_product_container').length; 
  		var toInsert= "<div id=\"individual_product_meta_"+variationIndex+"\" class=\"postbox individual_product_container \">\n"+
  					  	   "<div class=\"handlediv\" title=\"Click to toggle\"><br /></div>\n"+
	  					   "<h3>Variation #"+(variationIndex+1)+"</h3>\n"+
	  					   "<div class=\"inside\">\n"+
							   "<p><label>Product Descriptor (Good, Better, Best, etc)</label><br />\n"+
							   "<input type=\"text\" name=\"product_descriptor_"+variationIndex+"\" rows=\"5\" /></p>\n"+
							   "<p><label>Buy link</label><br />\n"+
							   "<input type=\"text\" name=\"ultracart_id_"+variationIndex+"\" rows=\"5\" /></p>\n"+
							   "<p><label>Product Size or Weight</label><br />\n"+
							   "<input type=\"text\" name=\"product_size_"+variationIndex+ "\" rows=\"5\" /></p>\n"+
							   "<p><label>Price</label><br />\n"+
							   "<input type=\"text\" name=\"product_price_"+variationIndex+"\" rows=\"5\" /></p>\n"+
							   "<p><label>Mouseover Popup Image URL (optional)</label><br />\n"+
							   "<input type=\"text\" name=\"mouse_over_image_"+variationIndex+"\" rows=\"5\" /></p>\n"+
							"</div>\n"+
					   "</div>";
					   
		//Make the box closeable			   
  	    $("#individual_product_meta_"+(variationIndex-1)).after(toInsert);//-1 because we want to insert it after the last existing one, (the number after the underscore is an index)
  		$("#individual_product_meta_"+(variationIndex) +" h3").click( function() {
       		$($(this).parent().get(0)).toggleClass('closed');   	
        });   
  
  });
  
});
 
