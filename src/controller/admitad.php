<?
	include('../general.php');

	$CLIENT_ID= 'b26b2d66d57e50d37b8e939894162f';
	$CLIENT_SECRET= '5b74ec0a89fe70ae5f2442bf44b00b';
	$BASE64_HEADER= 'YjI2YjJkNjZkNTdlNTBkMzdiOGU5Mzk4OTQxNjJmOjViNzRlYzBhODlmZTcwYWU1ZjI0NDJiZjQ0YjAwYg==';
	$URL_API= 'https://api.admitad.com/token/';

	// Авторизация
	$HTTP_HEADERS= array(
		'POST /token/ HTTP/1.1',
		'Host: api.admitad.com',
		'Authorization: Basic '.$BASE64_HEADER,
		'Content-Type: application/x-www-form-urlencoded;charset=UTF-8');
	$curl = curl_init($URL_API);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials&client_id='.$CLIENT_ID.'&scope=public_data advcampaigns websites advcampaigns_for_website manage_websites');
	curl_setopt($curl, CURLOPT_HTTPHEADER, $HTTP_HEADERS); 
	$auth = json_decode( curl_exec($curl) );
	// Данные
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.admitad.com/advcampaigns/website/836811/?connection_status=active&limit=10&offset=50",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_POSTFIELDS => "",
	  CURLOPT_HTTPHEADER => array(
		"Authorization: Bearer ".$auth->access_token
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
		$data= json_decode($response);
	}



	foreach($data->results as $key => $item){
		$idUser= 1545;
		if($data->results[$key]->categories[0]->id == 6){

			if($data->results[$key]->categories[1]->id == 16){
				// Браузерная
				$idType= 74;
				$idSection= 35;
			}else{
				// Клиентская
				$idType= 75;
				$idSection= 36;
			}

			$xml = simplexml_load_file('http://data.alexa.com/data?cli=10&url='.$data->results[$key]->site_url);
			if(isset($xml->SD->REACH))
				$alexaRank = $xml->SD->REACH->attributes()->RANK;
			else
				$alexaRank = 20000000;
			
			$link= $data->results[$key]->site_url;
			// Поиск http
			if(stristr($link, "http://"))
				$link = str_replace("http://", "", $link);
			// Поиск https
			elseif(stristr($link, "https://"))
				$link = str_replace("https://", "", $link);

			$linkRef= $data->results[$key]->gotolink;
			// Поиск http
			if(stristr($linkRef, "http://"))
				$linkRef = str_replace("http://", "", $linkRef);
			// Поиск https
			elseif(stristr($linkRef, "https://"))
				$linkRef = str_replace("https://", "", $linkRef);
			
			$hide= 0;
			$comment= 0;
			$mail= 'info@ua-ix.biz';
			$youtubeSubscriber= 0;
			$youtubeBrowsing= 0;

			$idSite = insert__site($idSection, $idType, $idUser, $link, $linkRef, $hide, $comment, $mail, $alexaRank, $youtubeSubscriber, $youtubeBrowsing);


			// echo $data->results[$key]->actions_detail;
			// echo $data->results[$key]->name;

			$path = '../img/site/'.$idSite.'.jpg';
			copy($data->results[$key]->image, $path);
		}

	}


?>