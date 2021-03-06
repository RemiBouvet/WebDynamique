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
		<title>Ludothèque - Inscription</title>
	</head>
	<div id="header"></div> 
    <header>
        <h1>LUDOTHEQUE - Inscription</h1>
        <nav>
        	<?php
        		//On inclut le fichier qui contient le menu du site.
				include("menu.php");
			?>
        </nav>
    </header>
	<body>
	<div id="page">
		<h2>Inscription</h2>
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
			function AfficherInscription($nom, $prenom, $mail, $MDP, $reentrerMDP, $ville, $postal, $adresse){
				//Fonction qui permet d'afficher le formulaire d'inscription.
				echo "<form method='post' action='inscription.php'> 
					Adresse mail : <input class='inputInscription' type='text' name='mail' maxlength='255' value='".$mail."'/><br /><br />
					Mot de passe : <input class='inputInscription' type='password' name='MDP' maxlength='64' value='".$MDP."'/><br /><br />
					Mot de passe : <input class='inputInscription' type='password' name='reentrerMDP' maxlength='64' value='".$reentrerMDP."'/><br /><br />
					Nom : <input class='inputInscription' name='nom' type='text' maxlength='64' value='".$nom."' /> <br /> <br />
					Prénom : <input class='inputInscription' name='prenom' type='text' maxlength='64' value='".$prenom."'/><br /><br />
					Ville : <input class='inputInscription' name='ville' type='text' maxlength='64' value='".$ville."'/><br /><br />
					Code postal : <input class='inputInscription' name='postal' type='text' maxlength='64' value='".$postal."'/><br /><br />
					Adresse : <input class='inputInscription' name='adresse' type='text' maxlength='255' value='".$adresse."'/><br /><br />
					<div class='inscription'> <input type='submit' value='Inscription' name ='inscription' /></div>
				</form>";
			}

			if(!connecte()){ // Si l'utilitateur n'est pas connecté
				if(isset($_POST["inscription"])){ // Si il a appuyé sur le bouton d'inscription
					$nom = $_POST["nom"];
					$prenom = $_POST["prenom"];
					$mail = $_POST["mail"];
					$MDP = $_POST["MDP"];
					$reentrerMDP = $_POST["reentrerMDP"];
					$ville = $_POST["ville"];
					$postal = $_POST["postal"];
					$adresse = $_POST["adresse"];
					if(!empty($nom)&&!empty($prenom)&&!empty($mail)&&!empty($MDP)&&!empty($reentrerMDP)&&!empty($ville)&&!empty($postal)&&!empty($adresse)){
						// Si les champs sont remplis
						if($MDP == $reentrerMDP && !AdresseUtilise($mail)){
							// Si les deux mots de passes sont bien les mêmes et que l'adresse mail n'est pas présente dans la base
							inscription($nom, $prenom, $mail, $MDP, $ville, $postal, $adresse);
							echo "Merci de vous être inscrit. <br/>" ;
						}
						else{ // Sinon on traite les cas d'erreur
							if($MDP != $reentrerMDP){ 
								echo "Les mots de passe saisis ne sont pas identique, veuillez les ressaisir :<br/>";
								$MDP = Null;
								$reentrerMDP = Null;
							}
							if(AdresseUtilise($mail)){
								echo "L'adresse mail est déjà utilisé, veuillez vous connecter ou utiliser une autre adresse mail.<br/>";
								$MDP = Null;
								$reentrerMDP = Null;
								$mail = Null;
							}
							AfficherInscription($nom, $prenom, $mail, $MDP, $reentrerMDP, $ville, $postal, $adresse);
						}
					}
					else { // Sinon on affiche un message d'erreur.
						echo "Merci de remplire toutes les cases du formulaire :<br/>";
						AfficherInscription($nom, $prenom, $mail, $MDP, $reentrerMDP, $ville, $postal, $adresse);
					}
				}
				else{ // Si il n'a pas appuyé sur le bouton d'inscription on afficher simplement le formulaire
					$nom = Null;
					$prenom = Null;
					$mail = Null;
					$MDP = Null;
					$reentrerMDP = Null;
					$ville = Null;
					$postal = Null;
					$adresse = Null;
					AfficherInscription($nom, $prenom, $mail, $MDP, $reentrerMDP, $ville, $postal, $adresse);
				}
			}
			else { // Si il est déjà connecté on le redirige vers l'index
					header("Location: index.php");
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
