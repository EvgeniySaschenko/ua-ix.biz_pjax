<?php
	include('../general.php');
	// Войти на сайт
	if( empty($_SESSION['user']['id']) ){
		$s = file_get_contents('http://ulogin.ru/token.php?token='.$_POST['token'].'&host='.$_SERVER['HTTP_HOST']);
		$user = json_decode($s, true);
	
		$idSocial= $user["uid"];
		$idSex= $user["sex"];
		if(empty($idSex))
			$idSex= 0;
		$network= $user["network"];
		if(empty($network))
			$network= 0;
		$homeTown= $user["city"];
		if(empty($homeTown))
			$homeTown= 0;
		$firstName= $user["first_name"];
		if(empty($firstName))
			$firstName= 0;
		$lastName= $user["last_name"];
		if(empty($lastName))
			$lastName= 0;
		$likPhoto= $user["photo"];
		if(empty($likPhoto))
			$likPhoto= 0;
		$dateBirth= date("Y-m-d", strtotime($user["bdate"]));
		if(empty($dateBirth))
			$dateBirth= 0;
		$ip= $_SERVER['REMOTE_ADDR'];
		$userAgent= $_SERVER['HTTP_USER_AGENT'];
	
		$currentUser= select__user($idSocial, $network);
		// Добавляем / обновляем пользователя


		if(!empty($currentUser[0]["id"])){
			update__user($idSex, $homeTown, $firstName, $lastName, $likPhoto, $dateBirth, $ip, $userAgent, $idSocial, $network);
		}
		else{
			insert__user($idSocial, $idSex, $network, $homeTown, $firstName, $lastName, $likPhoto, $dateBirth, $ip, $userAgent);
		}

		// Проверяем добавлен ли пользовалель в базу
		$currentUser= select__user($idSocial, $network);
		if(!empty($currentUser[0]["id"])){
			$_SESSION['user']['id'] = $currentUser[0]['id'];
			$_SESSION['user']['id_social'] = $currentUser[0]['id_social'];
			$_SESSION['user']['first_name'] = $currentUser[0]['first_name'];
			$_SESSION['user']['last_name'] = $currentUser[0]['last_name'];
			$_SESSION['user']['link_photo'] = $currentUser[0]['link_photo'];
			$_SESSION['user']['permission'] = $currentUser[0]['permission'];
		}
	}else{
		// Выйти
		session_unset();
		session_destroy();
	}
	header('Location:'.$_SERVER['HTTP_REFERER']);
?>