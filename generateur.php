<?php
/*
-----------------------------------------------------------
 Fichier 		: generateur.php
 Description	: Générateur de signature outlook
 Créé le        : 7 avril 2016
-----------------------------------------------------------
*/?>

<html>
<head>
	<title>Générateur de signature outlook</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script language="JavaScript" type="text/javascript">
	<!--
		//Validation pour l'envoie de formulaire
		function valider(){
			form = document.getElementById("generateursignature");

			if(form.nom.value == "")
			{
				alert("Vous devez entrer un nom pour le fichier");
				form.nom.focus();
				return false;
			}
			if(form.fullname.value == "" ){
				alert("Vous devez entrer votre nom complet");
				form.fullname.focus();
				return false;
			}
			if(form.poste.value == "")
			{
				alert("Vous devez entrer votre poste occupé");
				form.poste.focus();
				return false;
			}
			if(form.bureau.value == "")
			{
				alert("Vous devez entrer votre poste téléphonique");
				form.bureau.focus();
				return false;
			}
			if(form.courriel.value == "")
			{
				alert("Vous devez entrer votre courriel");
				form.courriel.focus();
				return false;
			}

			form.submit();

		}
		//-->
	</script>
	<style>
		input{
			width: 100%;
			padding: 10px 15px;
			margin: 2px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		#generateur{
			margin-left: auto;
			margin-right: auto;
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px;
			width: 30%;
		}
		#lesubmit{
			 width: 60%;
			background-color: #4CAF50;
			color: white;
			padding: 10px 15px;
			margin: 2px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 20px;
		}
	</style>
</head>
<body>
	<div id="generateur">
		<div align="center"><h1>Générateur de signature outlook</h1>
		<a href="faq.php">FAQ - Comment installer une signature</a></div>
		<br>
		<form method="post" action="exegenerateur.php?s=1" name="generateursignature" id="generateursignature">
			<label>Nom de la signature </label>&nbsp;<input type="text" name="nom" id="nom" size="50"/><br>
			<div align="center"><h3>Informations</h3></div>
			<hr>
			<br>
			<label>Nom complet  </label><input type="text" name="fullname" id="fullname" size="30" /><br><br>
			<label>Poste occupé  </label><input type="text" name="poste" id="poste" size="40" /><br><br>
			<label>Poste téléphonique  </label><input type="text" name="bureau" id="bureau" size="20" /><br><br>
			<label>Courriel  </label><input type="text" name="courriel" id="courriel" size="30" /><br><br>
			<br>
			<div align="center"><input type="button" id="lesubmit" value="Créer la signature" onClick="return valider()"></div>
		</form>
	</div>
</body>
</html>
