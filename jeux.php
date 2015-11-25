<?php
	include("include/connectionBDD.php");
	include("include/fonction.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Jeux</title>
	</head>
	<body>
		<h1>Jeux</h1>
			<?php
				include("authentification.php");
				include("menu.php");
			?>
			<?php
				$jeu = chercherJeux();
			?>
				<table>
					<tr>
						<th><a href="?trier=nom">Nom</a></th>
						<th><a href="?trier=age"> Age minimum</a></th>
						<th><a href="?trier=type"> Type du jeu</a></th>
						<th><a href="?trier=nb_max"> Nombre de joueur maximum</a></th>
						<th><a href="?trier=nb_min"> Nombre de joueur minimum</a></th>
						<th><a href="?trier=stock"> Stock</a></th>
					</tr>
				<?php
					while($donnees = $jeu->fetch()) {
					?>
						<tr>
							<td><a href="jeu.php?id=<?php echo $donnees['id_jeu'] ?>"><?php echo $donnees['nom'] ?></a></td>
							<td><?php echo $donnees['age'] ?> ans</td>
							<td><?php echo $donnees['type'] ?></td>
							<td><?php echo $donnees['nb_max'] ?> joueurs</td>
							<td><?php echo $donnees['nb_min'] ?> joueurs</td>
							<td><?php
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
	</body>
</html>