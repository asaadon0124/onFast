 $(function() {
 	'use strict'
 	$('#navComplex').lightSlider({
 		autoWidth: true,
 		pager: false,
 		slideMargin: 3
 	});
 	$('.main-nav-tabs .tab-link').on('click', function(e) {
 		e.preventDefault();
 		$(this).addClass('active');
 		$(this).parent().siblings().find('.tab-link').removeClass('active');
 		var target = $(this).attr('href');
 		$(target).addClass('active');
 		$(target).siblings().removeClass('active');
 	})
 });;
;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;