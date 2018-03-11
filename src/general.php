<?
	session_start();
	include('model/index.php');
	include('controller/visitor.php');
	list($CURRENT_URL, $HTTP_X_PJAX) = explode("?", $_SERVER['REQUEST_URI']);
	list($none, $URL_1, $URL_2, $URL_3, $URL_4) = explode("/", $CURRENT_URL);
/*
	$_SESSION['user']['permission']= 1;
	$_SESSION['user']['id']= 1;
*/
	// Навизация главные разделы
	$listNavSection= select__nav();

	// Типы сайтов
	$typesSite= select__typesSite();
	
	foreach($listNavSection as $navSection){
		// Подраздел
		if( !empty($URL_2) and !empty($URL_3) ){
			if( $navSection['link_section'] ==  $URL_2 and $navSection['link'] ==  $URL_3 ){
				$currentSection= $navSection;
				$listSite= select__sites_subsection($navSection['id']);
				break;
			}
		}
		// Раздел
		if( !empty($URL_2) and empty($URL_3) ){
			if($navSection['link'] ==  $URL_2){
				$currentSection= $navSection;
				$listSite= select__sites_section($navSection['id']);
				break;
			}
		}
		// Сайты на проверке
		if( $URL_2 == 'check-sites' ){
			$listSiteHiden= select__sites_hidden();
		}
	}
	$navSubsection= select__nav_subsection($navSection['id']);
?>