<?php
	echo "<ul>";
	echo "<li> <a href='index.php'>Accueil</a> </li> 
	<li><a href='jeux.php'>Nos jeux</a></li>";
    if(connecte()){ //Si l'utilisateur est connecté on préfera afficher un lien vers le panier au lieu de la page d'inscription
    	echo "<li><a href='panier.php'>Panier</a></li>";
    }
    else {
    	echo "<li><a href='inscription.php'>Inscription</a></li>";
    }
    echo "</ul>";
?>