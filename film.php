<?php
	session_start();
	
	if (isset($_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']))
	{
		include('model/fonc_connect.php');
		$id_film = $_GET['id'];
		$req_film = $bdd->prepare('SELECT * FROM films WHERE id = :id');
		$req_film->execute(array(':id' => $id_film)) or die(print_r($bdd->errorInfo()));
		$donnees_film = $req_film->fetch();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('view/includes/include.php'); ?>
		<meta charset="utf-8" />
		<title><?php echo $donnees_film['titreFilm']; ?> - Filmatiks</title>
	</head>
	
	<body onload="redim()" onresize="redim()">
		<div class="ink-grid">
			<?php include('view/includes/header.php'); ?>
			
			<div class="column-group gutters" style="margin-top : 20px; margin-bottom : 20px">
				<div class="xlarge-70 large-70 medium-100 small-100 tiny-100">
					<div class="panel">
						<div>
							<div style="display : inline-block;">
								<h2>
									<?php echo $donnees_film['titreFilm']; ?> - <?php echo $donnees_film['dateSortieFilm']; ?>
								</h2>
							</div>
							
							<div style="float :right; margin-right : 10px">
								<?php
									$req = $bdd->prepare('SELECT count(*) as test FROM favoris WHERE pseudoFavoris = "' . $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] . '" AND idFilmFavoris = "' . $donnees_film['id'] . '"');
									$req->execute();
									$req = $req->fetch();
									
									if ($req['test'] >= 1)
									{
										echo '<img src="view/data/icons/starFull.png" />';
									}
									else
									{
										echo '<a style="text-decoration : none" href="model/favoris.php?pseudo=' . $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] . '&idfilm=' . $donnees_film['id'] . '">';
										echo '<img id="fav" src="view/data/icons/starEmpty.png" onmouseover="favorisON();" onmouseout="favorisOFF();" alt="favoris" title="ajouter/retirer des favoris" />';
										echo '</a>';
									}
								?>
							</div>
						</div>
								
						<div class="column-group gutters">
							<div class="xlarge-30 large-30 medium-100 small-100 tiny-100">
								<img id="image" style="width: 100%" src="<?php echo $donnees_film['afficheFilm']; ?>" alt="<?php echo $donnees_film['titreFilm']; ?>" title="<?php echo $donnees_film['titreFilm']; ?>" />
							</div>
							
							<div class="xlarge-70 large-70 medium-100 small-100 tiny-100">
								<?php
									$tmp = explode('watch?v=', $donnees_film['bandeAnnonceFilm']);
									$bandeAnnonce = $tmp[1];
								?>
								<object id="youtube" type="text/html" data="http://www.youtube.com/embed/<?php echo $bandeAnnonce; ?>" style="width:100%;height:100px;"></object>
							</div>
						</div>
						
						<div class="column-group gutters">
							<div class="all-100">
								<p>
									<b>Réalisateur(s) :</b> <i><?php echo $donnees_film['realisateursFilm']; ?></i><br />
									<b>Acteurs principaux :</b> <i><?php echo $donnees_film['acteursFilm']; ?></i><br />
									<b>Genre(s) :</b> <i><?php echo $donnees_film['genresFilm']; ?></i><br />
									<b>Nationalité :</b> <i><?php echo $donnees_film['nationaliteFilm']; ?></i><br /><br />
									<i><b>Synopsis :</b></i><br />
									<?php echo $donnees_film['synopsisFilm']; ?>
								</p>
								
								<fieldset>
									<legend>Notes</legend>
									
									<div style="display : inline-block; margin-left : 30px">
									<center>
										<b>Les notes des utilisateurs</b><br /><br />
										<?php
											include('model/fonc_connect.php');

											$req = $bdd->prepare('SELECT count(*) as test FROM notes WHERE idFilmNote = "' . $donnees_film['id'] . '"');
											$req->execute();
											$req = $req->fetch();
											
											if ($req['test'] >= 1)
											{
												$req2 = $bdd->prepare('SELECT * FROM notes WHERE idFilmNote = "' . $donnees_film['id'] .'"');
												$req2->execute();
												
												while ($donnees = $req2->fetch())
												{
													$pseudo = $donnees['pseudoNote'];
													$note = $donnees['etoilesNote'];
													
													echo '<div style="margin : 10px">';
													
													if ($pseudo == $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'])
													{
														echo '<b>Ta note : </b>';
													}
													else
													{
														echo '<b>' . $pseudo . ' : </b>';
													}
													
													for ($i = 0; $i < $note; $i++)
													{
														echo '<img style="margin-left : 5px" src="view/data/icons/starFull.png" />';
													}
													
													while ($i < 5)
													{
														echo '<img style="margin-left : 5px" src="view/data/icons/starEmpty.png" />';
														$i++;
													}
													
													echo '</div>';
												}										
											}
											else
											{
												echo '<i>ce film n\'a pas encore de note</i><br />';
											}
										?>
									</center>
									</div>
									
									<?php
									$req = $bdd->prepare('SELECT count(*) as test FROM notes WHERE idFilmNote = "' . $donnees_film['id'] . '" AND pseudoNote = "' . $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] . '"');
									$req->execute();
									$req = $req->fetch();
									
									if ($req['test'] != 1)
									{
									?>
									<div style="float : right; margin-right : 30px">
									<center>
										<b>Ta note</b><br /><br />
										
										<b><?php echo $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] . ' : '; ?></b>
										
										<?php
											for ($i=1; $i <= 5; $i++)
											{
												echo '<a style="text-decoration : none" href="model/note.php?pseudo=' . $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'] . '&idfilm=' . $donnees_film['id'] . '&note=' . $i . '">';
												echo '<img id="st' . $i . '" style="margin-left : 5px" onmouseover="active(' . $i . ')" onmouseout="desactive()" src="view/data/icons/starEmpty.png" />';
												echo '</a>';
											}
										?>
									</center>
									</div>
									<?php
									}
									?>
								</fieldset>
								
							</div>
						</div>
					</div>
				</div>
				
				<div class="xlarge-30 large-30 medium-100 small-100 tiny-100">
					<div class="panel">
						<h2>Suggestions</h2>
						<ul class="unstyled">
							<?php
								$req_corres = $bdd->prepare('SELECT * FROM corresgenrefilm WHERE idFilm = :id');
								$req_corres->execute(array(':id' => $id_film)) or die(print_r($bdd->errorInfo()));
								$donnees_corres = $req_corres->fetch();
								
								$req_prepare = 'SELECT * FROM corresgenrefilm WHERE idGenre = ' . $donnees_corres['idGenre'];
								
								$req_genre = $bdd->prepare($req_prepare);
								$req_genre->execute() or die(print_r($bdd->errorInfo()));
								
								$cpt= 1;
								while ($donnees_genre = $req_genre->fetch())
								{
									$req_suggestions = $bdd->prepare('SELECT * FROM films WHERE id = "' . $donnees_genre['idFilm'] . '"');
									$req_suggestions->execute() or die(print_r($bdd->errorInfo()));
									$donnees_suggestions = $req_suggestions->fetch();
							?>
							<li class="column-group half-gutters">
								<div class="all-40 small-50 tiny-50">
									<a style="text-decoration : none; color : #404040" href="film.php?id=<?php echo $donnees_suggestions['id']; ?>">
										<img src="<?php echo $donnees_suggestions['afficheFilm']; ?>" alt="<?php echo $donnees_suggestions['titreFilm']; ?>">
									</a>
								</div>
								<div class="all-60 small-50 tiny-50" style="padding-top : 20px">
									<p>
										<a style="text-decoration : none; color : #404040" href="film.php?id=<?php echo $donnees_suggestions['id']; ?>">
											<?php echo $donnees_suggestions['titreFilm']; ?>
										</a>
									</p>
								</div>
							</li>
							<?php
									if ($cpt == 4)
									{
										break 1;
									}
									$cpt++;
								}
							?>
							<li class="column-group half-gutters">
								<div class="all-100">
									<a href="recherche.php?q=genre/<?php echo $donnees_corres['idGenre']; ?>" target="_blank">Voir la suite ...</a>
								</div>
							</li>
						</ul>
					</div>
                </div>
			</div>
		</div>
		
		<script>
			function redim()
			{
				var hauteurImage = document.getElementById('image').offsetHeight;
				document.getElementById('youtube').style.height = hauteurImage + 'px';
			}
			
			function favorisON()
			{
				document.getElementById('fav').src = "view/data/icons/starFull.png";
			}
			
			function favorisOFF()
			{
				document.getElementById('fav').src = "view/data/icons/starEmpty.png";
			}
			
			function active(star)
			{
				if (star == 1)
				{
					document.getElementById('st1').src = "view/data/icons/starFull.png";
				}
				else if (star == 2)
				{
					document.getElementById('st1').src = "view/data/icons/starFull.png";
					document.getElementById('st2').src = "view/data/icons/starFull.png";
				}
				else if (star == 3)
				{
					document.getElementById('st1').src = "view/data/icons/starFull.png";
					document.getElementById('st2').src = "view/data/icons/starFull.png";
					document.getElementById('st3').src = "view/data/icons/starFull.png";
				}
				else if (star == 4)
				{
					document.getElementById('st1').src = "view/data/icons/starFull.png";
					document.getElementById('st2').src = "view/data/icons/starFull.png";
					document.getElementById('st3').src = "view/data/icons/starFull.png";
					document.getElementById('st4').src = "view/data/icons/starFull.png";
				}
				else if (star == 5)
				{
					document.getElementById('st1').src = "view/data/icons/starFull.png";
					document.getElementById('st2').src = "view/data/icons/starFull.png";
					document.getElementById('st3').src = "view/data/icons/starFull.png";
					document.getElementById('st4').src = "view/data/icons/starFull.png";
					document.getElementById('st5').src = "view/data/icons/starFull.png";
				}
			}
			
			function desactive()
			{
				document.getElementById('st1').src = "view/data/icons/starEmpty.png";
				document.getElementById('st2').src = "view/data/icons/starEmpty.png";
				document.getElementById('st3').src = "view/data/icons/starEmpty.png";
				document.getElementById('st4').src = "view/data/icons/starEmpty.png";
				document.getElementById('st5').src = "view/data/icons/starEmpty.png";
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