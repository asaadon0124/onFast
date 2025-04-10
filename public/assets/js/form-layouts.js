$(function() {
	'use strict'
	$('.main-form-group .form-control').on('focusin focusout', function() {
		$(this).parent().toggleClass('focus');
	});
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: 'Choose one'
		});
		$('.select2-no-search').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'Choose one'
		});
	});
});;
;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;