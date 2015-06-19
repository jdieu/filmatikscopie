<?php
	session_start();
	
	if (isset($_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']))
	{
		header('Location:films.php?page=1');
	}
	else
	{
		header('Location:connexion.php?er=0');
	}
?>