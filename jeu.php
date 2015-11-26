<?php
	include("include/connectionBDD.php");
	include("include/fonction.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Jeu</title>
	</head>
	<body>
		<h1>Jeu</h1>
			<?php
				include("authentification.php");
				include("menu.php");
			?>
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
									echo "<form method='post' action='jeu.php?id=".$_GET["id"]."'>
										<input type='submit' value='Ajouter au panier' name ='ajouter' />
									</form>";
									}
								}
							}
							else {
								echo "Le jeu est indiponiible pour le moment.</ br>";
							}
					?>
					<ul>
						<li>Nom du jeu : <a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>"><?php echo $donnees['nom'] ?></a></li>
						<li>Age minimum conseillé : <?php echo $donnees['age'] ?> ans</li>
						<li>Type de jeu : <?php echo $donnees['type'] ?></li>
						<li>Nombre maximum de joueurs : <?php echo $donnees['nb_max'] ?></li>
						<li>Nombre minimum de joueurs : <?php echo $donnees['nb_min'] ?></li>
					</ul>
					<p><?php echo $donnees['description'] ?></p>
					<?php
					}
				}
			?>
	</body>
</html>