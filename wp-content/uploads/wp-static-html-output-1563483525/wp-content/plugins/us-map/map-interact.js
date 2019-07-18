﻿// Quick feature detection
function isTouchEnabled() {
 	return (('ontouchstart' in window)
      	|| (navigator.MaxTouchPoints > 0)
      	|| (navigator.msMaxTouchPoints > 0));
}
jQuery(function(){
	jQuery("path[id^=\"us_\"]").each(function (i, e) {
		addEvent( jQuery(e).attr('id') );
	});
})
jQuery(function(){
	jQuery('#lakes').find('path').attr({'fill':us_config['default']['lakesfill']}).css({'stroke':us_config['default']['lakesoutline']});
});
function addEvent(id,relationId){
	var _obj = jQuery('#'+id);
	var _Textobj = jQuery('#'+id+','+'#'+us_config[id]['visnames']);
	var _h = jQuery('#map').height();

	jQuery('#'+['visnames']).attr({'fill':us_config['default']['visnames']});

		_obj.attr({'fill':us_config[id]['upclr'],'stroke':us_config['default']['borderclr']});
		_Textobj.attr({'cursor':'default'});
		if(us_config[id]['enbl'] == true){
			if (isTouchEnabled()) {
				_Textobj.on('touchstart', function(e){
					var touch = e.originalEvent.touches[0];
					var x=touch.pageX-10, y=touch.pageY+(-15);
					var maptipw=jQuery('#tipus').outerWidth(), maptiph=jQuery('#tipus').outerHeight(), 
					x=(x+maptipw>jQuery(document).scrollLeft()+jQuery(window).width())? x-maptipw-(20*2) : x
					y=(y+maptiph>jQuery(document).scrollTop()+jQuery(window).height())? jQuery(document).scrollTop()+jQuery(window).height()-maptiph-10 : y
					if(us_config[id]['targt'] != 'none'){
						jQuery('#'+id).css({'fill':us_config[id]['dwnclr']});
					}
					jQuery('#tipus').show().html(us_config[id]['hover']);
					jQuery('#tipus').css({left:x, top:y})
				})
				_Textobj.on('touchend', function(){
					jQuery('#'+id).css({'fill':us_config[id]['upclr']});
					if(us_config[id]['targt'] == '_blank'){
						window.open(us_config[id]['url']);	
					}else if(us_config[id]['targt'] == '_self'){
						window.parent.location.href=us_config[id]['url'];
					}
					jQuery('#tipus').hide();
				})
			}
			_Textobj.attr({'cursor':'pointer'});
			_Textobj.hover(function(){
				//moving in/out effect
				jQuery('#tipus').show().html(us_config[id]['hover']);
				_obj.css({'fill':us_config[id]['ovrclr']})
			},function(){
				jQuery('#tipus').hide();
				jQuery('#'+id).css({'fill':us_config[id]['upclr']});
			})
			if(us_config[id]['targt'] != 'none'){
				//clicking effect
				_Textobj.mousedown(function(){
					jQuery('#'+id).css({'fill':us_config[id]['dwnclr']});
				})
			}
			_Textobj.mouseup(function(){
				jQuery('#'+id).css({'fill':us_config[id]['ovrclr']});
				if(us_config[id]['targt'] == '_blank'){
					window.open(us_config[id]['url']);	
				}else if(us_config[id]['targt'] == '_self'){
					window.parent.location.href=us_config[id]['url'];
				}
			})
			_Textobj.mousemove(function(e){
				var x=e.pageX+10, y=e.pageY+15;
				var maptipw=jQuery('#tipus').outerWidth(), maptiph=jQuery('#tipus').outerHeight(), 
				x=(x+maptipw>jQuery(document).scrollLeft()+jQuery(window).width())? x-maptipw-(20*2) : x
				y=(y+maptiph>jQuery(document).scrollTop()+jQuery(window).height())? jQuery(document).scrollTop()+jQuery(window).height()-maptiph-10 : y
				jQuery('#tipus').css({left:x, top:y})
			})
		}	
}