<?php
	function AfficherConnection(){
		?>
			<form method='post' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
				Email : <input type='text' name='email' maxlength='50'/><br /><br />
				Mot de passe : <input type='password' name='MDP' maxlength='50'/><br /><br />
				<input type='submit' value='Se connecter' name ='connection' />
			</form>
		<?php
	}
	if(isset($_POST["deconnection"])){
		deconnection();
	}
	if(!connecte()){
		if(isset($_POST["connection"])){
			$email = $_POST["email"];
			$MDP = $_POST["MDP"];
			if(!isset($email)){
				echo "Veuillez entrer votre addresse mail<br/>";
				AfficherConnection();
			}
			else if (!isset($MDP)){
				echo "Veuillez entrer un mot de passe :<br/>";
				AfficherConnection();
			}
			else if (connectionValide($email, $MDP)){
				connection($email);
				header("Location: ".$_SERVER['PHP_SELF']);
				echo "Connection réussie !" ;
			}
			else {
				echo "Identifiants invalides !";
				AfficherConnection();
			}
		}
		else {
			AfficherConnection();
		}
	}
	else {
		echo "Bonjour ".$_SESSION["Prenom"]." ".$_SESSION["Nom"];
		echo "<br/> "
		?>
			<form method='post' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
				<input type='submit' value='Se deconnecter' name ='deconnection' />
			</form>
		<?php
	}
?>