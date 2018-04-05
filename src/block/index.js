(function() {
	$(document).pjax('a:not(.no_pjax)', '#main', {
		fragment: '#main',
		timeout: 150000
	});
}).call();
