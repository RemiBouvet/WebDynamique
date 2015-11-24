<?php 
		function connectionValide($mail, $password){
			$reponse = Null;
			$resp = $GLOBALS["BDD"]->query("SELECT MotDePasse FROM ". $GLOBALS['Utilisateur']. "  WHERE Email = '" . $mail . "'");
			while ($donnees = $resp->fetch()){
				$reponse = $donnees['MotDePasse'];
			}
			if(!$reponse){
				return False;
			}
			else{
				if($password == $reponse){
					return True;
				}
				else {
					return False;
				}
			}
		}

		function inscription($nom, $prenom, $mail, $MDP, $ville, $postal, $adresse){
	        $resp = $GLOBALS["BDD"]->prepare("INSERT INTO ". $GLOBALS['Utilisateur']. " (Email, Nom, Prenom, MotDePasse, Ville, Postal, Adresse) VALUES ('".$mail."', '".$nom."', '".$prenom."', '".$MDP."', '".$ville."', '".$postal."', '".$adresse."')");
	        $resp->execute(array(
	            "Email" => $mail, 
	            "Nom" => $nom,
	            "Prenom" => $prenom,
	            "MotDePasse" => $MDP,
	            "Ville" => $ville,
	            "Postal" => $postal,
	            "Adresse" => $adresse
	            ));
		}

		function AdresseUtilise($mail){
			$reponse = Null;
			$resp = $GLOBALS["BDD"]->query("SELECT Email FROM ". $GLOBALS['Utilisateur']. "  WHERE Email = '" . $mail . "'");
			while ($donnees = $resp->fetch()){
				$reponse = $donnees['Email'];
			}
			if($reponse == $mail){
				return True;
			}
			else{
				return False;
			}
		}
		function connection($email) {
			$_SESSION["Email"] = $email;
		}
		function deconnection() {
			session_unset();
			session_destroy();
		}
		function connecte() {
			return isset($_SESSION["Email"]);
		}
?>