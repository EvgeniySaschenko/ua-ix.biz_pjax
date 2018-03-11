(function() {

	let listSitesEditItem= function(){
		$('.ListSites__edit-item').on('click', function(){
			let id= $(this).data('id');
			let hide= $(this).data('hide');
			let self= this;
			$.ajax({
				url: `../controller/site.php?action=shift&id_site=${id}&hide=${hide}`,
				type: 'POST',
				data: 'data',
				processData: false,
				contentType: false,
				success: function(data){
					console.log(data)
					if(data == "success"){
						$(self).parents('.ListSites__item').addClass('hidden');
					}
				},
				error:  function(xhr, str){
		
					}
			});
		});
	}

	listSitesEditItem();

	$(document).on('pjax:end', function(){
		listSitesEditItem();
	});

}).call();