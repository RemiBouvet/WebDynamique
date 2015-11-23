<?php
	include("include/connectionBDD.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Inscription</title>
	</head>
	<body>
		<h1>Page d'inscription </h1>
		<?php
			function AfficherFormulaire($nom, $prenom, $mail, $MDP, $reentrerMDP, $ville, $postal, $adresse){
				echo "<form method='post' action='inscription.php'> 
					Adresse mail : <input type='text' name='mail' maxlength='255' value='".$mail."'/><br /><br />
					Mot de passe : <input type='password' name='MDP' maxlength='64' value='".$MDP."'/><br /><br />
					Mot de passe : <input type='password' name='reentrerMDP' maxlength='64' value='".$reentrerMDP."'/><br /><br />
					Nom : <input name='nom' type='text' maxlength='64' value='".$nom."' /> <br /> <br />
					Prénom : <input name='prenom' type='text' maxlength='64' value='".$prenom."'/><br /><br />
					Ville : <input name='ville' type='text' maxlength='64' value='".$ville."'/><br /><br />
					Code postal : <input name='postal' type='text' maxlength='64' value='".$postal."'/><br /><br />
					Adresse : <input name='adresse' type='text' maxlength='255' value='".$adresse."'/><br /><br />
					<input type='submit' value='Inscription' name ='inscription' />
				</form>";
			}

			if(!connecte()){
				if(isset($_POST["inscription"])){
					$nom = $_POST["nom"];
					$prenom = $_POST["prenom"];
					$mail = $_POST["mail"];
					$MDP = $_POST["MDP"];
					$reentrerMDP = $_POST["reentrerMDP"];
					$ville = $_POST["ville"];
					$postal = $_POST["postal"];
					$adresse = $_POST["adresse"];
					if(!empty($nom)&&!empty($prenom)&&!empty($mail)&&!empty($MDP)&&!empty($reentrerMDP)&&!empty($ville)&&!empty($postal)&&!empty($adresse)){
						if($MDP == $reentrerMDP && !AdresseUtilise($mail)){
							inscription($nom, $prenom, $mail, $MDP, $ville, $postal, $adresse);
							echo "Merci de vous être inscrit. <br/>" ;
						}
						else{
							if($MDP != $reentrerMDP){
								echo "Les mots de passe saisis ne sont pas identique, veuillez les ressaisir :<br/>";
								$MDP = Null;
								$reentrerMDP = Null;
							}
							if(AdresseUtilise($mail)){
								echo "L'adresse mail est déjà utilisé, veuillez vous connecter ou utiliser une autre adresse mail.<br/>";
								$MDP = Null;
								$reentrerMDP = Null;
								$mail = Null;
							}
							AfficherFormulaire($nom, $prenom, $mail, $MDP, $reentrerMDP, $ville, $postal, $adresse);
						}
					}
					else {
						echo "Merci de remplire toutes les cases du formulaire :<br/>";
						AfficherFormulaire($nom, $prenom, $mail, $MDP, $reentrerMDP, $ville, $postal, $adresse);
					}
				}
				else{
					$nom = Null;
					$prenom = Null;
					$mail = Null;
					$MDP = Null;
					$reentrerMDP = Null;
					$ville = Null;
					$postal = Null;
					$adresse = Null;
					AfficherFormulaire($nom, $prenom, $mail, $MDP, $reentrerMDP, $ville, $postal, $adresse);
				}
			}
			else {
					header('Refresh: 3;URL=authentification.php');
					echo "Vous êtes déjà connecté vous allez être redirigé vers la page d'acceuil." ;

				}
		?>
	</body>
</html>