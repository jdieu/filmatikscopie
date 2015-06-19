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
		<title><?php echo $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']; ?> - Filmatiks</title>
	</head>
	
	<body>
		<div class="ink-grid">
			<?php include('view/includes/header.php'); ?>
			
			<div class="column-group gutters" style="margin-top : 20px">
				<div class="xlarge-30 large-30 medium-40 small-100 tiny-100">
					<div class="panel">
						<center><h3>Liste des membres</<h3></center>
						<?php
							$pseudo = $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'];
							
							$req_list = $bdd->prepare('SELECT * FROM profils');
							$req_list->execute();
							
							while ($donnees = $req_list->fetch())
							{
						?>
						<div class="column-group gutters" style="margin-top : 20px">
							<div class="xlarge-15 large-15 medium-20 small-100 tiny-100" style="margin-bottom : 0px; margin-top : 0px; padding-bottom : 0px; padding-top : 0px">
								<img src="view/data/avatars/mini/<?php echo $donnees['avatar']; ?>.png" />
							</div>
							
							<div class="xlarge-70 large-70 medium-60 small-100 tiny-100" style="margin-bottom : 0px; margin-top : 0px; padding-bottom : 0px; padding-top : 0px">
								<?php echo $donnees['pseudo']; ?>
							</div>
							
							<div class="xlarge-15 large-15 medium-20 small-100 tiny-100" style="margin-bottom : 0px; margin-top : 0px; padding-bottom : 0px; padding-top : 0px">
								<img src="view/data/icons/open.png" />
							</div>
						</div>
						<?php
							}
						?>
					</div>
					
					<div class="panel" style="margin-top : 35px">
						<center><h3>Supprimer mon cache</h3></center>
						<p>
							Lorsque tu télécharges une saison d'une série, le serveur te prépare un fichier zip du contenu demandé, pour ensuite t'en proposer le téléchargement. Une fois celui-ci effectué, le zip reste sur le serveur. Pour éviter de la surcharger, penses à supprimer les éventuels fichiers. L'admin t'en remercie d'avance, peace !
						</p>
						<a href="model/sup_cache.php">
							<button class="ink-button" style="width : 100%">
								supprimer
							</button>
						</a>
					</div>
                </div>
				
                <div class="xlarge-70 large-70 medium-60 small-100 tiny-100">
					<div class="panel">
						<center><h3>Profil</h3></center>
						<?php
							$req_prof = $bdd->prepare('SELECT * FROM profils WHERE pseudo = "' . $pseudo . '"');
							$req_prof->execute();
							$donnees_profil = $req_prof->fetch();
							
							$req_hist = $bdd->prepare('SELECT * FROM historique WHERE pseudo = "' . $pseudo . '"');
							$req_hist->execute();
							$donnees_historique = $req_hist->fetch();
							
							
							$req_note = $bdd->prepare('SELECT * FROM notes WHERE pseudoNote = "' . $pseudo . '"');
							$req_note->execute();
							$nombre_films_note = count($req_note);
							
							$req_films = $bdd->prepare('SELECT count(*) as nb FROM films');
							$req_films->execute();
							$donnees_films = $req_films->fetch();
						?>
						<div class="column-group gutters" style="margin-top : 20px">
							<div class="xlarge-20 large-20 medium-25 small-100 tiny-100">
								<a <?php if ($pseudo == $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']){ echo 'href="modifications.php"';}?>>
									<img src="view/data/avatars/maxi/<?php echo $donnees_profil['avatar']; ?>.png" />
								</a>
							</div>
							
							<div class="xlarge-80 large-80 medium-75 small-100 tiny-100">
								<?php echo $pseudo; ?><br />
								grade : <?php echo $donnees_profil['grade']; ?><br />
								Dernière connexion : <?php echo $donnees_profil['connexion']; ?><br />
								Nombre total de messages postés: <?php echo $donnees_profil['messages']; ?><br />
								Nombre de films notés : <?php echo $nombre_films_note; ?> (sur <?php echo $donnees_films['nb']; ?>)
							</div>
						</div>
					</div>
					
					<div class="panel" style="margin-top : 40px">
						<center><h3>notes</h3></center>
						<center><table>
						<?php
							$req = $bdd->prepare('SELECT count(*) as test FROM notes WHERE pseudoNote = "' . $pseudo . '"');
							$req->execute();
							$req = $req->fetch();
							
							if ($req['test'] >= 1)
							{
								$req_note = $bdd->prepare('SELECT * FROM notes WHERE pseudoNote = "' . $pseudo . '"');
								$req_note->execute();
								
								while ($donnees_note = $req_note->fetch())
								{
									$req_film_note = $bdd->prepare('SELECT * FROM films WHERE id = "' . $donnees_note['idFilmNote'] . '"');
									$req_film_note->execute();
									$donnees_film_note = $req_film_note->fetch();
						?>
							<tr>
								<td style="padding : 5px"><?php echo $donnees_film_note['titreFilm']; ?></td>
								<td style="padding : 5px"><?php echo '<b>' . $donnees_note['etoilesNote'] . '</b> /5'; ?></td>
							</tr>
						<?php
								}
							}
							else
							{
								echo '<center>';
								echo 'Tu n\'as noté aucun film';
								echo '</center>';
							}
						?>
						</table></center>
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