<?php
	include("include/connectionBDD.php");
	include("include/fonction.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Page d'acceuil</title>
	</head>
	<body>
		<h1>Page d'acceuil</h1>
			<?php
				include("authentification.php");
				include("menu.php");
			?>
			<?php
				$index = chercherIndex();
			?>
				<?php
					while($donnees = $index->fetch()) {
					?>
						<a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>"><?php echo $donnees['nom'] ?></a>
						<img src="IMG/<?php echo $donnees['id_jeu'] ?>.jpg" alt="jacquette">
						<p><?php echo $donnees['description'] ?></p>
					<?php
					}
				?>
	</body>
</html>