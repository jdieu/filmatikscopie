<?php
	$pseudo = $_GET['pseudo'];
	$idCommentaire = $_GET['idCommentaire'];
	
	include('fonc_connect.php');
	include('requetes_forum.php');
	
	$sup = req_delete_message($idCommentaire);
		
	header('Location:../forum.php?er=0');
?>