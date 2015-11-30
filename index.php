<?php
	ob_start();
	//On inclut le fichier pour se connecter à la base de donnée et le fichier qui contient les fonctions.
	include("include/connectionBDD.php");
	include("include/fonction.php");
?>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" />
		<title>Ludothèque - Accueil</title>
	</head>
	<div id="header"></div> 
    <header>
        <h1>LUDOTHEQUE - Accueil</h1>
        <nav>
          <?php
          		//On inclut le fichier qui contient le menu du site.
				include("menu.php");
			?>
        </nav>
    </header>
	<body>
	<div id="page">
		<h2>Accueil</h2>
		<div class="connexion">
			<section> 
			    <h2>Connexion</h2>
            <section>
            <?php
            	//On inclut le fichier qui contient le module de connection.
            	include("authentification.php");
            ?>
        	</section>
		</div>

		<section>
			<p> </p>

			<section class="bloc_droit">
				<?php
					//On recherche les jeux à afficher sur l'index
					$index = chercherIndex();
				?>
				<?php
					//Affichage des jeux à l'aide d'un tableau
					while($donnees = $index->fetch()) {
				?>
						<table>
							<tr>
							<th colspan="2" class="bordures"><a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>" class="txt"><?php echo $donnees['nom'] ?> </a> </th>
							</tr>
							<br/>
							<tr>
								
								<td class="bordures"><img src="IMG/<?php echo $donnees['id_jeu'] ?>.jpg" id="img" alt="jacquette"></td>
								<td class="bordures"><p><?php echo $donnees['description'] ?></p> </td>
							</tr>
						</table>
				<?php
					}
				?>
			</section>
		</section>

		<footer>
			
		</footer>
	</div>
	</body>
</html>
<?php
	ob_end_flush();
?>
