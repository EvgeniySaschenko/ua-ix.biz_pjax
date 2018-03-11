<? 
	// Разделы
	function select__nav(){
		global $db;
		$sql = 'SELECT
									se.*,
									su.link as link_section
						FROM sm4_section se
						LEFT OUTER JOIN sm4_section su ON se.id_parent = su.id
						WHERE se.hide = 0
						ORDER BY se.priority ASC, se.id_parent ASC';
		$query= $db->query($sql, PDO::FETCH_ASSOC);
		return $query->fetchAll();
	}

	// Подразделы
	function select__nav_subsection($id){
		global $db;
		$sql = 'SELECT 
							su.*
						FROM sm4_section su
						LEFT OUTER JOIN sm4_section se ON su.id_parent = se.id_parent
						WHERE su.hide = 0 AND se.id = ? AND su.id_parent <> su.id
						ORDER BY su.priority ASC';
		$query= $db->prepare( $sql, array(PDO::FETCH_ASSOC) );
		$query->execute( array($id) );
		return $query->fetchAll();
	}
?>