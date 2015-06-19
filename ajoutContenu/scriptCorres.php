<meta charset="utf-8">
<?php
	include('model/fonc_connect.php');
	
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
?>