<?php 
		function connectionValide($mail, $password){
			//Cette fonction permet de définir si le mot de passe et l'adresse mail sont correct lors de la connection
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
			//Cette fonction permet d'insérer les informations de l'utilisateur dans la base
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
			//Cette fonction permet savoir si l'adresse email est présente dans la base
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
		function JeuPanier($id_jeu){
			//Cette fonction permet de savoir si le jeu en question est présent dans le panier de la personne connectée
			$reponse = Null;
			$resp = $GLOBALS["BDD"]->query("SELECT id_user,id_jeu FROM ". $GLOBALS['Panier']. " WHERE id_user ='".$_SESSION["id_user"]."' AND id_jeu = '".$id_jeu."'");
			while ($donnees = $resp->fetch()){
				$reponse = $donnees['id_jeu'];
			}
			if($reponse == $id_jeu){
				return True;
			}
			else{
				return False;
			}
		}

		function connection($email) {
			//Cette fonction permet de connecter l'utilisateur
			$resp = $GLOBALS["BDD"]->query("SELECT * FROM ". $GLOBALS['Utilisateur']. "  WHERE Email = '" . $email . "'");
			while ($donnees = $resp->fetch()){
				$_SESSION["id_user"] = $donnees['id_user'];
				$_SESSION["Email"] = $email;
				$_SESSION["Nom"] = $donnees['Nom'];
				$_SESSION["Prenom"] = $donnees['Prenom'];
			}
		}
		function deconnection() {
			//Cette fonction permet de deconnecter l'utilisateur
			session_unset();
			session_destroy();
		}
		function connecte() {
			//Cette fonction permet de savoir si l'utilisateur est connecté
			return isset($_SESSION["Email"]);
		}
	
		function chercherIndex(){
			//Cette fonction permet de chercher les résultats pour les jeux présent dans la bases qui sont en stocks
			$req = "SELECT * FROM " . $GLOBALS["Jeux"]. " WHERE stock > 0";
			return $GLOBALS["BDD"]->query($req);
		}
		
		function chercherJeux(){
			//Cette fonction permet de chercher les résultats pour les jeux présent dans la bases trié en fonction du choix de l'utilisateur
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
			//Cette fonction permet de chercher les résultats pour les jeux présent dans le panier de l'utilisateur
			$req = "SELECT * FROM " . $GLOBALS["Panier"] ." NATURAL JOIN ". $GLOBALS["Jeux"]  ." WHERE id_user =".$_SESSION["id_user"];
			return $GLOBALS["BDD"]->query($req);
		}

		function AjoutPanier($id_jeu){
			//Cette fonction permet d'ajouter un jeu au panier de l'utilisateur
	        $resp = $GLOBALS["BDD"]->prepare("INSERT INTO ". $GLOBALS['Panier']. " (id_user, id_jeu) VALUES ('".$_SESSION["id_user"]."', '".$id_jeu."')");
	        $resp->execute(array(
	            "id_user" => $_SESSION["id_user"], 
	            "id_jeu" => $id_jeu
	            ));
		}

		function SupprimerPanier($id_jeu){
			//Cette fonction permet de supprimer un jeu au panier de l'utilisateur
			$req = "DELETE FROM ". $GLOBALS['Panier']. " WHERE id_user =".$_SESSION["id_user"]." AND id_jeu =".$id_jeu;
	        $GLOBALS["BDD"]->exec($req);
		}

		function AjoutReservation($date_retrait){
			//Cette fonction permet de valider le panier de l'utilisateur
			$req = "SELECT * FROM ". $GLOBALS['Panier']. " WHERE id_user =".$_SESSION["id_user"];
			$resp = $GLOBALS["BDD"]->query($req);
						while ($donnees = $resp->fetch()){
									//On ajoute la reservation à la table reservation
									$insert = $GLOBALS["BDD"]->prepare("INSERT INTO ". $GLOBALS['Reservation']. " (id_user, id_jeu, date_retrait) VALUES ('".$_SESSION["id_user"]."', '".$donnees['id_jeu']."', '".$date_retrait."')");
							        $insert->execute(array(
							            "id_user" => $_SESSION["id_user"],
							            "id_jeu" => $donnees["id_jeu"],
										'date_retrait' => $date_retrait
										));
									//On met à jour le stock des jeux
									$req = "UPDATE ". $GLOBALS['Jeux']. " SET stock = stock - 1 WHERE id_jeu =".$donnees["id_jeu"];
									$update = $GLOBALS["BDD"]->prepare($req);
									$update->execute(array(
										));
									//On supprime le panier de l'utilisateur
									$req = "DELETE FROM ". $GLOBALS['Panier']. " WHERE id_panier =".$donnees["id_panier"];
	       							$GLOBALS["BDD"]->exec($req);
						}
		}

		function NombreArticle(){
			//On compte le nombre d'article présent dans le panier de l'utilisateur
			$resp = $GLOBALS["BDD"]->query("SELECT COUNT(*) AS NB FROM ". $GLOBALS['Panier']. " WHERE id_user ='".$_SESSION["id_user"]."'");
			while ($donnees = $resp->fetch()){
				$reponse = $donnees['NB'];
			}
			return $reponse;
		}

?>