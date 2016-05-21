/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

jQuery(document).ready(function(){

	jQuery('#site-navigation ul:first-child').clone().appendTo('.responsive-mainnav');

	jQuery('#main-nav-button').click(function(event){
		event.preventDefault();
		jQuery('.responsive-mainnav').slideToggle();
	});
	
});