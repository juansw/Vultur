jQuery(document).ready(function(){'use strict';



// Hover Youtube Video Play
jQuery('#player').on('hover',function() {
	var str = jQuery("iframe#player").attr('src');
	if (str.indexOf("autoplay") >= 0){

	}else{
		jQuery("iframe#player").attr('src', str + '?autoplay=1'); 
	}
});






});