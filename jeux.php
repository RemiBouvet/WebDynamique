<?php
	//On inclut le fichier pour se connecter à la base de donnée et le fichier qui contient les fonctions.
	include("include/connectionBDD.php");
	include("include/fonction.php");
?>


<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" />
		<title>Ludothèque - Jeux</title>
	</head>
	<div id="header"></div> 
    <header>
        <h1>LUDOTHEQUE - Jeux</h1>
        <nav>
          <?php
				//On inclut le fichier qui contient le menu du site.
				include("menu.php");
			?>
        </nav>
    </header>
	<body>
	<div id="page">
		<h2>Jeux</h2>
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
					//On recherche les informations de tous les jeux en fonction du tri demandé par l'utilisateur.
					$jeu = chercherJeux();
				?>
				<table >
					<tr>
						<!-- On permet à l'utilisateur de trier les données -->
						<th ><a href="?trier=nom">Nom</a></th>
						<th ><a href="?trier=age"> Age minimum</a></th>
						<th ><a href="?trier=type"> Type du jeu</a></th>
						<th ><a href="?trier=nb_max"> Nombre de joueur maximum</a></th>
						<th ><a href="?trier=nb_min"> Nombre de joueur minimum</a></th>
						<th ><a href="?trier=stock"> Stock</a></th>
					</tr>
				<?php
					while($donnees = $jeu->fetch()) {
						//On affiche tous les jeux
					?>
						<tr >
							<!-- La première case du tableau est le nom du jeu avec un lien vers la page jeu.php qui est notre page de traitement pour consulter la fiche d'un seul jeu -->
							<td><a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>" class="txt"><?php echo $donnees['nom'] ?></a></td>
							<td ><?php echo $donnees['age'] ?> ans</td>
							<td><?php echo $donnees['type'] ?></td>
							<td><?php echo $donnees['nb_max'] ?> joueurs</td>
							<td><?php echo $donnees['nb_min'] ?> joueurs</td>
							<td><?php
									if($donnees['stock'] > 0){ //Si le jeu n'est pas en stock on l'indique
										echo "Disponible";
									}
									else {
										echo "Indisponible";
									}
								?>
							</td>
						</tr>
					<?php
					}
				?>
					</table>
			</section>
		</section>

		<footer>
			
		</footer>
	</div>
	</body>
</html>
