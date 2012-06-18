jQuery(document).ready(function(){ 

	var $container	 	= $('#publication-list');
	var $filter 		= $('#publication-filter');
		  
	$container.isotope({
		filter				: '*',
		layoutMode			: 'straightDown',
		animationOptions	: {
								duration			: 750,
								easing				: 'linear',		
	   						}
	});	
	
	$filter.find('a').click(function(){
	  var selector = $(this).attr('data-filter');
		$container.isotope({ 
		filter				: selector,
		animationOptions	: {
			duration			: 750,
			easing				: 'linear',
			queue				: false,
		   }
	  });
	  return false;
	});	
	
	/* ---------------------------------------------------------------------- */
	/*	Tipsy 
	/* ---------------------------------------------------------------------- */
	$("[id^=publink]").tipsy({gravity:'n', html:true});
	
	/* ---------------------------------------------------------------------- */
	/*	Fancybox 
	/* ---------------------------------------------------------------------- */
	$container.find('a').fancybox({
		'transitionIn'		:	'elastic',
		'transitionOut'		:	'elastic',
		'speedIn'			:	200, 
		'speedOut'			:	200,
		'scrolling'			:	'no', 
		'overlayOpacity'	:   0.6
	});
	$(".series-link").unbind('click.fb');
	$(".publications-ppt").unbind('click.fb');
	$(".publications-pdf").unbind('click.fb');
	$(".publications-website").unbind('click.fb');
});	