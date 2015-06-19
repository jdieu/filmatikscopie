<?php
	$pseudo = $_GET['pseudo'];
	$idFilm = $_GET['idfilm'];
	$note = $_GET['note'];
	
	include('fonc_connect.php');
	
	$req = $bdd->prepare('INSERT INTO noteS(pseudoNote, idFilmNote, etoilesNote) VALUES(:pseudoNote, :idFilmNote, :etoilesNote)');
	$req->execute(array(':pseudoNote' => $pseudo, ':idFilmNote' => $idFilm, ':etoilesNote' => $note)) or die(print_r($bdd->errorInfo()));
	
	header('Location:../film.php?id=' . $idFilm);
?>