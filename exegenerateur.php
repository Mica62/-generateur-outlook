<?php
	if (isset($_GET['s']))
	{	
		//Récupére le le nom d'utilisateur qui est loggé sur l'ordinateur -> On le récupère par le courriel	
	    $name = substr($_POST['courriel'], -9);
		
		$username = str_replace($name, "", $_POST['courriel']);

	   	//on crée alors la signature dans le dossier

		if (isset($_POST['fullname']) && isset($_POST['poste']) && isset($_POST['bureau']) && isset($_POST['courriel']))
		{
			//on récupère les informations
			$fullname = $_POST['fullname'];
			$poste = $_POST['poste'];
			$bureau = $_POST['bureau'];
			$courriel = $_POST['courriel'];
			
			//nom du fichier
			$file = str_replace("'", "", utf8_decode($_POST['nom'])."-2016.htm");
			$filen = str_replace(",", "", $file);
			$filename =  str_replace(" ", "", $filen);
			$filezip = str_replace("'", "", utf8_decode($_POST['nom']).".zip");
			$filezip2 = str_replace(",", "", $filezip);
			$filenamezip = str_replace(" ", "", $filezip2);
				
			//Path pour la copie de fichier
			$path = "C:/Users/".$username."/AppData/Roaming/Microsoft/Signatures/";
			
			//Le contenu du fichier htm
			$filecontent = 
				'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<table>
				<tr>
					<td><img src="http://appx.cegep-chicoutimi.qc.ca/images/logo_signature.png" width="180" height="61" /></td>
					<td style="padding:10px;">
					<p> <span style="color:green;font-size:22px;">'.$fullname.'</span><br>
						<b>'.$poste.'</b><br>
						Bureau : (418)-549-9520 <b>'.$bureau.'</b><br>
						Télécopieur : (418)-549-5399<br>
						Cégep de Chicoutimi<br>
						534, rue Jacques-Cartier Est,<br>
						Chicoutimi, Québec, Canada<br>
						G7H 1Z6<br>
						Courriel: <a href=mailto:"'.$courriel.'">'.$courriel.'</a><br>
						<span style="color:#2E9AFE;"><b>Site Web</b></span> : www.cchic.ca</p>
					</td>
				</tr>
				</table>
				';
				
			echo ("</div>");
			
			//Création du fichier .bat
			$filebt = str_replace("'", "", utf8_decode($_POST['nom']).'-2016.bat');
			$filebt2 = str_replace(",", "", $filebt);
			$batfile = str_replace(" ", "", $filebt2);
			$monfichierbat = fopen('depot/'.$batfile, 'w+');
			$stringfile = "move /-y ".$filename." ".$path . "
						  pause";
			fwrite($monfichierbat, $stringfile);
			fclose($monfichierbat);
			
			//Création du fichier .htm
			$monfichierhtm = fopen('depot/'.$filename, 'w+');
			fwrite($monfichierhtm, $filecontent);
			fclose($monfichierhtm);
			
			$files_to_zip = array(
			'depot/'.$filename.'',
			'depot/'.$batfile.''
			);

			//si true, good; si false, la création du zip a échoué
			$result = create_zip($files_to_zip,$filenamezip);

			//on télécharge le zip
			if ($result == true)
			{				
				header('Content-Type: application/zip');
				header('Content-disposition: attachment; filename='.basename($filenamezip));
				header('Content-Length: ' . filesize($filenamezip));
				ob_clean();
				flush();
				readfile($filenamezip);
				
				//on efface ensuite les fichiers du serveur
				unlink('depot/'.$filename);
				unlink('depot/'.$batfile);
				unlink($filenamezip);
				
			}
			else
			{
				echo ("<div align='center'>Une erreur s'est produit</div>");
			}
			
			
			exit;
	   	}

	}
	
	function create_zip($files = array(),$destination = '',$overwrite = true) {
	//variable
	$valid_files = array();
	//s'il y a des fichiers...
	if(is_array($files)) {
		foreach($files as $file) {
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//si les fichiers sont valides
	if(count($valid_files)) {
		//on crée l'archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//on ajoute les fichiers au zip
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
	
		
		//on ferme le zip -- fini!
		$zip->close();
		
		//check pour être sûr que le fichier existe
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}


?>	
