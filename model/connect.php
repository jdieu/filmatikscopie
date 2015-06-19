<?php
	if (empty($_POST['login']) && empty($_POST['mdp']))
	{
		header('Location:./index.php');
	}
	else
	{
		include_once('fonc_connect.php');
		
		$login = htmlspecialchars($_POST['login']);
		$pass = htmlspecialchars($_POST['mdp']);
		$pass = md5($pass);
		
		$req = $bdd->prepare('SELECT id FROM profils WHERE pseudo = :pseudo AND motdepasse = :pass');
		$req->execute(array('pseudo' => $login, 'pass' => $pass));
		
		$resultat = $req->fetch();
		
		if (!$resultat)
		{
			header('Location:../connexion.php?er=1');
		}
		else
		{
			session_start();

			$_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] = $login;
			$date = date('d\/m\/Y \- H:i:s');
			
			$req = $bdd->prepare('UPDATE profils SET connexion = :connexion WHERE pseudo = "' . $login . '"');
			$req->execute(array(':connexion' => $date)) or die(print_r($bdd->errorInfo()));

			header('Location:../films.php?page=1');
		}
	}
?>