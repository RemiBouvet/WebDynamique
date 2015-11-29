<?php 
		session_start(); // On démarre une nouvelle session ou on reprend une session existante
		//Information de connection à la base
		$Serveur="localhost";//info.univ-lemans.fr
		$Utilisateur="root"; //info201a_user
		$Base="info201a";
		$MDP=''; //com72
		$bdd=new PDO('mysql:host='.$Serveur.';dbname='.$Base.'', $Utilisateur, $MDP, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		if (!$bdd) {
			exit("Connection à la base de donnée impossible.");
		}
		//Mise en place des variables globales pour l'utilisation des tables et de la base.
		$GLOBALS["BDD"] = $bdd;
		$GLOBALS["Utilisateur"] = "vr_grp5_users";
		$GLOBALS["Jeux"] = "vr_grp5_jeux";
		$GLOBALS["Panier"] = "vr_grp5_panier";
		$GLOBALS["Reservation"] = "vr_grp5_reservation";

?>