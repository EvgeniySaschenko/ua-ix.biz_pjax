(function() {
	$(document).ready(function() {
		$('body').append('<script type="text/javascript" class="Script__advertising_actionteaser" src="http://v5.actionteaser.ru/news.js"></script>');
		$('body').append('<script async type="text/javascript" class="Script__advertising_recreativ" src="//recreativ.ru/rcode.773a76dcbc.js"></script>');
	});

	$(document).on('pjax:end', function(){
		$('body').append('<script type="text/javascript" class="Script__advertising_actionteaser" src="http://v5.actionteaser.ru/news.js"></script>');
		$('body').append('<script async type="text/javascript" class="Script__advertising_recreativ" src="//recreativ.ru/rcode.773a76dcbc.js"></script>');
	});
}).call();
