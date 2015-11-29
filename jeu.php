<?php
	//On inclut le fichier pour se connecter à la base de donnée et le fichier qui contient les fonctions.
	include("include/connectionBDD.php");
	include("include/fonction.php");
?>


<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" />
		<title>Ludothèque - jeu</title>
	</head>
	<div id="header"></div> 
    <header>
        <h1>LUDOTHEQUE - jeu</h1>
        <nav>
          <?php
				//On inclut le fichier qui contient le menu du site.
				include("menu.php");
			?>
        </nav>
    </header>
	<body>
	<div id="page">
		<h2>Jeu</h2>
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
				if(!isset($_GET["id"])){ //Si il n'y a pas d'id du jeu à afficher alors on redirige vers la page où se trouve tous les jeux.
					header("Location: jeux.php");
				}
				else { //Sinon on traite les informations pour l'ajout au panier
					$req = "SELECT * FROM " . $GLOBALS["Jeux"] ." WHERE id_jeu =".$_GET["id"];
					$jeu = $GLOBALS["BDD"]->query($req);
					while($donnees = $jeu->fetch()) {
						if($donnees['stock'] > 0){ // Si le jeu est en stock
								if(!connecte()){ //Si l'utilisateur n'est pas connecté
									echo "Le jeu est disponible, connectez vous pour pouvoir l'ajouter au panier.</ br>";
								}
								else { //Si l'utilisateur est connecté
									if(isset($_POST["ajouter"])){ // Si l'utilisateur a appuyé sur le bouton ajouter
										AjoutPanier($_GET["id"]); // Ajouter l'article au panier
										echo "Le jeu a bien été ajouté au panier.</br>";
									}
									else{ // Sinon si l'utilisateur n'a pas appuyé sur le bouton ajouter
										if(NombreArticle() >= 3){ // Si il a déjà 3 articles dans son panier
											echo "Vous ne pouvez plus ajouter un jeu à votre panier car vous avez atteints la limite qui est de 3.";
										}
										else { //Sinon si il a moins de trois articles
											if(JeuPanier($_GET["id"])){ // Si le jeu est déjà dans son panier
												echo "Le jeu est déjà dans votre panier.";
											}
											else { //Sinon on affiche le bouton pour ajouter au panier
												echo "<form method='post' action='jeu.php?id=".$_GET["id"]."'>
													<input type='submit' value='Ajouter au panier' name ='ajouter' />
												</form>";
											}
										}
									}
								}
							}
							else { // Si le jeu n'est pas en stock
								echo "Le jeu est indisponible pour le moment.</ br>";
							}
					//On affiche toutes les informations sur le jeu en question
					?>
					<br />
					<img src="IMG/<?php echo $donnees['id_jeu'] ?>.jpg" id="img" alt="jacquette">
					<ul>
						<li>Nom du jeu : <a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>"class="txt"><?php echo $donnees['nom'] ?></a></li>
						<li>Age minimum conseillé : <?php echo $donnees['age'] ?> ans</li>
						<li>Type de jeu : <?php echo $donnees['type'] ?></li>
						<li>Nombre maximum de joueurs : <?php echo $donnees['nb_max'] ?></li>
						<li>Nombre minimum de joueurs : <?php echo $donnees['nb_min'] ?></li>
					</ul>
					<p><br /><?php echo $donnees['description'] ?></p>
					<?php
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
