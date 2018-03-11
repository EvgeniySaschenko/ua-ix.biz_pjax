<? 
	// Типы сайтов
	function select__typesSite(){
		global $db;
		$sql = 'SELECT 
							*
						FROM sm4_type_site';
		$query= $db->query($sql, PDO::FETCH_ASSOC);
		return $query->fetchAll();
	}
?>