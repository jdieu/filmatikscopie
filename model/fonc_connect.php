<?php
	$mysql_host = "localhost";
	$mysql_database = "share2.0";
	$mysql_user = "root";
	$mysql_password = "";
	
	try
	{
		$bdd = new PDO('mysql:host='.$mysql_host.'; dbname='.$mysql_database, $mysql_user, $mysql_password);
		$bdd->exec("SET CHARACTER SET utf8");
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>