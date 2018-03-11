<?
	// Добавить посетителя
	function insert__visitor($ip, $countVisit){
		global $db;
		$sql = 'INSERT INTO sm4_visitor
						(ip,
						count_visit,
						date_visit,
						date_create)
						VALUES (:ip, :count_visit, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)';
		$query= $db->prepare($sql);
		$query->bindParam(':ip', $ip);
		$query->bindParam(':count_visit', $countVisit);
		$query->execute();
	}
	
	// Обновить пользователя
	function update__visitor($id, $countVisit){
		global $db;
		$sql = 'UPDATE 
							sm4_visitor
						SET
							count_visit= :count_visit,
							date_visit= CURRENT_TIMESTAMP
						WHERE id = :id';
		$query= $db->prepare($sql);
		$query->bindParam(':id', $id);
		$query->bindParam(':count_visit', $countVisit);
		$query->execute();
	}

	// Получить пользователя
	function select__visitor_check($ip){
		global $db;
		$sql = 'SELECT 
							*
						FROM sm4_visitor
						WHERE ip = ?';
		$query= $db->prepare( $sql, array(PDO::FETCH_ASSOC) );
		$query->execute( array($ip) );
		return $query->fetchAll();
	}

	// Добавить клик посетителя
	function insert__visitor_click($idVisitor, $idSite){
		global $db;
		$sql = 'INSERT INTO sm4_click
						(id_visitor,
						id_site,
						date_click)
						VALUES (:id_visitor, :id_site, CURRENT_TIMESTAMP)';
		$query= $db->prepare($sql);
		$query->bindParam(':id_visitor', $idVisitor);
		$query->bindParam(':id_site', $idSite);
		$query->execute();
	}
?>