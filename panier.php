<?php
	include("include/connectionBDD.php");
	include("include/fonction.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Panier</title>
	</head>
	<body>
		<h1>Panier</h1>
			<?php
				include("authentification.php");
				include("menu.php");
			?>
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
					header("Location: panier.php");
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
						<input type='submit' value='Réserver le panier' name ='reserver' />
						</form>

			<?php

				}
				else {
					echo "Votre panier est vide.";
				}
			?>
	</body>
</html>