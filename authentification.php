<?php
	include("include/connectionBDD.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>authentification</title>
	</head>
	<body>
		<h1>Page d'authentification </h1>	
			<?php
				function AfficherFormulaire(){
					?>
						<form method='post' action='authentification.php'>
							Email : <input type='text' name='email' maxlength='50'/><br /><br />
							Mot de passe : <input type='password' name='MDP' maxlength='50'/><br /><br />
							<input type='submit' value='Se connecter' name ='connection' />
						</form>
					<?php
				}


				if(isset($_POST["connection"])){
					$email = $_POST["email"];
					$MDP = $_POST["MDP"];
					if(!isset($email)){
						echo "Veuillez entrer votre addresse mail<br/>";
						AfficherFormulaire();
					}
					else if (!isset($MDP)){
						echo "Veuillez entrer un mot de passe :<br/>";
						AfficherFormulaire();
					}
					else if (connectionValide($email, $MDP)){
						$GLOBALS["Session"] = $email;
						echo "Connection réussie !" ;
					}
					else {
						echo "Identifiants invalides !";
						AfficherFormulaire();
					}
				}
				else {
					AfficherFormulaire();
				}
		?>
	</body>
</html>
