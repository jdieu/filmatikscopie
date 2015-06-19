<?php
	$titreSerie = $_POST['titreSerie'];
	$dateSortieSerie = $_POST['dateSortieSerie'];
	$realisateursSerie = $_POST['realisateursSerie'];
	$acteursSerie = $_POST['acteursSerie'];
	$genresSerie = $_POST['genresSerie'];
	$nationaliteSerie = $_POST['nationaliteSerie'];
	$synopsisSerie = $_POST['synopsisSerie'];
	$bandeAnnonceSerie = $_POST['bandeAnnonceSerie'];
	$extensionSerie = $_POST['extensionSerie'];
	$afficheSerie = $_POST['afficheSerie'];
	$dateAjoutSerie = $_POST['dateAjoutSerie'];
		
	include('../../model/fonc_connect.php');
	
	$req_ajout = $bdd->prepare('INSERT INTO series(titreSerie, dateSortieSerie, realisateursSerie, acteursSerie, genresSerie, nationaliteSerie, synopsisSerie, bandeAnnonceSerie, extensionSerie, afficheSerie, dateAjoutSerie) VALUES(:titreSerie, :dateSortieSerie, :realisateursSerie, :acteursSerie, :genresSerie, :nationaliteSerie, :synopsisSerie, :bandeAnnonceSerie, :extensionSerie, :afficheSerie, :dateAjoutSerie)');
	$req_ajout->execute(array(':titreSerie' => $titreSerie, ':dateSortieSerie' => $dateSortieSerie, ':realisateursSerie' => $realisateursSerie, ':acteursSerie' => $acteursSerie, ':genresSerie' => $genresSerie, ':nationaliteSerie' => $nationaliteSerie, ':synopsisSerie' => $synopsisSerie, ':bandeAnnonceSerie' => $bandeAnnonceSerie, ':extensionSerie' => $extensionSerie, ':afficheSerie' => $afficheSerie, ':dateAjoutSerie' => $dateAjoutSerie)) or die(print_r($bdd->errorInfo()));
	
	header('Location:../series.php?edit=');
?>