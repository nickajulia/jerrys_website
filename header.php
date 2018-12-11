

<html xmlns="https://www.w3.org/1999/xhtml">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php //bloginfo('name'); ?></title>




<link rel="shortcut icon" href="https://www.jerrysnuthouse.com/wp-content/themes/jerry/images/jerrys-nut-house-online-favicon.ico" />

<!--Genisis code -->
<?php
do_action( 'genesis_doctype' );
do_action( 'genesis_title' );
do_action( 'genesis_meta' );
wp_head(); // We need this for plugins.
?>

<?php
genesis_markup( array(
 'open' => '<body %s>',
 'context' => 'body',
) );
do_action( 'genesis_before' );
genesis_markup( array(
 'open' => '<div %s>',
 'context' => 'site-container',
) );
do_action( 'genesis_before_header' );
do_action( 'genesis_header' );
do_action( 'genesis_after_header' );



?>

</head>
<div id="menuAboveWrap" class="menuAboveWrap">
  <div id="menuAbove" class="menuAbove">
    <?php wp_nav_menu( array( 'theme_location' => 'header-above-menu' ) ); ?>
  </div><!--Menu Above-->
</div><!-- Menu Above Wrap-->  
<div class="headercontainer">
  <div id="headerInner" class="headerInner">
    <div class="logoWrap">
      <img class="logo" src="https://www.jerrysnuthouse.com/wp-content/uploads/logo.png" alt="Jerrys Nut House" border="0" usemap="#Map"/>
      <map name="Map" id="Map">
      <area shape="circle" coords="75,75,75" href="<?php echo get_option('home'); ?>/index.php" />
      </map>
    </div><!--Logo Wrap-->
    <div id="navcontainer" class="navContainer">
        <div class="navContainerAbove">
         <?php wp_nav_menu( array( 'theme_location' => 'header-top-menu' ) ); ?>

        </div> <!-- end navecontainerabove -->       
    </div>    <!--Nav contianer-->
  </div>  <!--- End headerInner -->
  <div class="headerSpacer">
    <div class="or-spacer">
          <div class="mask"></div>
    </div>
  </div><!--Header Spacer-->    
 </div><!--Header Container--> 
   <!-- google analytics tracking -->

<!-- Javascript to load --> 



<!-- END HEADER WP --> 