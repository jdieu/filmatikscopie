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
		<title>Séries - Filmatiks</title>
	</head>
	
	<body onload="redim()">
		<div class="ink-grid">
			<?php include('view/includes/header.php'); ?>
			
			<div class="column-group gutters" style="margin-top : 20px; margin-bottom : 20px">
				<div class="all-100">
					<div class="panel" style="padding-top: 30px">
						<?php
							$req_list = $bdd->prepare('SELECT * FROM series ORDER BY titreSerie');
							$req_list->execute() or die(print_r($bdd->errorInfo()));
							
							echo '<div class="column-group gutters">';
							
							$compteur = 0;
							while ($donnees_list = $req_list->fetch())
							{
								$req_saison = $bdd->prepare('SELECT count(*) as nbSaisons FROM saisonsseries WHERE titreSerie = :titre');
								$req_saison->execute(array(':titre' => $donnees_list['titreSerie'])) or die(print_r($bdd->errorInfo()));
								$nb_saisons = $req_saison->fetch();
								
								if ($compteur == 2)
								{
									echo '</div><div class="column-group gutters">';
									$compteur = 0;
								}
						?>
						<div class="xlarge-50 large-50 medium-50 small-50 tiny-100">
							<div class="column-group gutters">
								<div class="xlarge-30 large-30 medium-100 small-100 tiny-100">
									<a href="serie.php?id=<?php echo $donnees_list['id']; ?>">
										<img src="<?php echo $donnees_list['afficheSerie']; ?>" alt="<?php echo $donnees_list['titreSerie']; ?>" title="<?php echo $donnees_list['titreSerie']; ?>" />
									</a>
								</div>
								<div class="xlarge-70 large-70 medium-100 small-100 tiny-100">
									<p>
										<a style="font-size: 1.3em; font-weight: bold; color: #404040; text-decoration: none" href="serie.php?id=<?php echo $donnees_list['id']; ?>">
											<b style="font-size: 1.3em"><?php echo $donnees_list['titreSerie']; ?></b>
										</a><br />
										de <i><?php echo $donnees_list['realisateursSerie']; ?></i><br />
										avec <?php $tmp = explode(', ', $donnees_list['acteursSerie']); echo $tmp[0] . ', ' . $tmp[1] . ', ...'; ?><br />
										<i style="color: #cccccc; font-size: 1.1em"><?php echo $donnees_list['genresSerie']; ?></i><br />
										<?php echo $nb_saisons['nbSaisons']; ?> saisons disponibles
									</p>
								</div>
							</div>
						</div>
						<?php
								$compteur++;
							}
						?>
						</div>
					</div>
				</div>
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