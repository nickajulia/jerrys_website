// JavaScript Document

/***************************	Javascript to defer 	***************************/
<script async language="javascript" type="text/javascript" src="<?php bloginfo('template_url') ?>/validator.js"></script>

<script async language="javascript" type="text/javascript" src="<?php bloginfo('template_url') ?>/jquery_plugins/jquery.corner.js"></script>



<script async language="javascript" type="text/javascript">



  function con_check()



   {  



    if(!validate_text(document.con_ff.name,1,"Please enter your Name")){



       return false;



     } 



    if(!validate_email(document.con_ff.email,1,"Please enter your Email")){



       return false;


     } 

     return true;  



   }



</script>



<!---------------- Kiss Metrics ------------ >

<script type="text/javascript">

  // Define the KISSMetrics queue as normal

  var _kmq = _kmq || [];



  function _kms(u){setTimeout(function(){var s=document.createElement('script');var f=document.getElementsByTagName('script')[0];s.type='text/javascript';s.async=true;s.src=u;f.parentNode.insertBefore(s,f);},1);}



  loadKissmetrics = function () {

    // Include your KISSMetrics token

    var _kmk = _kmk || '8c388d3314dbcd1e38948f6e216949fcbb32d016';



    // Load the KISSMetrics script

    _kms('//i.kissmetrics.com/i.js');_kms('//doug1izaerwt3.cloudfront.net/' + _kmk + '.1.js');

  };

</script>





<!--------- Other kissmetrics code add to cart track ------->

<script async type="text/javascript">



_kmq.push(function()

  { document.getElementById("sendtocart").action = 'https://store.jerrysnuthouse.com/cgi-bin/UCEditor?merchantId=2101&kmi=' + encodeURIComponent(KM.i());

  } );



_kmq.push(['record', 'social hit', {'campaign source':'Campaign Source is the campaign source for any advertising you have directing traffic to your site. KISSmetrics automatically tracks this property for you for all Google Ads if you have our Javascript on your site.', 'campaign medium':'Campaign Medium describes the campaign medium from your external ad campaigns.', 'campaign name':'Campaign Name describes the campaign medium from your external ad campaigns.'}]);



_kmq.push(['identify', '','$email' ]);



</script>





<!-------- Get Vero Tracking ---------->





<script type="text/javascript">

  var _veroq = _veroq || [];



  setTimeout(function(){if(typeof window.Semblance=="undefined"){console.log("Vero did not load in time.");for(var i=0;i<_veroq.length;i++){a=_veroq[i];if(a.length==3&&typeof a[2]=="function")a[2](null,false);}}},3000);



  _veroq.push(['init', {

    api_key: '951ade068dbf539b25aa93670eea8097591b8c20'

  }, function(vero, loaded) {

    if (loaded)

      window._kmq.splice(0, 0, vero.listeners.attach_to_kissmetrics);

    loadKissmetrics();

  }]);

  (function() {var ve = document.createElement('script'); ve.type = 'text/javascript'; ve.async = true; ve.src = '//www.getvero.com/assets/m.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ve, s);})();

</script>



  <!------- Include the following code whenever the user is logged in --------->

  <script type="text/javascript">

    _veroq.push(['user', {

      id: '', // This ID must be unique per customer 

      email: 'email', // Replace this with the logged in customer's email

    }]);

  </script>








<!-------- Authorize.net script -------->


<script type="text/javascript" language="javascript">var ANS_customer_id="0dfdac43-de7a-4443-8e5f-cac3c9a3d18d";</script> <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script>

<!-------- Comodo Secure seal script -------->



<script async language="javascript" type="text/javascript">



//<![CDATA[



var cvc_loc0=(window.location.protocol == "https:")? "https://secure.comodo.net/trustlogo/javascript/trustlogo.js" :



"http://www.trustlogo.com/trustlogo/javascript/trustlogo.js";



document.writeln('<scr' + 'ipt language="JavaScript" src="'+cvc_loc0+'" type="text\/javascript">' + '<\/scr' + 'ipt>');



//]]>



</script>




<!--------crazyegg -------->



<script async data-cfasync='true' type="text/javascript">



setTimeout(function(){var a=document.createElement("script");



var b=document.getElementsByTagName("script")[0];



a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0014/9458.js?"+Math.floor(new Date().getTime()/3600000);



a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);



</script>

