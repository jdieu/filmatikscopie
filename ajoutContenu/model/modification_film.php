<?php
	$id = $_POST['id'];
	$titreFilm = $_POST['titreFilm'];
	$dateSortieFilm = $_POST['dateSortieFilm'];
	$realisateursFilm = $_POST['realisateursFilm'];
	$acteursFilm = $_POST['acteursFilm'];
	$genresFilm = $_POST['genresFilm'];
	$nationaliteFilm = $_POST['nationaliteFilm'];
	$synopsisFilm = $_POST['synopsisFilm'];
	$bandeAnnonceFilm = $_POST['bandeAnnonceFilm'];
	$extensionFilm = $_POST['extensionFilm'];
	$afficheFilm = $_POST['afficheFilm'];
	
	include('../../model/fonc_connect.php');

	$req_modification = $bdd->prepare('UPDATE films SET titreFilm = :titreFilm, dateSortieFilm = :dateSortieFilm, realisateursFilm = :realisateursFilm, acteursFilm = :acteursFilm, genresFilm = :genresFilm, nationaliteFilm = :nationaliteFilm, synopsisFilm = :synopsisFilm, bandeAnnonceFilm = :bandeAnnonceFilm, extensionFilm = :extensionFilm, afficheFilm = :afficheFilm WHERE id = :id');
	$req_modification->execute(array(':titreFilm' => $titreFilm, ':dateSortieFilm' => $dateSortieFilm, ':realisateursFilm' => $realisateursFilm, ':acteursFilm' => $acteursFilm, ':genresFilm' => $genresFilm, ':nationaliteFilm' => $nationaliteFilm, ':synopsisFilm' => $synopsisFilm, ':bandeAnnonceFilm' => $bandeAnnonceFilm, ':extensionFilm' => $extensionFilm, ':afficheFilm' => $afficheFilm, ':id' => $id)) or die(print_r($bdd->errorInfo()));
	
	header('Location:../films.php?edit=');
?>