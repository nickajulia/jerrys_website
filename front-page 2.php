<?php
/**
 * EA Genesis Child.
 *
 * @package      EAGenesisChild
 * @since        1.0.0
 * @copyright    Copyright (c) 2014, Contributors to EA Genesis Child project
 * @license      GPL-2.0+
 */
// Remove 'site-inner' from structural wrap
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer' ) );
/**
 * Add the attributes from 'entry', since this replaces the main entry
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/full-width-landing-pages-in-genesis/
 * 
 * @param array $attributes Existing attributes.
 * @return array Amended attributes.
 */
function be_site_inner_attr( $attributes ) {
	
	// Add a class of 'full' for styling this .site-inner differently
	$attributes['class'] .= ' full';
	
	// Add an id of 'genesis-content' for accessible skip links
	$attributes['id'] = 'genesis-content';
	
	// Add the attributes from .entry, since this replaces the main entry
	$attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );
	
	return $attributes;
}
add_filter( 'genesis_attr_site-inner', 'be_site_inner_attr' );
// Build the page
get_header();
do_action( 'be_content_area' );
get_footer();