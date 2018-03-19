(function() {
	$(document).ready(function() {
		$('body').append("<script language='Javascript'> var bid = '93zklbU7UT16ey480drY'; var sid = '10561'; var async = 1; </script>");
		$('body').append('<script type="text/javascript" class="Script__advertising_actionteaser" src="http://v5.actionteaser.ru/news.js"></script>');
	});

	$(document).on('pjax:end', function(){
		$('body').append("<script language='Javascript'> var bid = '93zklbU7UT16ey480drY'; var sid = '10561'; var async = 1; </script>");
		$('body').append('<script type="text/javascript" class="Script__advertising_actionteaser" src="http://v5.actionteaser.ru/news.js"></script>');
	});
}).call();
