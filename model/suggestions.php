<meta charset="utf-8" />
<?php
	include('fonc_connect.php');
	
	$dateSuggestion = date('d\/m\/Y \- H:i:s');
	$filmSuggestion = $_POST['film'];
	$pseudoSuggestion = $_POST['pseudo'];
	$commentaireSuggestion = $_POST['commentaire'];
	
	$virgule = stripos($filmSuggestion, ',');
	
	if ($virgule !== false)
	{
		echo 'virgule trouvée<br />';
		$tmp = explode(',', $filmSuggestion);
		$nb_films = count($tmp);
		
		for ($i = 0; $i < $nb_films; $i++)
		{
			if ($tmp[$i][0] == ' ')
			{
				$tmp[$i] = substr($tmp[$i], 1);
			}
			
			echo '|' . $tmp[$i] . '|<br />';
			
			$req_suggestion = $bdd->prepare('INSERT INTO suggestions(dateSuggestion, filmSuggestion, pseudoSuggestion, commentaireSuggestion) VALUES(:dateSuggestion, :filmSuggestion, :pseudoSuggestion, :commentaireSuggestion)');
			$req_suggestion->execute(array(':dateSuggestion' => $dateSuggestion, ':filmSuggestion' => $tmp[$i], ':pseudoSuggestion' => $pseudoSuggestion, ':commentaireSuggestion' => $commentaireSuggestion)) or die(print_r($bdd->errorInfo()));
		}
	}
	else
	{
		$req_suggestion = $bdd->prepare('INSERT INTO suggestions(dateSuggestion, filmSuggestion, pseudoSuggestion, commentaireSuggestion) VALUES(:dateSuggestion, :filmSuggestion, :pseudoSuggestion, :commentaireSuggestion)');
		$req_suggestion->execute(array(':dateSuggestion' => $dateSuggestion, ':filmSuggestion' => $filmSuggestion, ':pseudoSuggestion' => $pseudoSuggestion, ':commentaireSuggestion' => $commentaireSuggestion)) or die(print_r($bdd->errorInfo()));
	}

	header('Location:../suggestions.php');
?>