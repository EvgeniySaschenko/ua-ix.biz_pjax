(function(){

	let checkSitesFormBtnSend= function(){
		// Отправка формы
		$('.CheckSitesForm__btn-send').on("click", function(e){
			$('.CheckSitesForm .Notice').removeClass('active');
			e.preventDefault();
			if (window.FormData !== undefined){

				let form= $(this).parent('.CheckSitesForm');	
				let fileData = $(form).find('.CheckSitesForm__upload-logo').prop('files')[0];
				let formData = new FormData( form[0] );
				if(fileData == true){
					formData.append('file', fileData);
				}

				let self= this;
				$.ajax({
					url: '../controller/site.php?action=edit',
					type: 'POST',
					data: formData,
					dataType: 'text',
					cache: false,
					processData: false,
					contentType: false,
					success: function(data){
						if(data == "success"){
							$(self).parents('.CheckSites__item').addClass('hidden');
						}else{
							$(self).parents('.CheckSites__item').find('.Notice_success').addClass('active');
							let src= $(self).parents('.CheckSites__item').find('.CheckSites__img').attr('src');
							$(self).parents('.CheckSites__item').find('.CheckSites__img').attr('src', src+ '?' + new Date().getTime());

							setTimeout(function(){
								$(self).parents('.CheckSites__item').find('.Notice_success').removeClass('active');
							}, 4000);
						}
					},
					error:  function(xhr, str){

						}
				});

			}else{
				console.log('Этот браузер не может отправить данную форму');
			}
		});
	}

	checkSitesFormBtnSend();

	$(document).on('pjax:end', function(){
		checkSitesFormBtnSend();
	});
}).call();