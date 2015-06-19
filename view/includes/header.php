<?php include('model/requetes_forum.php'); ?>
<?php include('model/fonc_connect.php'); ?>

<style>
	#ajout
	{
		-webkit-animation: none 1s infinite; /* Chrome, Safari, Opera */
		animation: none 1s infinite;
	}

	@-webkit-keyframes deplie /* Chrome, Safari, Opera */
	{
		from
		{
			right: -130px;
		}

		to
		{
			right: 0px;
		}
	}

	@keyframes deplie
	{
		from
		{
			right: -130px;
		}

		to
		{
			right: 0px;
		}
	}
	
	@-webkit-keyframes replie /* Chrome, Safari, Opera */
	{
		from
		{
			right: 0px;
		}

		to
		{
			right: -130px;
		}
	}
	
	@keyframes replie
	{
		from
		{
			right: 0px;
		}

		to
		{
			right: -130px;
		}
	}
</style>

<header class="clearfix vertical-padding" id="header">
	<div class="logo xlarge-push-left large-push-left">
		<a href="./index.php">
		<?php
			$chemin_racine = './view/data/filmatiks/';
			$dossier = opendir($chemin_racine);
			
			$tabLogo = array();
			$compteur = 0;
			while (($fichier = readdir($dossier)) != false)
			{
				if ($fichier != '.' && $fichier != '..' && $fichier != 'index.html')
				{
					$tabLogo[$compteur] = $fichier;
					$compteur++;
				}
			}
			closedir($dossier);
			
			$rand = rand(0, $compteur-1);
		?>
			<img src="<?php echo $chemin_racine . $tabLogo[$rand]; ?>" />
		</a>
	</div>
	<?php
		$chemin_page = $_SERVER['PHP_SELF'];
		$page = basename($chemin_page);
		
		if ($page == 'connexion.php')
		{
	?>
	<nav class="ink-navigation xlarge-push-right large-push-right half-top-space">
		<ul class="menu horizontal black">
			<li><a href="#"><img style="margin-top: 5px" src="view/data/icons/locked.png" /></a></li>
			<li><a href="#">Tu dois te connecter pour accéder au reste du site</a></li>

			<!--<li><a href="#">Films</a></li>
			<li><a href="#">Séries</a></li>
			<li><a href="#">Favoris</a></li>
			<li><a href="#">Forum</a></li>
			<li><a href="#">Profil</a></li>-->
		</ul>
	</nav>
	<?php
		}
		else
		{
	?>
	<nav class="ink-navigation xlarge-push-right large-push-right half-top-space">
		<ul class="menu horizontal black">
			<li style="padding-left: 10px; padding-top: 8px; padding-right: 10px">
				<form method="POST" action="recherche.php" accept-charset="UTF-8"><input style="width: 130px" type="text" name="search" placeholder="search" /><img style="margin-left: -20px; margin-top: 7px" src="view/data/icons/search.png" /></form>
			</li>
			<li><a href="films.php?page=1">Films</a></li>
			<li><a href="series.php">Séries</a></li>
			<li><a href="recherche.php?q=0">Recherche</a></li>
			<li><a href="favoris.php">Favoris</a></li>
			<li><a href="suggestions.php">Suggestions</a></li>
			<li><a href="forum.php?er=0">Forum</a></li>
			<li><a href="profil.php">Profil</a></li>
			<li><a href="connexion.php?er=0"><img style="margin-top: 7px" src="view/data/icons/logout.png" alt="déconnexion" title="déconnexion" /></a></li>
		</ul>
	</nav>
	<?php
		}
	?>
</header>

<?php
	if ($page != 'connexion.php')
	{
		if ($_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] == 'admin')
		{
?>
<div id="ajout" style="position: fixed; bottom: 0px; right: -130px; margin: 20px; width: 150px" onmouseover="deplie()" onmouseout="replie()">
	<div class="ajout" style="background-color: #1a1a1a; border-radius: 2px; padding-top: 10px; padding-bottom: 10px; margin-bottom: 15px">
		<img style="margin-left: 8px; margin-right: 10px; cursor: pointer" src="view/data/icons/left.png" /><a style="text-decoration: none; color: white; text-align: center" href="ajoutContenu/films.php?edit=" target="_blank">Ajouter Film</a>
	</div>

	<div class="ajout" style="background-color: #1a1a1a; border-radius: 2px; padding-top: 10px; padding-bottom: 10px">
		<img style="margin-left: 8px; margin-right: 10px; cursor: pointer" src="view/data/icons/left.png" /><a style="text-decoration: none; color: white; text-align: center" href="ajoutContenu/series.php?edit=" target="_blank">Ajouter Série</a>
	</div>
</div>

<script>
	function deplie()
	{
		document.getElementById('ajout').style.WebkitAnimation = "deplie 0.75s 2"; // Code for Chrome, Safari and Opera
		document.getElementById('ajout').style.animation = "deplie 0.75s 1";
		document.getElementById('ajout').style.right = "0px";
	}
	
	function replie()
	{
		document.getElementById('ajout').style.WebkitAnimation = "replie 0.75s 2"; // Code for Chrome, Safari and Opera
		document.getElementById('ajout').style.animation = "replie 0.75s 1";
		document.getElementById('ajout').style.right = "-130px";
	}
</script>

<?php
		}
	}
?>