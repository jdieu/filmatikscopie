<?php
	session_start();

	if (isset($_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']))
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('view/includes/include.php'); ?>
		<meta charset="utf-8" />
		<title>Favoris - Filmatiks</title>
	</head>
	
	<body>
		<div class="ink-grid">
			<?php include('view/includes/header.php'); ?>
			
			<div class="column-group gutters" style="margin-top : 20px; margin-bottom : 20px">
				<div class="large-25 small-25 tiny-100"></div>
				<div class="large-50 small-50 tiny-100">
					<div class="panel">
						<div style="display : inline-block;">
							<h2>Favoris</h2>
						</div>
						
						<?php
						$req = $bdd->prepare('SELECT count(*) as test FROM favoris WHERE pseudoFavoris = "' . $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] . '"');
						$req->execute();
						$req = $req->fetch();
						
						if ($req['test'] >= 1)
						{
						?>
						<div style="float :right; margin-right : 10px">
							<a style="text-decoration : none; color : #404040" href="model/sup_fav.php?pseudo=<?php echo $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']; ?>&q=all">
								<button class="ink-button">Tout supprimer</button>
							</a>
						</div>
						<?php
						}
	
						$req = $bdd->prepare('SELECT count(*) as test FROM favoris WHERE pseudoFavoris = "' . $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] . '"');
						$req->execute();
						$req = $req->fetch();
						
						if ($req['test'] >= 1)
						{
							$req2 = $bdd->prepare('SELECT * FROM favoris WHERE pseudoFavoris = "' . $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] . '"');
							$req2->execute();
							
							while ($donnees = $req2->fetch())
							{
								$req3 = $bdd->prepare('SELECT * FROM films WHERE id = "' . $donnees['idFilmFavoris'] . '"');
								$req3->execute();
								$donnees3 = $req3->fetch();
					?>
					<div style="margin-bottom : 5px; text-decoration : none">
						<div style="display : inline-block;">
							<a href="film.php?id=<?php echo $donnees['idFilmFavoris']; ?>">
								<?php echo $donnees3['titreFilm']; ?>
							</a>
						</div>
						
						<div style="float :right; margin-right : 10px">
							<a href="model/sup_fav.php?pseudo=<?php echo $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']; ?>&idfilm=<?php echo $donnees['idFilmFavoris']; ?>&q=1">
								<img src="view/data/icons/close.png" />
							</a>
						</div>
					</div>
					<?php
							}
						}
						else
						{
							echo '<center>Vous n\'avez aucun favoris</center>';
						}
					?>
					</div>
				</div>
				
				<div class="large-25 small-25 tiny-100"></div>
			</div>
		</div>
	</body>
</html>
<?php
	}
	else
	{
		header('Location:lock.php');
	}
?>