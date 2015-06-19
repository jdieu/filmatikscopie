<?php
	include('fonc_connect.php');
	
	$pseudo = $_GET['pseudo'];
	$all = $_GET['q'];
	$idFilm = $_GET['idfilm'];
	
	if ($all == 'all')
	{
		echo 'ALL';
		$req = $bdd->prepare('DELETE FROM favoris WHERE pseudoFavoris = :pseudoFavoris');
		$req->execute(array(':pseudoFavoris' => $pseudo)) or die(print_r($bdd->errorInfo()));
	}
	else
	{
		echo $idFilm;
		echo '<br />';
		echo $pseudo;
		$req = $bdd->prepare('DELETE FROM favoris WHERE pseudoFavoris = :pseudoFavoris AND idFilmFavoris = :idFilmFavoris');
		$req->execute(array(':pseudoFavoris' => $pseudo, ':idFilmFavoris' => $idFilm)) or die(print_r($bdd->errorInfo()));
	}
	
	header('Location:../favoris.php');
?>