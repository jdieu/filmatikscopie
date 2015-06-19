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
		<title id="titre-page">Films - Filmatiks</title>
		
		<?php include('view/includes/onglet.php'); ?>
	</head>
	
	<body onload="redim()">
		<div class="ink-grid">
			<?php include('view/includes/header.php'); ?>
			
			<div class="column-group gutters" style="margin-top : 20px; margin-bottom : 20px">
				<div class="xlarge-80 large-80 medium-70 small-100 tiny-100">
					<div class="panel" style="margin-bottom: 30px">	
						<div id="carNews" class="ink-carousel" data-space-after-last-slide="false">
							<h1>Nouveautés</h1>
							<ul class="stage column-group half-gutters">
								<?php
									$req_last_date = $bdd->prepare('SELECT * FROM films ORDER BY id DESC');
									$req_last_date->execute() or die(print_r($bdd->errorInfo()));
									$donnees_last_date = $req_last_date->fetch();
									
									$req_news = $bdd->prepare('SELECT * FROM films WHERE dateAjoutFilm = "' . $donnees_last_date['dateAjoutFilm'] . '" ORDER BY id DESC');
									$req_news->execute() or die(print_r($bdd->errorInfo()));
									// $count = $req_news->rowCount();
									
									for ($i= 0; $donnees_news = $req_news->fetch(); $i++)
									{
										if ($i >= 40)
										{
											break 1;
										}
								?>
								<li class="slide xlarge-25 large-25 medium-50 small-50 tiny-100">
									<a style="text-decoration : none" href="film.php?id=<?php echo $donnees_news['id']; ?>">
										<img style="width: 100%; padding-right: 45px; padding-left: 45px" class="half-bottom-space" src="<?php echo $donnees_news['afficheFilm']; ?>" alt="affiche du film <?php echo $donnees_news['titreFilm']; ?>" title="<?php echo $donnees_news['titreFilm']; ?>" />
									</a>
									<div class="description" style="text-align : center">
										<b><a style="text-decoration : none; color : #404040" href="#">
											<?php echo $donnees_news['titreFilm']; ?>
										</a></b>
									</div>
								</li>
								<?php
									}
								?>
							</ul>
						</div>
						<nav id="pNews" class="ink-navigation" style="margin-top : 20px">
							<ul class="pagination black">
							</ul>
						</nav>
						<script>
							Ink.requireModules(['Ink.UI.Carousel_1'], function(InkCarousel) {
								new InkCarousel('#carNews', {pagination: '#pNews'});
							});
						</script>
					</div>

					<div class="panel" style="padding-top: 30px">
						<?php
							$max_ligne = $_GET['page'] * 20;
							if ($_GET['page'] == 1)
							{
								$min_ligne = 1;
							}
							$min_ligne = $max_ligne - 19;
							
							$req_list = $bdd->prepare('SELECT * FROM films WHERE id BETWEEN :min_ligne AND :max_ligne ORDER BY titreFilm'); // PROBLEME REQUETE
							$req_list->execute(array(':min_ligne' => $min_ligne, ':max_ligne' => $max_ligne)) or die(print_r($bdd->errorInfo()));
							
							$req_nb_films = $bdd->prepare('SELECT COUNT(*) as nb_films FROM films');
							$req_nb_films->execute() or die(print_r($bdd->errorInfo()));
							$nb_films = $req_nb_films->fetch();
							
							$nb_films = $nb_films['nb_films'];
							
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
										<img src="<?php echo $donnees_list['afficheFilm']; ?>" alt="affiche du film <?php echo $donnees_list['titreFilm']; ?>" title="<?php echo $donnees_list['titreFilm']; ?>" />
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
						
						<nav class="ink-navigation">
							<ul class="pagination black">
								<li <?php if($_GET['page'] == 1){echo 'style="display: none"';} ?>><a href="films.php?page=1">Première</a></li>
								<li <?php if($_GET['page'] == 1){echo 'class="disabled"';} ?>><a href="films.php?page=<?php echo $_GET['page'] - 1; ?>">Précédent</a></li>
								<?php
									$nb_page = floor($nb_films / 20);
									
									if (($nb_films % 20) != 0)
									{
										$nb_page++;
									}
									
									$page_actuelle = $_GET['page'];
									if ($page_actuelle == 1)
									{
										$min_page = 1;
										$max_page = 10;
									}
									else
									{
										$min_page = $page_actuelle - 4;
										$max_page = $page_actuelle + 5;
									}
									
									for ($p = $min_page; $p <= $max_page; $p++)
									{
										if ($p > 0)
										{
											if ($p == $_GET['page'])
											{
												echo '<li class="active"><a href="films.php?page=' . $p . '">' . $p . '</a></li>';
											}
											else
											{
												echo '<li><a href="films.php?page=' . $p . '">' . $p . '</a></li>';
											}
										}
									}
								?>
								<li <?php if($_GET['page'] == $nb_page){echo 'class="disabled"';} ?>><a href="films.php?page=<?php echo $_GET['page'] + 1; ?>">Suivant</a></li>
								<li <?php if($_GET['page'] == $nb_page){echo 'style="display: none"';} ?>><a href="films.php?page=<?php echo $nb_page; ?>">Dernière</a></li>
							</ul>
						</nav>
					</div>
				</div>
				
				<div class="xlarge-20 large-20 medium-30 small-100 tiny-100">
					<div class="panel">
						<h1 style="text-align: center">Filtres</h1>
							
						<h2 id="titre_genres" style="cursor: pointer; margin-bottom: 0px; padding-bottom: 20px" onclick="change('img_genres')">Genres <img id="img_genres" style="margin-top: 5px" src="view/data/icons/down.png" /></h2>
						<div id="genres" style="margin-top: 0px; display: none">
						<?php
							$req_genre = $bdd->prepare('SELECT * FROM genres');
							$req_genre->execute() or die(print_r($bdd->errorInfo()));
							
							while ($donnees_genre = $req_genre->fetch())
							{
								$req_exist = $bdd->prepare('SELECT idFilm FROM corresgenrefilm WHERE idGenre = :id');
								$req_exist->execute(array(':id' => $donnees_genre['id'])) or die(print_r($bdd->errorInfo()));
								
								$req_nb_genres = $bdd->prepare('SELECT COUNT(*) as nombre_genres FROM corresgenrefilm WHERE idGenre = :id');
								$req_nb_genres->execute(array(':id' => $donnees_genre['id'])) or die(print_r($bdd->errorInfo()));
								$donnees_nb_genres = $req_nb_genres->fetch();
								
								$donnees_exist = $req_exist->fetch();
								
								if ($donnees_exist != false)
								{
									echo '<a href="recherche.php?q=genre/' . $donnees_genre['id'] . '">' . $donnees_genre['titreGenre'] . ' (' . $donnees_nb_genres['nombre_genres'] . ')</a><br />';
								}
							}
							
							echo '<br />';
						?>
						</div>
					
						<h2 id="titre_annees" style="cursor: pointer; margin-bottom: 0px; padding-bottom: 20px" onclick="change('img_annees')">Années <img id="img_annees" style="margin-top: 5px" src="view/data/icons/down.png" /></h2>
						<div id="annees" style="margin-top: 0px; display: none">
						<?php
							$req_annees = $bdd->prepare('SELECT dateSortieFilm FROM films GROUP BY dateSortieFilm ORDER BY dateSortieFilm desc');
							$req_annees->execute() or die(print_r($bdd->errorInfo()));
							
							while ($donnees_annees = $req_annees->fetch())
							{
								$req_nb_annees = $bdd->prepare('SELECT COUNT(*) as nombre_annees FROM films WHERE dateSortieFilm = :date');
								$req_nb_annees->execute(array(':date' => $donnees_annees['dateSortieFilm'])) or die(print_r($bdd->errorInfo()));
								$donnees_nb_annees = $req_nb_annees->fetch();
								
								echo '<a href="recherche.php?q=annee/' . $donnees_annees['dateSortieFilm'] . '">' . $donnees_annees['dateSortieFilm'] . ' (' . $donnees_nb_annees['nombre_annees'] . ')</a><br />';
							}
							
							echo '<br />';
						?>
						</div>
					
						<h2 id="titre_realisateurs" style="cursor: pointer; margin-bottom: 0px; padding-bottom: 20px" onclick="change('img_realisateurs')">Réalisateurs <img id="img_realisateurs" style="margin-top: 5px" src="view/data/icons/down.png" /></h2>
						<div id="realisateurs" style="margin-top: 0px; display: none">
						<?php
							$req_realisateurs = $bdd->prepare('SELECT realisateursFilm FROM films GROUP BY realisateursFilm ORDER BY realisateursFilm asc');
							$req_realisateurs->execute() or die(print_r($bdd->errorInfo()));
							
							while ($donnees_realisateurs = $req_realisateurs->fetch())
							{
								$req_nb_realisateurs = $bdd->prepare('SELECT COUNT(*) as nombre_realisateurs FROM films WHERE realisateursFilm = :realisateur');
								$req_nb_realisateurs->execute(array(':realisateur' => $donnees_realisateurs['realisateursFilm'])) or die(print_r($bdd->errorInfo()));
								$donnees_nb_realisateurs = $req_nb_realisateurs->fetch();
								
								if ($donnees_nb_realisateurs['nombre_realisateurs'] == 1)
								{
									echo '<a href="recherche.php?q=realisateur/' . $donnees_realisateurs['realisateursFilm'] . '">' . $donnees_realisateurs['realisateursFilm'] . '</a><br />';
								}
								else
								{
									echo '<a href="recherche.php?q=realisateur/' . $donnees_realisateurs['realisateursFilm'] . '">' . $donnees_realisateurs['realisateursFilm'] . ' (' . $donnees_nb_realisateurs['nombre_realisateurs'] . ')</a><br />';
								}
							}
							
							echo '<br />';
						?>
					</div>
				</div>
			</div>
		</div>
		
		<?php include('view/includes/footer.php'); ?>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script> 
			$(document).ready(function(){
				$("#titre_genres").click(function(){
					$("#genres").slideToggle("slow");
				});
			});
			
			$(document).ready(function(){
				$("#titre_annees").click(function(){
					$("#annees").slideToggle("slow");
				});
			});
			
			$(document).ready(function(){
				$("#titre_realisateurs").click(function(){
					$("#realisateurs").slideToggle("slow");
				});
			});
		</script>
		
		<script>
			function change(id)
			{
				var img = document.getElementById(id).src;
				var tab = img.split("/");
				img = tab.pop();
				
				if (img == "down.png")
				{
					document.getElementById(id).src = "view/data/icons/up.png";
				}
				else if (img == "up.png")
				{
					document.getElementById(id).src = "view/data/icons/down.png";
				}
			}
			
			// function affich(id)
			// {
				// document.getElementById(id).style.display = "block";
				// document.getElementById('titre_'+id).style.paddingBottom = "10px";
				// document.getElementById('img_'+id).src = "view/data/icons/up.png";
			// }
			
			// function cache(id)
			// {
				// document.getElementById(id).style.display = "none";
				// document.getElementById('titre_'+id).style.paddingBottom = "20px";
				// document.getElementById('img_'+id).src = "view/data/icons/down.png";
			// }
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