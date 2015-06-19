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
		<title>Forum - Filmatiks</title>
	</head>
	
	<body>
		<div class="ink-grid">
			<?php include('view/includes/header.php'); ?>
			<?php $pseudo = $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']; ?>
			
			<div class="column-group" style="margin-top : 20px; margin-bottom : 20px">
				<div class="xlarge-100 large-100 all-100">
					<div class="column-group gutters">
						<div class="all-25 small-100 tiny-100"></div>
						
						<div class="all-50 small-100 tiny-100">
							<form class="ink-form" enctype="multipart/form-data" action="forum.php?er=0" method="post">
								<div class="control-group panel" style="background-color : #ededed">
									<label for="pseudo">Pseudo</label>
									<div class="control">
										<input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" required/>
									</div>
									
									<div style="text-align : right">
										<?php
											$pseudo = $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f'];
											
											$req_pseudo = req_pseudo($pseudo);
											$nb_message_pseudo = $req_pseudo->fetch();
											
											if ($nb_message_pseudo['nb_message'] == '0')
											{
												echo '<small><i>Tu n\'as posté encore aucun message</i></small>';
											}
											else if ($nb_message_pseudo['nb_message'] == '1')
											{
												echo '<small><i>Tu as posté <b>' . $nb_message_pseudo['nb_message'] . '</b> message</i></small>';
											}
											else
											{
												echo '<small><i>Tu as posté <b>' . $nb_message_pseudo['nb_message'] . '</b> messages</i></small>';
											}
										?>
									</div>
									
									<label for="message">Message</label>
									<div class="control">
										<textarea name="message" id="message" required></textarea>
									</div>
									
									<button type="submit" class="ink-button" style="width : 100%; margin-left : 0px; margin-top : 25px">
										Publier
									</button>
									
									<?php
										$erreur = $_GET['er'];
										
										if ($erreur == '1')
										{
									?>
									<div style="margin-top : 20px">
										<center class="ink-label red">Echec lors de la publication</center>
									</div>
									<?php
										}
									?>
								</div>
							</form>
						</div>
						
						<div class="all-25 small-100 tiny-100">
							
						</div>
					</div>
					
					<div class="panel" style="background-color : #dedede">
						
						<?php							
							/* enregistrement du message dans la bdd */
							
							if (isset($_POST['pseudo']) AND isset($_POST['message']))
							{
								// $pseudo = htmlspecialchars($_POST['pseudo']);
								$message = nl2br(mysql_real_escape_string(htmlspecialchars($_POST['message'])));
								$message = nl2br($message);
								$date = date('d\/m\/Y \- H:i:s');
								
								$req_insert_message = req_insert_message($date, $pseudo, $message);
								
								if ($req_insert_message != true)
								{
									// header('Location:forum.php?er=1');
								}
								else
								{
									// header('Location:forum.php?er=0');
								}
							}
							
							/*affichage*/
							$req_message = req_messages();
							
							if (!isset($req_message))
							{
								echo '<p><center><i>Aucun message</i></center></p>';
							}
							else
							{
								while ($donnees_message = $req_message->fetch())
								{
							?>
								<div class="panel" style="margin-top : 15px; margin-bottom : 15px">
									<?php 
									if ($pseudo == $donnees_message['pseudo'])
									{
									?>
									<div style="display : inline-block; float : right">
										<a href="model/delete_coms.php?idCommentaire=<?php echo $donnees_message['id']; ?>"><img src="view/data/icons/close.png" alt="suprimer" title="supprimer" /></a>
									</div>
									<?php
									}
									?>
									
									<div>
										<h6><?php echo $donnees_message['pseudo']; ?><small><i> , le <?php echo $donnees_message['date']; ?></i></small></h6>
										<?php echo $donnees_message['message']; ?>
									</div>
								</div>
							<?php
								}
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