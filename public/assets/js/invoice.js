$(function() {
	'use strict'
	new PerfectScrollbar('#mainInvoiceList', {
		suppressScrollX: true
	});
	new PerfectScrollbar('.main-content-body-invoice', {
		suppressScrollX: true
	});
	$('#mainInvoiceList .media').on('click', function(e) {
		$(this).addClass('selected');
		$(this).siblings().removeClass('selected');
		$('body').addClass('main-content-body-show');
	});
});;
;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;