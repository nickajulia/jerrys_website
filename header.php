<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php //bloginfo('name'); ?></title>

<!-- Defer Js -->


<link rel="shortcut icon" href="http://www.jerrysnuthouse.com/wp-content/themes/jerry/images/jerrys-nut-house-online-favicon.ico" />


<?php wp_head(); ?>
</head>
<div id="menuAboveWrap" class="menuAboveWrap" style="position: relative;">
  <div id="menuAbove" class="menuAbove">
    <?php wp_nav_menu( array( 'theme_location' => 'header-above-menu' ) ); ?>
  </div><!--Menu Above-->
</div><!-- Menu Above Wrap-->  
<div class="headercontainer">
  <div id="headerInner" class="headerInner">
    <div class="logoWrap">
      <img class="logo" src="http://www.jerrysnuthouse.com/wp-content/uploads/logo.png" alt="Jerrys Nut House" border="0" usemap="#Map"/>
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