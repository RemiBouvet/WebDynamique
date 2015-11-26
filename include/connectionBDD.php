<?php 
		session_start();
		$Serveur="info.univ-lemans.fr";//localhost
		$Utilisateur="info201a_user";//root
		$Base="info201a";
		$MDP='com72';
		$bdd=new PDO('mysql:host='.$Serveur.';dbname='.$Base.';charset=utf8', $Utilisateur, $MDP);
		if (!$bdd) {
			exit("Connection à la base de donnée impossible.");
		}
		mysql_set_charset("utf8",$link);
		$GLOBALS["BDD"] = $bdd;
		$GLOBALS["Utilisateur"] = "vr_grp5_users";
		$GLOBALS["Jeux"] = "vr_grp5_jeux";
		$GLOBALS["Panier"] = "vr_grp5_panier";
		$GLOBALS["Reservation"] = "vr_grp5_reservation";

?>