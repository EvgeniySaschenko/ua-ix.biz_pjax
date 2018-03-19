<? include('general.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="<?= $currentSection['meta_d']; ?>">
	<meta name="keywords" content="<?= $currentSection['meta_k']; ?>">
	<title><?= $currentSection['title']; ?></title>
	<base href="/">
</head>
<body>
	<? include('view/Preloader.php'); ?>
	<div class="wrapper">
		<script>
			document.querySelector('.wrapper').classList.add('noload');
		</script>
		<? include('view/Header.php'); ?>

		<div class="container" id="content">
			<? if( $_SESSION['user']['permission'] == 1 ): ?>
				<a class="" href="/ru/check-sites">Сайты на проверке</a>
			<? endif; ?>
			<? include('view/AdvertisingTop.php'); ?>
			<main class="main" id="main">
				<? include('view/TitlePage.php'); ?>

				<? if( $URL_2 == "add-site" ): ?>
					<!--Редактировать сайты-->
					<? include('view/AddSite.php'); ?>
				<? elseif( $URL_2 == 'check-sites' ): ?>
					<!--Редактировать сайты-->
					<? include('view/CheckSites.php'); ?>
				<? else: ?>
					<!--Список сайтов-->
					<? include('view/NavSubsection.php'); ?>
					<? include('view/ListSites.php'); ?>
				<? endif; ?>

				<div class="Page__description"><?= $currentSection['description']; ?></div>
			</main>
			<? include('view/AdvertisingBottom.php'); ?>
		</div>

		<? include('view/Footer.php'); ?>
		<? include('view/ModalLogin.php'); ?>
	</div>
	<link rel="stylesheet" href="/css/style.css?7">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
	<script src="/js/app.js?12"></script>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
	(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
					try {
							w.yaCounter13139653 = new Ya.Metrika({id:13139653,
											webvisor:true,
											clickmap:true,
											trackLinks:true,
											accurateTrackBounce:true});
					} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
					s = d.createElement("script"),
					f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
					d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="//mc.yandex.ru/watch/13139653" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->

	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-554b753f54e564ab"></script>

	<!-- ulogin.ru -->
	<script src="//ulogin.ru/js/ulogin.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-63941418-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-63941418-1');
	</script>
</body>
</html>