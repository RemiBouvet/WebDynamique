<?php
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
            include("authentification.php");
            ?>
        </section>
		</div>

		<section>
			<p> </p>

			<section class="bloc_droit">
				<?php
				if(!isset($_GET["id"])){
					header("Location: jeux.php");
				}
				else {
					$req = "SELECT * FROM " . $GLOBALS["Jeux"] ." WHERE id_jeu =".$_GET["id"];
					$jeu = $GLOBALS["BDD"]->query($req);
					while($donnees = $jeu->fetch()) {
						if($donnees['stock'] > 0){
								if(!connecte()){
									echo "Le jeu est disponible, connectez vous pour pouvoir l'ajouter au panier.</ br>";
								}
								else {
									if(isset($_POST["ajouter"])){
										AjoutPanier($_GET["id"]);
										echo "Le jeu a bien été ajouté au panier.</br>";
									}
									else{
										if(NombreArticle() >= 3){
											echo "Vous ne pouvez plus ajouter un jeu à votre panier car vous avez atteints la limite qui est de 3.";
										}
										else {
											if(JeuPanier($_GET["id"])){
												echo "Le jeu est déjà dans votre panier.";
											}
											else {
												echo "<form method='post' action='jeu.php?id=".$_GET["id"]."'>
													<input type='submit' value='Ajouter au panier' name ='ajouter' />
												</form>";
											}
										}
									}
								}
							}
							else {
								echo "Le jeu est indisponible pour le moment.</ br>";
							}
					?>
					<img src="IMG/<?php echo $donnees['id_jeu'] ?>.jpg" id="img" alt="jacquette">
					<ul>
						<li>Nom du jeu : <a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>"class="txt"><?php echo $donnees['nom'] ?></a></li>
						<li>Age minimum conseillé : <?php echo $donnees['age'] ?> ans</li>
						<li>Type de jeu : <?php echo $donnees['type'] ?></li>
						<li>Nombre maximum de joueurs : <?php echo $donnees['nb_max'] ?></li>
						<li>Nombre minimum de joueurs : <?php echo $donnees['nb_min'] ?></li>
					</ul>
					<p><br /><br /><?php echo $donnees['description'] ?></p>
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
