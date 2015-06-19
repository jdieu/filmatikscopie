<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Ajouter une série</title>
		
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
							<th>titreSerie</th>
							<th>dateSortieSerie</th>
							<th>realisateursSerie</th>
							<th>acteursSerie</th>
							<th>genresSerie</th>
							<th>nationaliteSerie</th>
							<th>synopsisSerie</th>
							<th>bandeAnnonceSerie</th>
							<th>extensionSerie</th>
							<th>afficheSerie</th>
							<th>dateAjoutSerie</th>
						</tr>
						
						<form method="POST" action="./model/ajout_serie.php">
						<tr>
							<td><input style="width:100%" type="text" name="titreSerie" /></td>
							<td><input style="width:100%" type="text" name="dateSortieSerie" /></td>
							<td><input style="width:100%" type="text" name="realisateursSerie" /></td>
							<td><input style="width:100%" type="text" name="acteursSerie" /></td>
							<td><input style="width:100%" type="text" name="genresSerie" /></td>
							<td><input style="width:100%" type="text" name="nationaliteSerie" /></td>
							<td><input style="width:100%" type="text" name="synopsisSerie" /></td>
							<td><input style="width:100%" type="text" name="bandeAnnonceSerie" /></td>
							<td><input style="width:100%" type="text" name="extensionSerie" /></td>
							<td><input style="width:100%" type="text" name="afficheSerie" /></td>
							<td><input style="width:100%" type="text" name="dateAjoutSerie" value="<?php echo date('m\/d\/Y'); ?>" /></td>
							<td><button class="btn btn-default">Valider</button></td>
						</tr>
						</form>
						
						<?php
							$edit = $_GET['edit'];

							$req = $bdd->prepare('SELECT * FROM series');
							$req->execute() or die(print_r($bdd->errorInfo()));

							while ($donnees = $req->fetch())
							{
								if ($edit == $donnees['id'])
								{
						?>
						<form method="POST" action="./model/modification_serie.php">
							<input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />
						<tr>
							<td><input style="width:100%" type="text" name="titreSerie" value="<?php echo $donnees['titreSerie']; ?>" /></td>
							<td><input style="width:100%" type="text" name="dateSortieSerie" value="<?php echo $donnees['dateSortieSerie']; ?>" /></td>
							<td><input style="width:100%" type="text" name="realisateursSerie" value="<?php echo $donnees['realisateursSerie']; ?>" /></td>
							<td><input style="width:100%" type="text" name="acteursSerie" value="<?php echo $donnees['acteursSerie']; ?>" /></td>
							<td><input style="width:100%" type="text" name="genresSerie" value="<?php echo $donnees['genresSerie']; ?>" /></td>
							<td><input style="width:100%" type="text" name="nationaliteSerie" value="<?php echo $donnees['nationaliteSerie']; ?>" /></td>
							<td><input style="width:100%" type="text" name="synopsisSerie" value="<?php echo $donnees['synopsisSerie']; ?>" /></td>
							<td><input style="width:100%" type="text" name="bandeAnnonceSerie" value="<?php echo $donnees['bandeAnnonceSerie']; ?>" /></td>
							<td><input style="width:100%" type="text" name="extensionSerie" value="<?php echo $donnees['extensionSerie']; ?>" /></td>
							<td><input style="width:100%" type="text" name="afficheSerie" value="<?php echo $donnees['afficheSerie']; ?>" /></td>
							<td><?php echo $donnees['dateAjoutSerie']; ?></td>
							<td><button class="btn btn-default">Modifier</button></td>
						</tr>
						</form>
						<?php
								}
								else
								{
						?>
						<tr>
							<td><?php echo $donnees['titreSerie']; ?></td>
							<td><?php echo $donnees['dateSortieSerie']; ?></td>
							<td><?php echo $donnees['realisateursSerie']; ?></td>
							<td><?php echo $donnees['acteursSerie']; ?></td>
							<td><?php echo $donnees['genresSerie']; ?></td>
							<td><?php echo $donnees['nationaliteSerie']; ?></td>
							<td><?php echo $donnees['synopsisSerie']; ?></td>
							<td><?php echo $donnees['bandeAnnonceSerie']; ?></td>
							<td><?php echo $donnees['extensionSerie']; ?></td>
							<td><?php echo $donnees['afficheSerie']; ?></td>
							<td><?php echo $donnees['dateAjoutSerie']; ?></td>
							<td><a href="./series.php?edit=<?php echo $donnees['id']; ?>"><img src="./view/data/img/edit.png" /></a><a href="./model/suppression_serie.php?ligne=<?php echo $donnees['id']; ?>"><img style="float:right" src="./view/data/img/delete.png" /></a></td>
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