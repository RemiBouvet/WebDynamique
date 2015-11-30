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
		<title>Ludothèque - Panier</title>
	</head>
	<div id="header"></div> 
    <header>
        <h1>LUDOTHEQUE - Panier</h1>
        <nav>
          <?php
				//On inclut le fichier qui contient le menu du site.
				include("menu.php");
			?>
        </nav>
    </header>
	<body>
	<div id="page">
		<h2>Votre Panier</h2>
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
					if(!connecte()){ // Si l'utilisateur n'est pas connecté on le redirige vers l'index
						header("Location: index.php");
					}
				?>
			<?php
				if(isset($_POST['supprimer'])){ //Si l'utilisateur a appuyé sur le bouton supprimer
					SupprimerPanier($_GET["id"]); 
					header("Location: panier.php"); //Actualiser la page
				}
				if(isset($_POST['reserver'])){
					$date_retrait = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour']; //Formater la date
					AjoutReservation($date_retrait);
					header("Location: panier.php?success"); //Actualiser la page avec la variable success
				}
				$panier = chercherPanier(); //On recherche les jeux du panier à afficher
				$nb=$panier->rowCount(); // On regarde si le panier de l'utilisateur est vide
				if($nb){ //Si il n'est pas vide on l'affiche
				?>
					<table>
						<tr>
							<th class="bordures">Nom</th>
							<th class="bordures"></th>
						</tr>
					<?php
						while($donnees = $panier->fetch()) {
						?>
							<tr>
								<td class="bordures"><a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>"><?php echo $donnees['nom'] ?></a></td>
								<td class="bordures"><?php
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
						<!--On affiche le formulaire pour rentrer la date de retrait du panier.-->
						<form method='post' action='panier.php'>

								Entrez un jour de retrait pour votre panier :
								<select name="jour">
								<?php
								    for($jour = 1; $jour <= 31; $jour++)
								        {
								    ?>
								        <option value="<?php echo $jour ?>"><?php echo $jour?></option>
								<?php
								        }
								?>
								</select>
								 
								<select name="mois">
								<?php
								    for($mois = 1; $mois <= 12; $mois++)
								        {
								    ?>
								        <option value="<?php echo $mois ?>"><?php echo $mois ?></option>
								<?php
								        }
								?>     
								</select>
								 
								<select name="annee">
								<?php
								    for($annee = 2015; $annee <= 2016; $annee++)
								        {
								   ?>
								        <option value="<?php echo $annee ?>"><?php echo $annee ?></option>
								<?php
								        }
								?>
								</select>


						<input type='submit' value='Confirmer la réservation' name ='reserver' />
						</form>

			<?php

				}
				else { // Si le panier est vide
					if(isset($_GET["success"])){ // Si il vient d'être reservé
						echo "Votre réservation a bien été prise en compte.";
					}
					else{ // Sinon on affiche que le panier est vide
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
<?php
	ob_end_flush();
?>
