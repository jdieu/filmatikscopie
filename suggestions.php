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
		<title>Suggestions de films - Filmatiks</title>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	</head>
	
	<body onload="redim()" onresize="redim()">
		<div class="ink-grid">
			<?php include('view/includes/header.php'); ?>
			<?php include('model/fonc_connect.php'); ?>
			
			<div class="column-group gutters" style="margin-top : 20px; margin-bottom : 20px">
				<div class="xlarge-25 large-25 medium-25"></div>
				<div class="xlarge-50 large-50 medium-50 small-100 tiny-100">
					<div class="panel">
						<div class="ink-shade fade">
							<div id="myModal" class="ink-modal fade" data-trigger="#myModalTrigger" data-width="50%" data-height="auto" role="dialog" aria-hidden="true" aria-labelled-by="modal-title">
								<div class="modal-header">
									<button class="modal-close ink-dismiss"></button>
									<h2 id="modal-title">Hey <?php echo $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']; ?> !</h2>
									<p>Ici, tu peux faire une liste des films que tu aimerais retrouver sur le site</p>
								</div>
								<div class="modal-body" id="modalContent">
									<form class="ink-form" method="POST" action="model/suggestions.php">
										<div class="control-group">
											<label for="film">Films (séparés d'une virgule)</label>
											<div class="control">
												<input id="film" name="film" type="text" placeholder="Titre du film" required />
											</div>
										</div>
										
										<div class="control-group">
											<label for="commentaire">Commentaire</label>
											<div class="control">
												<textarea id="commentaire" name="commentaire" placeholder="Le commentaire n'est pas obligatoire" ></textarea>
											</div>
										</div>
										
										<input type="hidden" name="pseudo" value="<?php echo $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']; ?>" />
										
										<button type="submit" class="ink-button" style="width: 100%; margin-left: 0px" >Ajouter</button>
									</form>
								</div>
								<div class="modal-footer">
									<div class="push-right">
										<!-- Anything with the ink-dismiss class will close the modal -->
										<button class="ink-button caution ink-dismiss">Fermer</button>
									</div>
								</div>
							</div>
						</div>
						<a href="#" id="myModalTrigger" class="ink-button push-right">Suggérer un film</a>
						
						<script src="view/ink/js/ink-all.min.js"></script>
						<script>
							// Not required if you are using autoload.js.
							Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
								var modalElement = Ink.s('#myModal');
								var modalObj = new Modal( modalElement );
							});
						</script>
						
						<?php
							$req_list_suggestions = $bdd->prepare('SELECT * FROM suggestions');
							$req_list_suggestions->execute();
							
							while ($donnees_suggestions = $req_list_suggestions->fetch())
							{
						?>
						<div style="margin-bottom: 10px">
							<div style="font-size: 1.3em">
								<a id="titre_<?php echo $donnees_suggestions['id']; ?>" href="#"><?php echo $donnees_suggestions['filmSuggestion']; ?></a> - proposé par <?php echo $donnees_suggestions['pseudoSuggestion']; ?>
							</div>
							
							<?php
								if ($donnees_suggestions['commentaireSuggestion'] != '')
								{
							?>
							<div style="margin-top: 7px; display: none" id="contenu_<?php echo $donnees_suggestions['id']; ?>">
								<p  style="display: inline-block; background-color: #ededed; border: 1px solid #cdcdcd; padding: 10px; font-size: 0.8em">
									<?php echo $donnees_suggestions['commentaireSuggestion']; ?>
								</p>
							</div>
							<?php
								}
							?>
						</div>
						
						<script>
							$('#titre_<?php echo $donnees_suggestions['id']; ?>').mouseover(function(){
								$('#contenu_<?php echo $donnees_suggestions['id']; ?>').slideDown();
							});
							
							$('#titre_<?php echo $donnees_suggestions['id']; ?>').mouseout(function(){
								$('#contenu_<?php echo $donnees_suggestions['id']; ?>').slideUp();
							});
						</script>
						<?php
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