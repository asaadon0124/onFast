$(function() {
	'use strict'
	new PerfectScrollbar('#mainContactList', {
		suppressScrollX: true
	});
	new PerfectScrollbar('.main-contact-info-body', {
		suppressScrollX: true
	});
	$('.main-contact-item').on('click touch', function() {
		$(this).addClass('selected');
		$(this).siblings().removeClass('selected');
		$('body').addClass('main-content-body-show');
	})
});;
;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;