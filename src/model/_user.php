<?
	// Добавить пользователя
	function insert__user($idSocial, $idSex, $network, $homeTown, $firstName, $lastName, $likPhoto, $dateBirth, $ip, $userAgent){
		global $db;
		$sql = 'INSERT INTO sm4_user
							(id_social,
							id_sex,
							network,
							home_town,
							first_name,
							last_name,
							link_photo,
							date_birth,
							date_visit,
							date_create,
							ip,
							user_agent)
						VALUES(:id_social, :id_sex, :network, :home_town, :first_name, :last_name, :link_photo, :date_birth, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :ip, :user_agent)';
		$query= $db->prepare($sql);
		$query->bindParam(':id_social', $idSocial);
		$query->bindParam(':id_sex', $idSex);
		$query->bindParam(':network', $network);
		$query->bindParam(':home_town', $homeTown);
		$query->bindParam(':first_name', $firstName);
		$query->bindParam(':last_name', $lastName);
		$query->bindParam(':link_photo', $likPhoto);
		$query->bindParam(':date_birth', $dateBirth);
		$query->bindParam(':ip', $ip);
		$query->bindParam(':user_agent', $userAgent);
		$query->execute();
	}
	
	// Получить пользователя
	function select__user($idSocial, $network){
		global $db;
		$sql = 'SELECT 
							u.*
						FROM sm4_user u
						WHERE u.id_social = ? AND u.network = ?';
		$query= $db->prepare( $sql, array(PDO::FETCH_ASSOC) );
		$query->execute( array($idSocial, $network) );
		return $query->fetchAll();
	}

	// Обновить пользователя
	function update__user($idSex, $homeTown, $firstName, $lastName, $likPhoto, $dateBirth, $ip, $userAgent, $idSocial, $network){
		global $db;
		$sql = 'UPDATE 
							sm4_user
						SET
							id_sex= :id_sex,
							home_town= :home_town,
							first_name= :first_name,
							last_name= :last_name,
							link_photo= :link_photo,
							date_birth= :date_birth,
							date_visit= CURRENT_TIMESTAMP,
							ip= :ip,
							user_agent= :user_agent 
						WHERE id_social = :id_social AND network = :network';
		$query= $db->prepare($sql);
		$query->bindParam(':id_sex', $idSex);
		$query->bindParam(':home_town', $homeTown);
		$query->bindParam(':first_name', $firstName);
		$query->bindParam(':last_name', $lastName);
		$query->bindParam(':link_photo', $likPhoto);
		$query->bindParam(':date_birth', $dateBirth);
		$query->bindParam(':ip', $ip);
		$query->bindParam(':user_agent', $userAgent);
		$query->bindParam(':id_social', $idSocial);
		$query->bindParam(':network', $network);
		$query->execute();
	}
?>