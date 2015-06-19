<?php
	function req_messages()
	{
		include('fonc_connect.php');
		
		$req_message = $bdd->prepare('SELECT * FROM forum ORDER BY id DESC');
		$req_message->execute() or die(print_r($bdd->errorInfo()));
		
		return $req_message;
	}

	function req_pseudo($pseudo)
	{
		include('./model/fonc_connect.php');
		
		$req_pseudo = $bdd->query('SELECT pseudo, COUNT(message) as nb_message FROM forum WHERE pseudo = "' . $pseudo . '"');
		
		return $req_pseudo;
	}
	
	function req_insert_message($date, $pseudo, $message)
	{
		include('fonc_connect.php');
		
		$req_insert_message = $bdd->prepare('INSERT INTO forum(date, pseudo, message) VALUES(:date, :pseudo, :message)');
		$req_insert_message->execute(array(':date' => $date, ':pseudo' => $pseudo, ':message' => $message)) or die(print_r($bdd->errorInfo()));
		
		return $req_insert_message;
	}
	
	function req_delete_message($id)
	{
		include('fonc_connect.php');

		$req_delete_message = $bdd->prepare('DELETE FROM forum WHERE id = :id');
		$req_delete_message->execute(array(':id' => $id)) or die(print_r($bdd->errorInfo()));
		
		return $req_delete_message;
	}
	
	function req_nb_message()
	{
		include('fonc_connect.php');
		
		$req_nb_message = $bdd->prepare('SELECT COUNT(*) as nb FROM forum');
		$req_nb_message->execute();
		$req_nb_message = $req_nb_message->fetch();
		
		return $req_nb_message['nb'];
	}
?>