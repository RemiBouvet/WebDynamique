<?php 
		$Serveur="localhost";
		$Utilisateur="root";
		$Base="info201a";
		$MDP='';
		$bdd=new PDO('mysql:host='.$Serveur.';dbname='.$Base.';charset=utf8', $Utilisateur, $MDP);
		if (!$bdd) {
			exit("Connection à la base de donnée impossible.");
		}
		$GLOBALS["BDD"] = $bdd;
		$GLOBALS["Utilisateur"] = "fc_grp5_user";
		$GLOBALS["Jeux"] = "fc_grp5_jeux";
		$GLOBALS["Stock"] = "fc_grp5_jeuxludotheque";
		$GLOBALS["Panier"] = "fc_grp5_panier";
		$GLOBALS["Session"] = Null;

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
	        while ($donnees = $resp->fetch()){
				$GLOBALS["Session"] = $donnees['Email'];
			}
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
?>