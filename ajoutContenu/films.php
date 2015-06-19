<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Ajouter un film</title>
		
		<?php include('./view/includes/include.php'); ?>
		
		<style>
			.entInfo
			{
				color: black;
			}
			
			.entInfo:hover
			{
				text-decoration: none;
			}
		</style>
	</head>
	
	<body style="background-color: #e9e9e9">
		<?php include('./view/includes/header.php'); ?>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel">
					<table class="table table-striped">
						<tr>
							<th>titreFilm</th>
							<th>dateSortieFilm</th>
							<th>realisateursFilm</th>
							<th>acteursFilm</th>
							<th>genresFilm</th>
							<th>nationaliteFilm</th>
							<th>synopsisFilm</th>
							<th>bandeAnnonceFilm</th>
							<th>extensionFilm</th>
							<th>afficheFilm</th>
							<th>dateAjoutFilm</th>
						</tr>
						
						<form method="POST" action="./model/ajout_film.php">
						<tr>
							<td><input style="width:100%" type="text" name="titreFilm" /></td>
							<td><input style="width:100%" type="text" name="dateSortieFilm" /></td>
							<td><input style="width:100%" type="text" name="realisateursFilm" /></td>
							<td><input style="width:100%" type="text" name="acteursFilm" /></td>
							<td><input style="width:100%" type="text" name="genresFilm" /></td>
							<td><input style="width:100%" type="text" name="nationaliteFilm" /></td>
							<td><input style="width:100%" type="text" name="synopsisFilm" /></td>
							<td><input style="width:100%" type="text" name="bandeAnnonceFilm" /></td>
							<td><input style="width:100%" type="text" name="extensionFilm" /></td>
							<td><input style="width:100%" type="text" name="afficheFilm" /></td>
							<td><input style="width:100%" type="text" name="dateAjoutFilm" value="<?php echo date('m\/d\/Y'); ?>" /></td>
							<td><button class="btn btn-default">Valider</button></td>
						</tr>
						</form>
						
						<?php
							$edit = $_GET['edit'];

							$req = $bdd->prepare('SELECT * FROM films ORDER BY id DESC');
							$req->execute() or die(print_r($bdd->errorInfo()));

							while ($donnees = $req->fetch())
							{
								if ($edit == $donnees['id'])
								{
						?>
						<form method="POST" action="./model/modification_film.php">
							<input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />
						<tr>
							<td><input style="width:100%" type="text" name="titreFilm" value="<?php echo $donnees['titreFilm']; ?>" /></td>
							<td><input style="width:100%" type="text" name="dateSortieFilm" value="<?php echo $donnees['dateSortieFilm']; ?>" /></td>
							<td><input style="width:100%" type="text" name="realisateursFilm" value="<?php echo $donnees['realisateursFilm']; ?>" /></td>
							<td><input style="width:100%" type="text" name="acteursFilm" value="<?php echo $donnees['acteursFilm']; ?>" /></td>
							<td><input style="width:100%" type="text" name="genresFilm" value="<?php echo $donnees['genresFilm']; ?>" /></td>
							<td><input style="width:100%" type="text" name="nationaliteFilm" value="<?php echo $donnees['nationaliteFilm']; ?>" /></td>
							<td><input style="width:100%" type="text" name="synopsisFilm" value="<?php echo $donnees['synopsisFilm']; ?>" /></td>
							<td><input style="width:100%" type="text" name="bandeAnnonceFilm" value="<?php echo $donnees['bandeAnnonceFilm']; ?>" /></td>
							<td><input style="width:100%" type="text" name="extensionFilm" value="<?php echo $donnees['extensionFilm']; ?>" /></td>
							<td><input style="width:100%" type="text" name="afficheFilm" value="<?php echo $donnees['afficheFilm']; ?>" /></td>
							<td><?php echo $donnees['dateAjoutFilm']; ?></td>
							<td><button class="btn btn-default">Modifier</button></td>
						</tr>
						</form>
						<?php
								}
								else
								{
						?>
						<tr>
							<td><?php echo $donnees['titreFilm']; ?></td>
							<td><?php echo $donnees['dateSortieFilm']; ?></td>
							<td><?php echo $donnees['realisateursFilm']; ?></td>
							<td><?php echo $donnees['acteursFilm']; ?></td>
							<td><?php echo $donnees['genresFilm']; ?></td>
							<td><?php echo $donnees['nationaliteFilm']; ?></td>
							<td><?php echo $donnees['synopsisFilm']; ?></td>
							<td><?php echo $donnees['bandeAnnonceFilm']; ?></td>
							<td><?php echo $donnees['extensionFilm']; ?></td>
							<td><?php echo $donnees['afficheFilm']; ?></td>
							<td><?php echo $donnees['dateAjoutFilm']; ?></td>
							<td><a href="./films.php?edit=<?php echo $donnees['id']; ?>"><img src="./view/data/img/edit.png" /></a><a href="./model/suppression_film.php?ligne=<?php echo $donnees['id']; ?>"><img style="float:right" src="./view/data/img/delete.png" /></a></td>
						</tr>
						<?php
								}
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>