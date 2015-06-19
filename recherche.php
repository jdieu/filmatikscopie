<?php
	session_start();
	
	if (isset($_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']))
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('view/includes/include.php'); ?>
		<title>Recherche - Filmatiks</title>
	</head>
	
	<body onload="redim()">
		<div class="ink-grid">
			<?php include('view/includes/header.php'); ?>
			
			<div class="column-group gutters" style="margin-top : 20px; margin-bottom : 20px">
				<div class="xlarge-80 large-80 medium-70 small-70 tiny-50">
					<div class="panel" style="padding-top: 30px">
						<?php
							if (isset($_GET['q']))
							{
								$query = $_GET['q'];
								$tmp = explode('/', $query);
								$query_type = $tmp[0];
								$query = $tmp[1];
								
								if ($query_type == 'genre')
								{
									$req_list = $bdd->prepare('SELECT * FROM films JOIN corresgenrefilm ON films.id = corresgenrefilm.idFilm WHERE corresgenrefilm.idGenre = :id');
									$req_list->execute(array(':id' => $query)) or die(print_r($bdd->errorInfo()));
								}
								else if ($query_type == 'annee')
								{
									$req_list = $bdd->prepare('SELECT * FROM films WHERE dateSortieFilm = :date');
									$req_list->execute(array(':date' => $query)) or die(print_r($bdd->errorInfo()));
								}
								else if ($query_type == 'realisateur')
								{
									$req_list = $bdd->prepare('SELECT * FROM films WHERE realisateursFilm = :realisateur');
									$req_list->execute(array(':realisateur' => $query)) or die(print_r($bdd->errorInfo()));
								}

								echo '<div class="column-group gutters">';
								
								$compteur = 0;
								while ($donnees_list = $req_list->fetch())
								{
									if ($compteur == 2)
									{
										echo '</div><div class="column-group gutters">';
										$compteur = 0;
									}
						?>
						<div class="xlarge-50 large-50 medium-50 small-50 tiny-100">
							<div class="column-group gutters">
								<div class="xlarge-30 large-30 medium-100 small-100 tiny-100">
									<a href="film.php?id=<?php echo $donnees_list['id']; ?>">
										<img src="<?php echo $donnees_list['afficheFilm']; ?>" alt="<?php echo $donnees_list['titreFilm']; ?>" title="<?php echo $donnees_list['titreFilm']; ?>" />
									</a>
								</div>
								<div class="xlarge-70 large-70 medium-100 small-100 tiny-100">
									<p>
										<a style="font-size: 1.3em; font-weight: bold; color: #404040; text-decoration: none" href="film.php?id=<?php echo $donnees_list['id']; ?>">
											<?php echo $donnees_list['titreFilm']; ?>
										</a><br />
										de <i><?php echo $donnees_list['realisateursFilm']; ?></i><br />
										avec <?php $tmp = explode(', ', $donnees_list['acteursFilm']); echo $tmp[0] . ', ' . $tmp[1] . ', ...'; ?><br />
										<i style="color: #cccccc; font-size: 1.1em"><?php echo $donnees_list['genresFilm']; ?></i>
									</p>
								</div>
							</div>
						</div>
						<?php
									$compteur++;
								}
						?>
						</div>
						<?php
							}
							else if (isset($_POST['search']))
							{
								$search = $_POST['search'];
								
								echo $search;
								
								$req_search = $bdd->prepare('SELECT * FROM films WHERE titreFilm LIKE "%' . $search . '%" ORDER BY titreFilm');
								$req_search->execute() or die(print_r($bdd->errorInfo()));
								
								var_dump($req_search->fetch());

								// if (count($req_search->fetchAll()) != 0)
								// {
								
									echo '<div class="column-group gutters">';
									
									$compteur = 0;
									while ($donnees_search = $req_search->fetch())
									{
										if ($compteur == 2)
										{
											echo '</div><div class="column-group gutters">';
											$compteur = 0;
										}
						?>
						<div class="xlarge-50 large-50 medium-50 small-50 tiny-100">
							<div class="column-group gutters">
								<div class="xlarge-30 large-30 medium-100 small-100 tiny-100">
									<a href="film.php?id=<?php echo $donnees_search['id']; ?>">
										<img src="<?php echo $donnees_search['afficheFilm']; ?>" alt="<?php echo $donnees_search['titreFilm']; ?>" title="<?php echo $donnees_search['titreFilm']; ?>" />
									</a>
								</div>
								<div class="xlarge-70 large-70 medium-100 small-100 tiny-100">
									<p>
										<a style="font-size: 1.3em; font-weight: bold; color: #404040; text-decoration: none" href="film.php?id=<?php echo $donnees_search['id']; ?>">
											<?php echo $donnees_search['titreFilm']; ?>
										</a><br />
										de <i><?php echo $donnees_search['realisateursFilm']; ?></i><br />
										avec <?php $tmp = explode(', ', $donnees_search['acteursFilm']); echo $tmp[0] . ', ' . $tmp[1] . ', ...'; ?><br />
										<i style="color: #cccccc; font-size: 1.1em"><?php echo $donnees_search['genresFilm']; ?></i>
									</p>
								</div>
							</div>
						</div>
						<?php
										$compteur++;
									}
						?>
						</div>
						<?php
								// }
								// else
								// {
									// echo '<h3 style="text-align: center">Aucun film ne correspond à votre recherche</h3>';
								// }
							}
						?>
					</div>
				</div>
				
				<div class="xlarge-20 large-20 medium-30 small-100 tiny-100">
					<div class="panel">
						<h2 style="text-align: center">Genres</h2>
						<?php
							if (isset($_GET['q']))
							{
								$req_genre = $bdd->prepare('SELECT * FROM genres');
								$req_genre->execute() or die(print_r($bdd->errorInfo()));
								
								while ($donnees_genre = $req_genre->fetch())
								{
									$req_exist = $bdd->prepare('SELECT idFilm FROM corresgenrefilm WHERE idGenre = :id');
									$req_exist->execute(array(':id' => $donnees_genre['id'])) or die(print_r($bdd->errorInfo()));
									$donnees_exist = $req_exist->fetch();
									
									$req_nb_genres = $bdd->prepare('SELECT COUNT(*) as nombre_genres FROM corresgenrefilm WHERE idGenre = :id');
									$req_nb_genres->execute(array(':id' => $donnees_genre['id'])) or die(print_r($bdd->errorInfo()));
									$donnees_nb_genres = $req_nb_genres->fetch();
									
									if ($donnees_exist != false)
									{
										if ($donnees_genre['id'] == $query)
										{
											echo '<b style="font-size: 1.5em"><a href="recherche.php?q=genre/' . $donnees_genre['id'] . '">' . $donnees_genre['titreGenre'] . ' (' . $donnees_nb_genres['nombre_genres'] . ')</a></b><br />';
										}
										else
										{
											echo '<a href="recherche.php?q=genre/' . $donnees_genre['id'] . '">' . $donnees_genre['titreGenre'] . ' (' . $donnees_nb_genres['nombre_genres'] . ')</a><br />';

										}
									}
								}
								
								echo '<br />';
							}
						?>
					</div>
					
					<div class="panel" style="margin-top: 30px">
						<h2 style="text-align: center">Années</h2>
						<?php
							if (isset($_GET['q']))
							{
								$req_annees = $bdd->prepare('SELECT dateSortieFilm FROM films GROUP BY dateSortieFilm ORDER BY dateSortieFilm desc');
								$req_annees->execute() or die(print_r($bdd->errorInfo()));
								
								while ($donnees_annees = $req_annees->fetch())
								{
									$req_nb_annees = $bdd->prepare('SELECT COUNT(*) as nombre_annees FROM films WHERE dateSortieFilm = :date');
									$req_nb_annees->execute(array(':date' => $donnees_annees['dateSortieFilm'])) or die(print_r($bdd->errorInfo()));
									$donnees_nb_annees = $req_nb_annees->fetch();
									
									if ($donnees_annees['dateSortieFilm'] == $query)
									{
										echo '<b style="font-size: 1.5em"><a href="recherche.php?q=annee/' . $donnees_annees['dateSortieFilm'] . '">' . $donnees_annees['dateSortieFilm'] . ' (' . $donnees_nb_annees['nombre_annees'] . ')</a></b><br />';
									}
									else
									{
										echo '<a href="recherche.php?q=annee/' . $donnees_annees['dateSortieFilm'] . '">' . $donnees_annees['dateSortieFilm'] . ' (' . $donnees_nb_annees['nombre_annees'] . ')</a><br />';

									}
								}
								
								echo '<br />';
							}
						?>
					</div>
					
					<div class="panel" style="margin-top: 30px">
						<h2 style="text-align: center">Réalisateurs</h2>
						<?php
							if (isset($_GET['q']))
							{
								$req_realisateurs = $bdd->prepare('SELECT realisateursFilm FROM films GROUP BY realisateursFilm ORDER BY realisateursFilm desc');
								$req_realisateurs->execute() or die(print_r($bdd->errorInfo()));
								
								while ($donnees_realisateurs = $req_realisateurs->fetch())
								{
									$req_nb_realisateurs = $bdd->prepare('SELECT COUNT(*) as nombre_realisateurs FROM films WHERE realisateursFilm = :realisateur');
									$req_nb_realisateurs->execute(array(':realisateur' => $donnees_realisateurs['realisateursFilm'])) or die(print_r($bdd->errorInfo()));
									$donnees_nb_realisateurs = $req_nb_realisateurs->fetch();
									
									if ($donnees_realisateurs['realisateursFilm'] == $query)
									{
										if ($donnees_nb_realisateurs['nombre_realisateurs'] == 1)
										{
											echo '<b style="font-size: 1.5em"><a href="recherche.php?q=realisateur/' . $donnees_realisateurs['realisateursFilm'] . '">' . $donnees_realisateurs['realisateursFilm'] . '</a></b><br />';
										}
										else
										{
											echo '<b style="font-size: 1.5em"><a href="recherche.php?q=realisateur/' . $donnees_realisateurs['realisateursFilm'] . '">' . $donnees_realisateurs['realisateursFilm'] . ' (' . $donnees_nb_realisateurs['nombre_realisateurs'] . ')</a></b><br />';
										}
									}
									else
									{
										if ($donnees_nb_realisateurs['nombre_realisateurs'] == 1)
										{
											echo '<a href="recherche.php?q=realisateur/' . $donnees_realisateurs['realisateursFilm'] . '">' . $donnees_realisateurs['realisateursFilm'] . '</a><br />';
										}
										else
										{
											echo '<a href="recherche.php?q=realisateur/' . $donnees_realisateurs['realisateursFilm'] . '">' . $donnees_realisateurs['realisateursFilm'] . ' (' . $donnees_nb_realisateurs['nombre_realisateurs'] . ')</a><br />';
										}
									}
								}
								
								echo '<br />';
							}
						?>
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