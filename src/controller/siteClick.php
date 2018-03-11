<?
	include('../general.php');
	
	insert__visitor_click($_SESSION['visitor']['id'], $_GET["id_site"]);
	header('Location:http://'.$_GET['link']);
?>