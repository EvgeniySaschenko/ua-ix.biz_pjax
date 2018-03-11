<?
	include('db.php');
	$db= new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASS);
	include('_nav.php');
	include('_site.php');
	include('_typesSite.php');
	include('_user.php');
	include('_visitor.php');
?>