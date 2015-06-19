<?php
	$pseudo = $_GET['pseudo'];
	$idFilm = $_GET['idfilm'];

	include('fonc_connect.php');
	
	$req = $bdd->prepare('SELECT count(*) as test FROM favoris WHERE pseudoFavoris = "' . $pseudo . '" AND idFilmFavoris = "' . $idFilm . '"');
	$req->execute();
	$req = $req->fetch();
	
	if ($req['test'] == 0)
	{
		$req_ajout_fav = $bdd->prepare('INSERT INTO favoris(pseudoFavoris, idFilmFavoris) VALUES(:pseudo, :idFilm)');
		$req_ajout_fav->execute(array(':pseudo' => $pseudo, ':idFilm' => $idFilm)) or die(print_r($bdd->errorInfo()));
		echo 'OK';
	}
	
	header('Location:../film.php?id=' . $idFilm);

?>