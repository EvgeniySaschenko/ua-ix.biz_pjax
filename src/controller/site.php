<?
	include('../general.php');
	// Проверкаа сайта
	if($_GET['action'] == 'check'){
		$data = parse_url(mb_strtolower( $_POST['link'], 'UTF-8'));
		if($data['host'])
		{
			$link = $data['host'];
		}
		else
		{
			$link = $data['path'];
		}
		$link = str_replace('www.', '', $link);
		$сheckSite = select__site_check($link);

		if( !empty($сheckSite[0]["id"]) ){
			echo "Такой сайт уже существует";
		}
	}

	// Добавить / обновить сайт
	$idSection = $_POST['id_section'];
	$idType = $_POST['id_type'];
	$mail = $_POST['mail'];
	$idUser = $_SESSION['user']['id'];
	$alexaRank = $_POST['alexa_rank'];
	$youtubeSubscriber = $_POST['youtube_subscriber'];

	if(empty($_POST['youtube_subscriber']))
		$youtubeSubscriber = 0;
	$youtubeBrowsing = $_POST['youtube_browsing'];
	if(empty($_POST['youtube_browsing']))
		$youtubeBrowsing = 0;

	if(empty($_POST['alexa_rank']))
		$alexaRank = 0;
	$data = parse_url( mb_strtolower( $_POST['link'], 'UTF-8' ) );
	if($data['host'])
		$link = $data['host'];
	else
		$link = $data['path'];


	$comment = $_POST['comment'];
	$mail = mb_strtolower( $_POST['mail'], 'UTF-8' );
	$denominator = $_POST['denominator'];
	if(empty($_POST['denominator']))
		$denominator = 1;
	
	if(empty($_POST['comment']))
		$comment = 0;
	$link = str_replace('www.', '', $link);
	// Поиск http
	if(stristr($_POST['link'], "http://"))
		$linkRef = str_replace("http://", "", $_POST['link']);
	// Поиск https
	elseif(stristr($_POST['link'], "https://"))
		$linkRef = str_replace("https://", "", $_POST['link']);
	else
		$linkRef = $_POST['link'];

	$сheckDoubleSite = select__site_check($link);
	// Alexa
	$xml = simplexml_load_file('http://data.alexa.com/data?cli=10&url='.$link);
	if(isset($xml->SD->REACH))
		$alexaRank = $xml->SD->REACH->attributes()->RANK;
	else
		$alexaRank = 20000000;


	# Добавить сайт
	if($_GET['action'] == 'add' and empty($сheckDoubleSite))
	{
		if ( !empty($_POST['id_subsection'])
		and !empty($_POST['id_type'])
		and !empty($_POST['link'])
		and !empty($_POST['mail'])
		and !empty($_SESSION['user']['id']) )
		{

			$idSite = insert__site($idSection, $idType, $idUser, $link, $linkRef, $comment, $mail, $alexaRank, $youtubeSubscriber, $youtubeBrowsing);
		}
		if($idSite or $idSite === "0"){
			echo "success";
		}
		else 
		{
			echo "error";
		}
	}


	if( $_SESSION['user']['permission'] == 1 ){
		# Редактировать сайт
		if( $_GET['action'] == 'edit' ){
			$idSite = $_POST['id_site'];
			$hide = $_POST['hide'];
			$alexaRank = $_POST['alexa_rank'];

			update__site($idSite, $idSection, $idType, $link, $linkRef, $alexaRank, $hide);

			// Загрузка лого
			if(!empty($_FILES['logo']['name'])){

				$file = pathinfo($_FILES['logo']['name']);
				$extension = mb_strtolower($file['extension'], 'UTF-8');

				if( !empty($idSite) and ($extension == 'jpg' or $extension == 'jpeg' or $extension == 'png'  or $extension == 'gif' ) )
				{
					$path = '../img/site/'.$idSite.'.jpg';
					$file = pathinfo($_FILES['logo']['name']);

					if($extension == 'png')
						imagejpeg(imagecreatefrompng($_FILES['logo']['tmp_name']), $path, 100);
					else if($extension == 'gif')
						imagejpeg(imagecreatefromgif($_FILES['logo']['tmp_name']), $path, 100);
					else if($extension == 'jpg' or $extension == 'jpeg')
						copy($_FILES['logo']['tmp_name'], $path);
				}
			}
			
			if($hide == 1){
				echo "success_edit";
			}else{
				echo "success";
			}
		}
		elseif( $_GET['action'] == 'shift' ){
			update__site_hidden($_GET['id_site'], $_GET['hide']);
			echo "success";
		}
	}

?>