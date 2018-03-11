(function() {
	$(document).pjax('a:not(.no_pjax)', '#main', {
		fragment: '#main',
		timeout: 150000
	});

	$(document).on('pjax:start', function(){
		$('.Preloader').addClass('transition');
	});

	$(document).on('pjax:end', function(){
		$('.Preloader').removeClass('transition');
	});
}).call();
