//cartfunctioncall.js


function createCart() {
  jQuery.ajax({
    // url: '/rest/cart',  // same domain
    url: '/rest_proxy.php?_url=/rest/cart',  // cross-domain
    headers: {'X-UC-Merchant-Id': '2101',
      "cache-control": "no-cache"}, // could also pass merchant id as query parameter named '_mid' or cookie named 'UltraCartMerchantId'
    dataType: 'json'
  }).done(function (cart) {
        jQuery('#createCartResults').html('<pre>' + JSON.stringify(cart, null, '  ') + '</pre>');
      });
}
  
jQuery(document).ready(function () {
  jQuery('#createCartButton').on('click', createCart);
});