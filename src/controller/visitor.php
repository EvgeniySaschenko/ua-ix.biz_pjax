<?
	// Добавить / обновить посетителя
	if( empty($_SESSION['visitor']['id']) ){
		$ip= $_SERVER['REMOTE_ADDR'];
		$visitorCheck= select__visitor_check($ip);

		if( !$visitorCheck[0]['id'] ){
			$countVisit= 1;
			insert__visitor($ip, $countVisit);
		}else{
			$idVisitor = $visitorCheck[0]['id'];
			$countVisit = $visitorCheck[0]['count_visit'] + 1;
			update__visitor($idVisitor, $countVisit);
		}
		
		$visitorCheck= select__visitor_check($ip);
		$_SESSION['visitor']['id']= $visitorCheck[0]['id'];
	}
?>
