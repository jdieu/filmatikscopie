<meta charset="utf-8" />
<link rel="shortcut icon" href="view/data/icons/share.ico">
<meta name="robots" content="noindex, nofollow">

<!-- load inks CSS -->
<?php
	if ($dossier_css = opendir('./view/ink/css'))
	{
		for ($nb_fichier_css = 0; false !== ($fichier_css = readdir($dossier_css)); $nb_fichier_css++)
		{
			if($fichier_css != '.' && $fichier_css != '..')
			{
				echo '<link rel="stylesheet" type="text/css" href="./view/ink/css/' . $fichier_css . '">';
			}
		}		
		closedir($dossier_css);
	}
	else echo 'Le dossier n\' a pas pu être ouvert';
?>

<!-- load inks javascript files -->
<?php
	if ($dossier_js = opendir('./view/ink/js'))
	{
		for ($nb_fichier_js = 0; false !== ($fichier_js = readdir($dossier_js)); $nb_fichier_js++)
		{
			if($fichier_js != '.' && $fichier_js != '..')
			{
				echo '<script type="text/javascript" src="./view/ink/js/' . $fichier_js . '"></script>';
			}
		}		
		closedir($dossier_js);
	}
	else echo 'Le dossier n\' a pas pu être ouvert';
?>