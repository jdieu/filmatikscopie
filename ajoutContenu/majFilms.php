<?php
	include('model/fonc_connect.php');
	
	$req = $bdd->prepare('SELECT * FROM films');
	$req->execute() or die(print_r($bdd->errorInfo()));
	
	$compteur = 1;
	while ($donnees = $req->fetch())
	{
		$req2 = $bdd->prepare('UPDATE films SET id = "' . $compteur . '" WHERE id = "' . $donnees['id'] . '"');
		$req2->execute();
		
		$compteur++;
	}
	
	$req3 = $bdd->prepare('ALTER TABLE films AUTO_INCREMENT=' . $compteur);
	$req3->execute();
?>