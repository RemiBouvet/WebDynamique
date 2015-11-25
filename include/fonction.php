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
			$resp = $GLOBALS["BDD"]->query("SELECT id_user FROM ". $GLOBALS['Utilisateur']. "  WHERE Email = '" . $email . "'");
			while ($donnees = $resp->fetch()){
				$id_user = $donnees['id_user'];
			}
			$_SESSION["id_user"] = $id_user;
			$_SESSION["Email"] = $email;
		}
		function deconnection() {
			session_unset();
			session_destroy();
		}
		function connecte() {
			return isset($_SESSION["Email"]);
		}

		function chercherJeux(){
				$req = "SELECT * FROM " . $GLOBALS["Jeux"];
				if (isset($_GET["trier"])) {
					switch ($_GET["trier"]) {
						case "nom":
							$req = $req . " ORDER BY nom";
							break;
						case "age" : 
							$req = $req . " ORDER BY age";
							break;
						case "type" : 
							$req = $req . " ORDER BY type";
							break;
						case "nb_max" : 
							$req = $req . " ORDER BY nb_max";
							break;
						case "nb_min" : 
							$req = $req . " ORDER BY nb_min";
							break;
						case "stock" : 
							$req = $req . " ORDER BY stock DESC";
							break;
					}
				}
			return $GLOBALS["BDD"]->query($req);
		}


		function chercherPanier(){
			$req = "SELECT * FROM " . $GLOBALS["Panier"] ." NATURAL JOIN ". $GLOBALS["Jeux"]  ." WHERE id_user =".$_SESSION["id_user"];
			return $GLOBALS["BDD"]->query($req);
		}

		function AjoutPanier($id_jeu){
	        $resp = $GLOBALS["BDD"]->prepare("INSERT INTO ". $GLOBALS['Panier']. " (id_user, id_jeu) VALUES ('".$_SESSION["id_user"]."', '".$id_jeu."')");
	        $resp->execute(array(
	            "id_user" => $_SESSION["id_user"], 
	            "id_jeu" => $id_jeu
	            ));
		}

		function SupprimerPanier($id_jeu){
			$req = "DELETE FROM ". $GLOBALS['Panier']. " WHERE id_user =".$_SESSION["id_user"]." AND id_jeu =".$id_jeu;
	        $GLOBALS["BDD"]->exec($req);
		}

?>