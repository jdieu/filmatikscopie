<meta charset="utf-8">
<?php
	include('model/fonc_connect.php');
	
	echo 'création de la table tmp ...<br />';
	$req_create = $bdd->prepare('CREATE TABLE tmp( id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, titreFilm TEXT NOT NULL, dateSortieFilm TEXT NOT NULL, realisateursFilm TEXT NOT NULL, acteursFilm TEXT NOT NULL, genresFilm TEXT NOT NULL, nationaliteFilm TEXT NOT NULL, synopsisFilm TEXT NOT NULL, bandeAnnonceFilm TEXT NOT NULL, extensionFilm TEXT NOT NULL, afficheFilm TEXT NOT NULL, dateAjoutFilm TEXT NOT NULL)');
	$req_create->execute() or die(print_r($bdd->errorInfo()));
	echo '<br />fin de création de la table tmp<br />';
	
	echo '<br />complétion de la table tmp ...<br />';
	$req = $bdd->prepare('SELECT * FROM films ORDER BY titreFilm ASC');
	$req->execute() or die(print_r($bdd->errorInfo()));
	
	while ($donnees = $req->fetch())
	{
		$titreFilm = $donnees['titreFilm'];
		$dateSortieFilm = $donnees['dateSortieFilm'];
		$realisateursFilm = $donnees['realisateursFilm'];
		$acteursFilm = $donnees['acteursFilm'];
		$genresFilm = $donnees['genresFilm'];
		$nationaliteFilm = $donnees['nationaliteFilm'];
		$synopsisFilm = $donnees['synopsisFilm'];
		$bandeAnnonceFilm = $donnees['bandeAnnonceFilm'];
		$extensionFilm = $donnees['extensionFilm'];
		$afficheFilm = $donnees['afficheFilm'];
		$dateAjoutFilm = $donnees['dateAjoutFilm'];
	
		$req_ajout = $bdd->prepare('INSERT INTO tmp(titreFilm, dateSortieFilm, realisateursFilm, acteursFilm, genresFilm, nationaliteFilm, synopsisFilm, bandeAnnonceFilm, extensionFilm, afficheFilm, dateAjoutFilm) VALUES(:titreFilm, :dateSortieFilm, :realisateursFilm, :acteursFilm, :genresFilm, :nationaliteFilm, :synopsisFilm, :bandeAnnonceFilm, :extensionFilm, :afficheFilm, :dateAjoutFilm)');
		$req_ajout->execute(array(':titreFilm' => $titreFilm, ':dateSortieFilm' => $dateSortieFilm, ':realisateursFilm' => $realisateursFilm, ':acteursFilm' => $acteursFilm, ':genresFilm' => $genresFilm, ':nationaliteFilm' => $nationaliteFilm, ':synopsisFilm' => $synopsisFilm, ':bandeAnnonceFilm' => $bandeAnnonceFilm, ':extensionFilm' => $extensionFilm, ':afficheFilm' => $afficheFilm, ':dateAjoutFilm' => $dateAjoutFilm)) or die(print_r($bdd->errorInfo()));
	}
	echo '<br />fin de complétion de la table tmp<br />';
	
	echo '<br />suppression de la table films ...<br />';
	$req_sup_films = $bdd->prepare('DROP TABLE films');
	$req_sup_films->execute() or die(print_r($bdd->errorInfo()));
	echo '<br />fin suppression de la table films<br />';
	
	echo '<br />renommage de la table tmp en films ...<br />';
	$req_rename = $bdd->prepare('RENAME TABLE tmp TO films');
	$req_rename->execute() or die(print_r($bdd->errorInfo()));
	echo '<br />fin renommage de la table tmp en films<br />';
	
	
	echo '<br />suppression du contenu de la table corresgenrefilm ...<br />';
	$req_vider = $bdd->prepare('TRUNCATE TABLE corresgenrefilm');
	$req_vider->execute() or die(print_r($bdd->errorInfo()));
	echo '<br />fin suppression contenu de la table corresgenrefilm<br />';
	
	echo '<br />création correspondance entre les films et leurs genres ...<br />';
	$req_film = $bdd->prepare('SELECT * FROM films');
	$req_film->execute() or die(print_r($bdd->errorInfo()));
	
	while ($donnees_film = $req_film->fetch())
	{
		echo '###<br />';
		$req_test = $bdd->prepare('SELECT * FROM corresgenrefilm WHERE idFilm = "' . $donnees_film['id'] . '"');
		$req_test->execute() or die(print_r($bdd->errorInfo()));
		$donnees_test = $req_test->fetch();
		
		if (empty($donnees_test))
		{
			$tmp = explode(', ', $donnees_film['genresFilm']);
		
			$nb_genres = count($tmp);
			
			for ($i = 0; $i < $nb_genres; $i++)
			{
				// echo $tmp[$i] . '<br />';
				
				$req_genre = $bdd->prepare('SELECT * FROM genres WHERE titreGenre = "' . $tmp[$i] . '"');
				$req_genre->execute() or die(print_r($bdd->errorInfo()));
				$donnees_genre = $req_genre->fetch();
				
				echo $donnees_film['titreFilm'] . ' = ' . $donnees_film['id'] . ' : ' . $donnees_genre['titreGenre'] . ' = ' . $donnees_genre['id'] . '<br />';
				
				$req_insertion = $bdd->prepare('INSERT INTO corresgenrefilm(idFilm, idGenre) VALUES(:idFilm, :idGenre)');
				$req_insertion->execute(array(':idFilm' => $donnees_film['id'], ':idGenre' => $donnees_genre['id'])) or die(print_r($bdd->errorInfo()));
			}
		}
		else
		{
			echo 'pas vide<br />';
		}
		
		echo '###<br />';
	}
	echo '<br />fin création correspondance entre les films et leurs genres ...<br />';
	echo '<br /><br />###################################### TOUT FONCTIONNE BIEN NAVETTE :-) ######################################<br /><br /><br />';
?>