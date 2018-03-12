(function() {
	$(document).pjax('a:not(.no_pjax)', '#content', {
		fragment: '#content',
		timeout: 150000
	});
}).call();
