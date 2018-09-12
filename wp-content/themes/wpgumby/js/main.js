
/* ----------------------------------- Gumby Init -------------------------------------- */


!function($) {


	'use strict';

	// not touch device or no touch events required so auto initialize here
	if((!Gumby.touchDevice || !Gumby.touchEvents) && Gumby.autoInit) {
		window.Gumby.init();

	// load jQuery mobile touch events
	} else if(Gumby.touchEvents && Gumby.touchDevice) {
		window.Gumby.init();
	}
	// if AMD return Gumby object to define
	if(typeof define == "function" && define.amd) {
		define(window.Gumby);
	}
}(jQuery);

// Gumby is ready to go
Gumby.ready(function() {
	
	Gumby.log('Gumby is ready to go...', Gumby.dump());

	if(Gumby.isOldie || Gumby.$dom.find('html').hasClass('ie9')) { jQuery('input, textarea').placeholder(); }
	jQuery('#skip-switch').on('gumby.onComplete', function() { jQuery(this).trigger('gumby.trigger'); });

// Oldie document loaded
}).oldie(function() {
	Gumby.warn("This is an oldie browser...");

// Touch devices loaded
}).touch(function() {
	Gumby.log("This is a touch enabled device...");
});

/* ------------------------------------------------------------------------- */

jQuery(document).ready(function() {
	jQuery('.portfolio-grid-block').hover(
		function(){
			jQuery(this).find('.caption').fadeIn(250);
		},
		function(){
			jQuery(this).find('.caption').fadeOut(250);
		}
	);
	
	jQuery('.product_loop_block').hover(
		function(){
			jQuery(this).find('.product_loop_caption').fadeIn(250);
		},
		function(){
			jQuery(this).find('.product_loop_caption').fadeOut(250);
		}
	);
	
	portfolio_reposition();
	camera_slider_reposition();


	jQuery("a[href$='.jpg'],a[href$='.png'],a[href$='.gif'],.fancybox").fancybox({
		'transitionIn'	: 'none',
		'transitionOut'	: 'none'	
	});
	
	//Portfolio Filter
	jQuery('#portfolio_filter_options li a').click(function(e) {
		jQuery('.portfolio-grid-block .fancybox').attr('rel', '');
		jQuery('#portfolio_filter_options li').removeClass('active');
		jQuery(this).parent().addClass('active');
		if(jQuery(this).attr('class') == 'all'){
			jQuery('.portfolio-grid-block').show('300', 'easeOutQuart');
			jQuery('.portfolio-grid-block .fancybox').attr('rel', 'gallery');
		} else {
			jQuery('.portfolio-grid-block').hide('300', 'easeInQuart');
			jQuery('.portfolio-grid-block.'+jQuery(this).attr('class')).show('300', 'easeOutQuart');
			jQuery('.portfolio-grid-block.'+jQuery(this).attr('class')+' .fancybox').attr('rel', 'gallery');
		}
		return false;
	});
	
	//WooCommerce
	custom_woocommerce_styles();
	jQuery( ".product-loop-image" ).hover( function() {
			jQuery( this ).children("img").fadeTo( "fast", 0.2 );
		}, function() {
			jQuery( this ).children("img").fadeTo( "fast", 1 );
		}
	);
	
	jQuery('.woocommerce .zoom').fancybox({
		'transitionIn'	: 'none',
		'transitionOut'	: 'none'	
	});
	
	//fix focus bug with webkit input type=number ui
	jQuery('.woocommerce form.cart .quantity input[type=number]').attr('type', 'tel');
	
	if (jQuery('#camera_wrap').length>0)
	{

		if (jQuery('#camera_wrap .camera_caption').length>1)
		{
			jQuery('#camera_wrap').camera({
				height: 'auto',
				pagination: false,
				thumbnails: false,
			});			
		}
		else
		{
			jQuery('#camera_wrap').camera({
				height: 'auto',
				pagination: false,
				thumbnails: false,
				autoAdvance: false,
				mobileAutoAdvance: false,
				navigation: false,
				playPause: false
			});			
		
		}

	}
	
	
});

jQuery(window).load(function(){
	//For Chrome and Safari:
	//images may or may not be loaded (if they are not in cache)
	portfolio_reposition();
	camera_slider_reposition();
});

jQuery(window).resize(function(){
	portfolio_reposition();
	camera_slider_reposition();
});

function portfolio_reposition(){
	jQuery(".portfolio-grid-block .caption").css("width", jQuery(".portfolio-grid-block .img-responsive").width());
	jQuery(".portfolio-grid-block .caption").css("height", jQuery(".portfolio-grid-block .img-responsive").height());
	var pg_block_margin = ((jQuery(".portfolio-grid-block").width()) - (jQuery(".portfolio-grid-block .img-responsive").width())) * 0.5;
	jQuery(".portfolio-grid-block .caption").css("marginLeft", pg_block_margin + "px");
	var pg_icon_margin = ((jQuery(".portfolio-grid-block .caption").height()) - 90) * 0.5;
	jQuery(".portfolio-grid-block .hover-icon").css("marginTop", pg_icon_margin + "px");
	return;
};

function custom_woocommerce_styles(){
	jQuery( '.woocommerce #billing_country' ).wrap( '<div class="picker"></div>' );	
	jQuery( '.woocommerce #calc_shipping_country' ).wrap( '<div class="picker"></div>' );	
	jQuery('*[data-rel="prettyPhoto[product-gallery]"]').attr('rel', 'gallery');
	return;
};

function camera_slider_reposition(){
	var slider_width = jQuery('#slider_width').val();
	var slider_height = jQuery('#slider_height').val();
	var slider_resize = jQuery('#slider_resize').val();
	var camera_width = jQuery('#camera_wrap').width();
	if (camera_width >= slider_width || slider_resize == 'crop') {
		jQuery('#camera_wrap').css('height', slider_height);
	} else {
		var new_height = ((slider_height * camera_width) / slider_width)
		jQuery('#camera_wrap').css('height', new_height);
	}
	return;
};




