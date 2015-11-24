<?php 
		session_start();
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

?>