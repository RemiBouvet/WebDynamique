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
			?>
			<?php
				$req = "SELECT * FROM " . $GLOBALS["Jeux"];
				if (isset($_GET["trier"])) {
					switch ($_GET["trier"]) {
						case "nom":
							$req = $req . " ORDER BY nom";
							break;
						case "age" : 
							$req = $req . " ORDER BY age";
							break;
						case "type" : 
							$req = $req . " ORDER BY type";
							break;
						case "nb_max" : 
							$req = $req . " ORDER BY nb_max";
							break;
						case "nb_min" : 
							$req = $req . " ORDER BY nb_min";
							break;
						case "stock" : 
							$req = $req . " ORDER BY stock DESC";
							break;
					}
				}
				$jeu = $GLOBALS["BDD"]->query($req);
				?>
				<table>
					<tr>
						<th><a href="?trier=nom">Nom</a></th>
						<th><a href="?trier=age"> Age minimum</a> </th>
						<th><a href="?trier=type"> Type du jeu</a> </th>
						<th><a href="?trier=nb_max"> Nombre de joueur maximum</a> </th>
						<th><a href="?trier=nb_min"> Nombre de joueur minimum</a> </th>
						<th><a href="?trier=stock"> Stock</a> </th>
					</tr>
				<?php
					while($donnees = $jeu->fetch()) {
					?>
						<tr>
							<td><?php echo $donnees['nom'] ?></td>
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