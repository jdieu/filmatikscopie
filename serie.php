<?php
	session_start();

	if (isset($_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']))
	{
		$id_serie = $_GET['id'];
		$req_serie = $bdd->prepare('SELECT * FROM series WHERE id = :id');
		$req_serie->execute(array(':id' => $id_serie)) or die(print_r($bdd->errorInfo()));
		$donnees_serie = $req_serie->fetch();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('view/includes/include.php'); ?>
		<meta charset="utf-8" />
		<title><?php echo $donnees_serie['titreSerie']; ?> - Filmatiks</title>
	</head>
	
	<body onload="redim()" onresize="redim()">
		<div class="ink-grid">
			<?php include('view/includes/header.php'); ?>
			
			<div class="column-group gutters" style="margin-top : 20px; margin-bottom : 20px">
				<div class="xlarge-100 large-100 medium-100 small-100 tiny-100">
					<div class="panel">
						<h2>
							<?php echo $donnees_serie['titreSerie']; ?> - <?php echo $donnees_serie['dateSortieSerie']; ?>
						</h2>
								
						<div class="column-group gutters">
							<div id="gauche" class="xlarge-40 large-40 medium-50 small-100 tiny-100">
								<img id="image" style="width: 100%" src="<?php echo $donnees_serie['afficheSerie']; ?>" alt="<?php echo $donnees_serie['titreSerie']; ?>" title="<?php echo $donnees_serie['titreSerie']; ?>" />
								
								<p style="margin-top: 30px">
									<b>Réalisateur(s) :</b> <i><?php echo $donnees_serie['realisateursSerie']; ?></i><br />
									<b>Acteurs principaux :</b> <i><?php echo $donnees_serie['acteursSerie']; ?></i><br />
									<b>Genre(s) :</b> <i><?php echo $donnees_serie['genresSerie']; ?></i><br />
									<b>Nationalité :</b> <i><?php echo $donnees_serie['nationaliteSerie']; ?></i><br /><br />
									<i><b>Synopsis :</b></i><br />
									<?php echo $donnees_serie['synopsisSerie']; ?>
								</p>
							</div>
							
							<div class="xlarge-60 large-60 medium-50 small-100 tiny-100">
								<?php
									$tmp = explode('watch?v=', $donnees_serie['bandeAnnonceSerie']);
									$bandeAnnonce = $tmp[1];
								?>
								<object id="youtube" type="text/html" data="http://www.youtube.com/embed/<?php echo $bandeAnnonce; ?>" style="width:100%;height:100px;"></object>
							</div>
						</div>
						
						<?php
							$req_saisons_serie = $bdd->prepare('SELECT * FROM saisonsseries WHERE titreSerie = :titreSerie');
							$req_saisons_serie->execute(array(':titreSerie' => $donnees_serie['titreSerie'])) or die(print_r($bdd->errorInfo()));
							
							echo '<div class="column-group gutters">';
							
							$compteur = 0;
							$compteurScript = 0;
							while ($donnees_saison_serie = $req_saisons_serie->fetch())
							{
								if ($compteur == 3)
								{
									echo '</div><div class="column-group gutters">';
									$compteur = 0;
								}
						?>
						<div class="large-33 small-50 tiny-100">
							<div class="panel" style="background-color : #ededed; cursor : pointer" id="img_<?php echo $compteurScript; ?>" onclick="affich_<?php echo $compteurScript; ?>();">
								<div>
									<div style="display : inline-block;">
										<h4><?php echo $donnees_saison_serie['numeroSaison']; ?></h4>
									</div>
									
									<div style="float :right">
										<img src="view/data/icons/down.png" />
									</div>
								</div>
								
								<div class="description" id="<?php echo $compteurScript; ?>" style="display : none">
									<?php
										$req_episodes = $bdd->prepare('SELECT * FROM saisonsseries WHERE numeroSaison = :numeroSaison AND titreSerie = :titreSerie');
										$req_episodes->execute(array(':numeroSaison' => $donnees_saison_serie['numeroSaison'], 'titreSerie' => $donnees_serie['titreSerie'])) or die(print_r($bdd->errorInfo()));
										$donnees_episodes = $req_episodes->fetch();
										
										for ($episode = 1; $episode <= $donnees_episodes['nbEpisodes']; $episode++)
										{
											echo '<a href="#">Episode ' . $episode . '</a><br />';
										}
									?>
								</div>
							</div>
						</div>
						
						<script type="text/javascript">
							function affich_<?php echo $compteurScript; ?>()
							{
								var div = document.getElementById("<?php echo $compteurScript; ?>");
								
								if (div.style.display=="none")
								{
									div.style.display = "block";
								}
								else
								{
									div.style.display = "none";
								}
							}
						</script>
						<?php
								$compteur++;
								$compteurScript++;
							}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script>
			function redim()
			{
				var hauteurImage = document.getElementById('gauche').offsetHeight;
				document.getElementById('youtube').style.height = hauteurImage + 'px';
			}
		</script>
	</body>
</html>
<?php
	}
	else
	{
		header('Location:lock.php');
	}
?>