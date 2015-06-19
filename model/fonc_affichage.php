<?php
	function list_contenu($chemin_racine)
	{
		$dossier1 = opendir($chemin_racine);
		
		echo '<ul>';
		
		while (($fichier1 = readdir($dossier1)) != false)
		{
			if ($fichier1 != '.' && $fichier1 != '..')
			{
				echo '<li>';
				
				$extension1 = pathinfo($fichier1, PATHINFO_EXTENSION);
				
				echo $fichier1 . '<br />';
				
				if ($extension1 == NULL)
				{
					$dossier2 = opendir($chemin_racine . '/' . $fichier1);
					
					echo '<ul>';
					
					while (($fichier2 = readdir($dossier2)) != false)
					{
						if ($fichier2 != '.' && $fichier2 != '..')
						{
							echo '<li>';
							
							$extension2 = pathinfo($fichier2, PATHINFO_EXTENSION);
							
							echo $fichier2 . '<br />';
							
							if ($extension2 == NULL)
							{
								$dossier3 = opendir($chemin_racine . '/' . $fichier1 . '/' . $fichier2);
								
								echo '<ul>';
								
								while (($fichier3 = readdir($dossier3)) != false)
								{
									if ($fichier3 != '.' && $fichier3 != '..')
									{
										echo '<li>';
										
										echo $fichier3 . '<br />';
									}
									
									echo '</li>';
								}
								
								echo '</ul>';
							}
							
							echo '</li>';
						}
						
						echo '</li>';
					}
					
					echo '</ul>';
				}
				
				echo '</li>';
			}
		}
		
		echo '</ul>';
	}
?>