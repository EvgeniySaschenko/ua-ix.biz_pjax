(function() {
	$(document).ready(function() {
		//$('body').append("<script async type='text/javascript' src='//recreativ.ru/rcode.773a76dcbc.js'></script>");
	//	$('body').append("<script async src='https://c.sellaction.net/js/b.js'></script>");
	});

	$(document).on('pjax:complete', function(){
		//$('body').append("<script async type='text/javascript' src='//recreativ.ru/rcode.773a76dcbc.js'></script>");
		setTimeout( ()=>{
		//	$('body').append("<script async src='https://c.sellaction.net/js/b.js'></script>");
		}, 500)

	});
}).call();


// Обход блокировщика
(function() {
	$('.Advertising [data-src]').each(function() {
		$(this).attr('src', $(this).attr('data-src'));
	});
}).call();

