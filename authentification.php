<?php
	function AfficherConnection(){ // Fonction qui permet d'afficher le formulaire pour se connecter.
		?>
			<form method='post' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
				Adresse mail : <input type='text' name='email' maxlength='50'/><br /><br />
				Mot de passe : <input type='password' name='MDP' maxlength='50'/><br /><br />
				<input type='submit' value='Se connecter' name ='connection' />
			</form>
		<?php
	}
	if(isset($_POST["deconnection"])){
		deconnection();
		header("Location: ".$_SERVER['PHP_SELF']);	//On actualise la page actuelle
	}
	if(!connecte()){ //Si l'utilisateur n'est pas connecté
		if(isset($_POST["connection"])){ //Si il a validé le formulaire de connection
			$email = $_POST["email"];
			$MDP = $_POST["MDP"];
			if(!isset($email)){	//On vérifie que le champ de l'adresse mail et du mot de passe soit bien rempli.
				echo "Veuillez entrer votre addresse mail<br/>";
				AfficherConnection();
			}
			else if (!isset($MDP)){
				echo "Veuillez entrer un mot de passe :<br/>";
				AfficherConnection();
			}
			else if (connectionValide($email, $MDP)){ //Si l'email et le mot de passe rentré correspondent
				connection($email);
				header("Location: ".$_SERVER['PHP_SELF']); //On actualise la page actuelle
			}
			else { //Sinon les identifiants sont invalides
				echo "Identifiants invalides !";
				AfficherConnection();
			}
		}
		else {
			AfficherConnection();
		}
	}
	else { //Si l'utilisateur est connecté on affiche un message et on lui propose de se déconnecter.
		echo "Bonjour ".$_SESSION["Prenom"]." ".$_SESSION["Nom"];
		echo "<br/> "
		?>
			<form method='post' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
				<input type='submit' value='Se deconnecter' name ='deconnection' />
			</form>
		<?php
	}
?>
