<?php
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
            include("authentification.php");
            ?>
        </section>
		</div>

		<section>
			<p> </p>

			<section class="bloc_droit">
				<?php
				$jeu = chercherJeux();
			?>
				<table >
					<tr id="bordures">
						<th class="bordures"><a href="?trier=nom">Nom</a></th>
						<th class="bordures"><a href="?trier=age"> Age minimum</a></th>
						<th class="bordures"><a href="?trier=type"> Type du jeu</a></th>
						<th class="bordures"><a href="?trier=nb_max"> Nombre de joueur maximum</a></th>
						<th class="bordures"><a href="?trier=nb_min"> Nombre de joueur minimum</a></th>
						<th class="bordures"><a href="?trier=stock"> Stock</a></th>
					</tr>
				<?php
					while($donnees = $jeu->fetch()) {
					?>
						<tr class="bordures">
							<td class="bordures"><a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>" class="txt"><?php echo $donnees['nom'] ?></a></td>
							<td class="bordures"><?php echo $donnees['age'] ?> ans</td>
							<td class="bordures"><?php echo $donnees['type'] ?></td>
							<td class="bordures"><?php echo $donnees['nb_max'] ?> joueurs</td>
							<td class="bordures"><?php echo $donnees['nb_min'] ?> joueurs</td>
							<td class="bordures"><?php
									if($donnees['stock'] > 0){
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
