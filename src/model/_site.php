<? 
	$TIME_CASH= 1200;
	// Сайты раздела
	function select__sites_section($id){
		global $TIME_CASH;
		global $db;
		$file= 'tmp/select__sites_section.tmp'.$id;

		if( (filemtime($file) + $TIME_CASH)  <= time() ) {
			
			$sql = 'SELECT 
								si.*,
								ts.icon as type_icon,
								ts.name as type_name
							FROM sm4_site si
							INNER JOIN sm4_type_site ts ON ts.id = si.id_type
							INNER JOIN sm4_section se ON se.id = si.id_section
							WHERE si.hide = 0 AND se.id_parent = ?
							ORDER BY si.alexa_rank ASC
							LIMIT 100';
			$query= $db->prepare( $sql, array(PDO::FETCH_ASSOC) );
			$query->execute( array($id) );
			return $query->fetchAll();
		} else {
			return $arr = unserialize(file_get_contents($file));
		}
	}

	// Сайты подраздела
	function select__sites_subsection($id){
		global $TIME_CASH;
		global $db;
		$file= 'tmp/select__sites_subsection.tmp'.$id;

		if( (filemtime($file) + $TIME_CASH)  <= time() ) {
			$sql = 'SELECT 
								si.*,
								ts.icon as type_icon,
								ts.name as type_name
							FROM sm4_site si
							INNER JOIN sm4_type_site ts ON ts.id = si.id_type
							INNER JOIN sm4_section se ON se.id = si.id_section
							WHERE si.hide = 0 AND si.id_section = ?
							ORDER BY si.alexa_rank ASC';
			$query= $db->prepare( $sql, array(PDO::FETCH_ASSOC) );
			$query->execute( array($id) );
			return $query->fetchAll();
		} else {
			return $arr = unserialize(file_get_contents($file));
		}
	}

	// Проверка наличия сайта в базе
	function select__site_check($site){
		global $db;
		$sql = 'SELECT 
							*
						FROM sm4_site
						WHERE link = ? AND (hide = 1 OR hide = 0)';
		$query= $db->prepare( $sql, array(PDO::FETCH_ASSOC) );
		$query->execute( array($site) );
		return $query->fetchAll();
	}

	// Сайты на проверке
	function select__sites_hidden(){
		global $db;
		$sql = 'SELECT 
							si.*,
							se.id_parent as id_section_parent
						FROM sm4_site si
						INNER JOIN sm4_section se ON se.id = si.id_section
						WHERE si.hide = 1
						ORDER BY si.date_create DESC';
		$query= $db->prepare( $sql, array(PDO::FETCH_ASSOC) );
		$query->execute();
		return $query->fetchAll();
	}

	// Добавить сайт
	function insert__site($idSection, $idType, $idUser, $link, $linkRef, $hide, $comment, $mail, $alexaRank, $youtubeSubscriber, $youtubeBrowsing){
		global $db;
		$sql = 'INSERT INTO sm4_site
							(id_section,
							id_type,
							id_user,
							link,
							link_ref,
							hide,
							comment,
							mail,
							alexa_rank,
							youtube_subscriber,
							youtube_browsing,
							date_create)
						VALUES(:id_section, :id_type, :id_user, :link, :link_ref, :hide, :comment, :mail, :alexa_rank, :youtube_subscriber, :youtube_browsing, CURRENT_TIMESTAMP)';
		$query= $db->prepare($sql);
		$query->bindParam(':id_section', $idSection);
		$query->bindParam(':id_type', $idType);
		$query->bindParam(':id_user', $idUser);
		$query->bindParam(':link', $link);
		$query->bindParam(':link_ref', $linkRef);
		$query->bindParam(':hide', $hide);
		$query->bindParam(':comment', $comment);
		$query->bindParam(':mail', $mail);
		$query->bindParam(':alexa_rank', $alexaRank);
		$query->bindParam(':youtube_subscriber', $youtubeSubscriber);
		$query->bindParam(':youtube_browsing', $youtubeBrowsing);
		$query->execute();
		return $db->lastInsertId(); 
	}

	// Обновить сайт
	function update__site($idSite, $idSection, $idType, $link, $linkRef, $alexaRank, $hide){
		global $db;
		$sql = 'UPDATE 
							sm4_site
						SET
							id_section= :id_section,
							id_type= :id_type,
							link= :link,
							link_ref= :link_ref,
							alexa_rank= :alexa_rank,
							hide= :hide
						WHERE id = :id';
		$query= $db->prepare($sql);
		$query->bindParam(':id', $idSite);
		$query->bindParam(':id_section', $idSection);
		$query->bindParam(':id_type', $idType);
		$query->bindParam(':link', $link);
		$query->bindParam(':link_ref', $linkRef);
		$query->bindParam(':alexa_rank', $alexaRank);
		$query->bindParam(':hide', $hide);
		$query->execute();
	}

	// Обновить сайт
	function update__site_alexa($idSite, $alexaRank){
		global $db;
		$sql = 'UPDATE 
							sm4_site
						SET
							alexa_rank= :alexa_rank
						WHERE id = :id';
		$query= $db->prepare($sql);
		$query->bindParam(':id', $idSite);
		$query->bindParam(':alexa_rank', $alexaRank);
		$query->execute();
	}

	// Скрыть сайт
	function update__site_hidden($idSite, $hide){
		global $db;
		$sql = 'UPDATE 
							sm4_site
						SET
							hide= :hide
						WHERE id = :id';
		$query= $db->prepare($sql);
		$query->bindParam(':id', $idSite);
		$query->bindParam(':hide', $hide);
		$query->execute();
	}
?>