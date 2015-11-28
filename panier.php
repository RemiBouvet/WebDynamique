<?php
	include("include/connectionBDD.php");
	include("include/fonction.php");
?>


<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" />
		<title>Ludothèque - Panier</title>
	</head>
	<div id="header"></div> 
    <header>
        <h1>LUDOTHEQUE - Panier</h1>
        <nav>
          <?php
				
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
            include("authentification.php");
            ?>
        </section>
		</div>

		<section>
			<p> </p>

			<section class="bloc_droit">
				<?php
					if(!connecte()){
						header("Location: index.php");
					}
				?>
			<?php
				if(isset($_POST['supprimer'])){
					SupprimerPanier($_GET["id"]);
					header("Location: panier.php");
				}
				if(isset($_POST['reserver'])){
					AjoutReservation($_POST['date_retrait']);
					header("Location: panier.php?success");
				}
				$panier = chercherPanier();
				$nb=$panier->rowCount();
				if($nb){
				?>
					<table>
						<tr>
							<th>Nom</th>
							<th></th>
						</tr>
					<?php
						while($donnees = $panier->fetch()) {
						?>
							<tr>
								<td><a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>"><?php echo $donnees['nom'] ?></a></td>
								<td><?php
									echo "<form method='post' action='panier.php?id=".$donnees['id_jeu']."'>
											<input type='submit' value='Supprimer du panier' name ='supprimer' />
										</form>";
									?>
								</td>
							</tr>
						<?php
						}
					?>
						</table>
						<form method='post' action='panier.php'>
						Entrez un jour de retrait pour votre panier (sous la forme aaaa-mm-jj): <input type="date" name="date_retrait">
						<input type='submit' value='Confirmer la réservation' name ='reserver' />
						</form>

			<?php

				}
				else {
					if(isset($_GET["success"])){
						echo "Votre réservation a bien été prise en compte.";
					}
					else{
						echo "Votre panier est vide.";
					}
				}
			?>
			</section>
		</section>

		<footer>
			
		</footer>
	</div>
	</body>
</html>