(function(){
	// Выпадающие меню
	let idSection;
	// Подраздел
	$('.AddSite__select_section').on('change', function(){
		idSection= $('.AddSite__select_section option:selected').data('id-section');
		$(`.AddSite__select_subsection option`).removeClass('active');
		$(`.AddSite__select_type option`).removeClass('active');
		$(`.AddSite__option_first`).prop('selected',true);
		
		$(`.AddSite__select_subsection option[data-id-section="${idSection}"]`).addClass('active');
	});
	// Тип
	$('.AddSite__select_subsection').on('change', function(){
		$(`.AddSite__select_type option`).removeClass('active');
		$(`.AddSite__select_type .AddSite__option_first`).prop('selected',true);
		$(`.AddSite__select_type option[data-id-section="${idSection}"]`).addClass('active');
	});

	// Проверка дубликата сайта
	$('#AddSite__site').keyup(function(){
		$('.AddSite .Notice').removeClass('active');
		let site = $(this).val();
		if(site.length > 0){
			site = $(this).serialize();
			$.ajax({
				url: '../controller/site.php?action=check',
				type: 'POST',
				data: site,
				success: function(data) {
					console.log('33' + data)
					if(data){
						$('.AddSite .Notice_warning').addClass('active');
						$('#AddSite__site').css('background', '#f2dede');
					}else{
						$('.AddSite .Notice_warning').removeClass('active');
						$('#AddSite__site').css('background', '#dff0d8');
					}
				},
				error:  function(xhr, str){
						$('#AddSite__site .Notice_error').addClass('active');
					}
			});
		}
	});


	// Отправка данных на сервер
	$('.AddSite__btn-send').on("click", function(e){
		$('.AddSite .Notice').removeClass('active');
		e.preventDefault();
		if (window.FormData !== undefined){
			var formData = new FormData($('.AddSite__form')[0]);
			$.ajax({
				url: '../controller/site.php?action=add',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(data){
					if(data == "success"){
						$('.AddSite .Notice').removeClass('active');
						$('.AddSite__form').trigger( 'reset' );
						$('.AddSite .Notice_success').addClass('active');
					}else{
						$('.AddSite .Notice_error').addClass('active');
					}
				},
				error:  function(xhr, str){
						$('.AddSite .Notice_error').addClass('active');
					}
			});
		}else{
			console.log('Этот браузер не может отправить данную форму');
		}
	});
}).call();