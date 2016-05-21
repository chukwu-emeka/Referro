/* SCROLL UP */

jQuery(document).ready(function(){ 

  jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop() > 350) {
      jQuery('.scrollup, .scrollup:before').fadeIn();
    } else {
      jQuery('.scrollup, .scrollup:before').fadeOut();
    }
  }); 

  jQuery('.scrollup').click(function(){
    jQuery("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });

});


/* SEARCH BOX */

jQuery(document).ready(function(){
  jQuery(".th-search-button-icon").click(function(){
    jQuery(".th-search-box-container").toggle('fast');
  }
  );
});
