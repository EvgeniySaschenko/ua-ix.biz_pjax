(function(){
	$('#NavSection__btn-burger').on('click', function(){
		$('#NavSection__list').toggleClass('active');
	});
	
	$('.NavSection__link').on('click', function(){
		$('#NavSection__list').removeClass('active');
	});
}).call();