<?php
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
	$dateAjoutFilm = $_POST['dateAjoutFilm'];
		
	include('../../model/fonc_connect.php');
	
	$req_ajout = $bdd->prepare('INSERT INTO films(titreFilm, dateSortieFilm, realisateursFilm, acteursFilm, genresFilm, nationaliteFilm, synopsisFilm, bandeAnnonceFilm, extensionFilm, afficheFilm, dateAjoutFilm) VALUES(:titreFilm, :dateSortieFilm, :realisateursFilm, :acteursFilm, :genresFilm, :nationaliteFilm, :synopsisFilm, :bandeAnnonceFilm, :extensionFilm, :afficheFilm, :dateAjoutFilm)');
	$req_ajout->execute(array(':titreFilm' => $titreFilm, ':dateSortieFilm' => $dateSortieFilm, ':realisateursFilm' => $realisateursFilm, ':acteursFilm' => $acteursFilm, ':genresFilm' => $genresFilm, ':nationaliteFilm' => $nationaliteFilm, ':synopsisFilm' => $synopsisFilm, ':bandeAnnonceFilm' => $bandeAnnonceFilm, ':extensionFilm' => $extensionFilm, ':afficheFilm' => $afficheFilm, ':dateAjoutFilm' => $dateAjoutFilm)) or die(print_r($bdd->errorInfo()));
	
	header('Location:../films.php?edit=');
?>