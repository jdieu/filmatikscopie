<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Attention - Atteinte à la sécurité</title>
	<head>
	
	<body onload="redim()" onresize="redim()" style="background-color: #e9e9e9">
		<div id="div" style="display: inline-block">
			<img src="view/data/icons/lock.png" />
		</div>
		
		<?php
			include('model/fonc_connect.php');
			
			$adresseIp = $_SERVER['REMOTE_ADDR'];
			$userAgent = $_SERVER['HTTP_USER_AGENT'];
			$protocole = $_SERVER['SERVER_PROTOCOL'];
			$methodeRequete = $_SERVER['REQUEST_METHOD'];
			$tempsRequete = $_SERVER['REQUEST_TIME'];
			$date = date('d\/m\/Y \- H:i:s');
			
			// echo '<br /><br />';
			// echo 'adresse IP : ' . $adresseIP . '<br />';
			// echo 'userAgent : ' . $userAgent . '<br />';
			// echo 'date : ' . $date . '<br />';
			
			$req_ip = $bdd->prepare('INSERT INTO locksecure(adresseIp, userAgent, protocole, methodeRequete, tempsRequete, date) VALUES(:adresseIp, :userAgent, :protocole, :methodeRequete, :tempsRequete, :date)');
			$req_ip->execute(array(':adresseIp' => $adresseIp, ':userAgent' => $userAgent, ':protocole' => $protocole, ':methodeRequete' => $methodeRequete, 'tempsRequete' => $tempsRequete, ':date' => $date)) or die(print_r($bdd->errorInfo()));
		?>
		
		<script>
			function redim()
			{
				var hauteurFenetre = window.innerHeight;
				var hauteur = document.getElementById('div').offsetHeight;
				var marginTop = ((hauteurFenetre - hauteur) / 2) - 40;
				document.getElementById('div').style.marginTop = marginTop + "px";
				
				var largeurFenetre = window.innerWidth;
				var largeur = document.getElementById('div').offsetWidth;
				var marginLeft = ((largeurFenetre - largeur) / 2);
				document.getElementById('div').style.marginLeft = marginLeft + "px";
			}
		</script>
	</body>
</html>