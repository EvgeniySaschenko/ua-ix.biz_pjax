(function(){
	$('#Login__text_enter').on('click', function(){
		$('#ModalLogin').addClass('active');
	});

	$('#ModalLogin').on('click', function(e){
		if( $(e.target).hasClass('ModalLogin__box') == false ){
			$('#ModalLogin').removeClass('active');
		}
	});

}).call();