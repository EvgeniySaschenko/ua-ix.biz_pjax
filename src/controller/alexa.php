<?
	include('../general.php');

		$sitesSection= select__sites_subsection($_GET['id_section']);

		foreach($sitesSection as $site){
			$xml = simplexml_load_file('http://data.alexa.com/data?cli=10&url='.$site['link']);
			if(isset($xml->SD->REACH))
				$alexaRank = $xml->SD->REACH->attributes()->RANK;
			else
				$alexaRank = 20000000;
			update__site_alexa($site['id'], $alexaRank);
		}

?>