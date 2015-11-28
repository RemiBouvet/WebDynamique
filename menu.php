<?php
	echo "<ul>";
	echo "<li> <a href='index.php'>Accueil</a> </li> 
	<li><a href='jeux.php'>Nos jeux</a></li>";
    if(connecte()){
    	echo "<li><a href='panier.php'>Panier</a></li>";
    }
    else {
    	echo "<li><a href='inscription.php'>Inscription</a></li>";
    }
    echo "</ul>";
?>