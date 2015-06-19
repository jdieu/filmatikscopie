<?php
	$id = $_POST['id'];
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
	
	include('../../model/fonc_connect.php');

	$req_modification = $bdd->prepare('UPDATE series SET titreSerie = :titreSerie, dateSortieSerie = :dateSortieSerie, realisateursSerie = :realisateursSerie, acteursSerie = :acteursSerie, genresSerie = :genresSerie, nationaliteSerie = :nationaliteSerie, synopsisSerie = :synopsisSerie, bandeAnnonceSerie = :bandeAnnonceSerie, extensionSerie = :extensionSerie, afficheSerie = :afficheSerie WHERE id = :id');
	$req_modification->execute(array(':titreSerie' => $titreSerie, ':dateSortieSerie' => $dateSortieSerie, ':realisateursSerie' => $realisateursSerie, ':acteursSerie' => $acteursSerie, ':genresSerie' => $genresSerie, ':nationaliteSerie' => $nationaliteSerie, ':synopsisSerie' => $synopsisSerie, ':bandeAnnonceSerie' => $bandeAnnonceSerie, ':extensionSerie' => $extensionSerie, ':afficheSerie' => $afficheSerie, ':id' => $id)) or die(print_r($bdd->errorInfo()));
	
	header('Location:../series.php?edit=');
?>