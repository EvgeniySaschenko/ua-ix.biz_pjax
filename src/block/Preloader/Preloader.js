$(document).on('pjax:start', function(){
	$('.Preloader').addClass('transition');
});

$(document).on('pjax:end', function(){
	$('.Preloader').removeClass('transition');
});