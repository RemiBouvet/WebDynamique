<?php
	echo "<a href='index.php'>Acceuil</a><br /> 
	<a href='jeux.php'>Nos jeux</a><br />";
    if(connecte()){
    	echo "<a href='panier.php'>Panier</a><br />";
    }
    else {
    	echo "<a href='inscription.php'>Inscription</a><br />";
    }
?>