<?php
//page d'accueil
require_once('fonctionBD.php');
include('fil.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Homemade</title>
	<meta charset="UTF-8">
	<link href="style-3.css" rel="stylesheet">
</head>

<body>



	<div class="accueil1">

		<div class="titre-gd-h1">
			<h1>Accueil</h1>
		</div>
		<p class="accueilPresentation">Bienvenue sur notre site amis écolos ! Vous trouverez ici de nombreux tutos peu coûteux mais
			super faciles à réaliser. Il y en a pour tous les goûts. N'hésitez pas à nous laisser votre avis ou à nous proposer vos propres tutos !
		<div class="categorie-1">
			<div class="couture">
				<?php

				$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='accueil-couture.jpg'");
				$tuto = $req->fetch();
				$image = $tuto['chemin'];
				echo "<p><a href='couture.php'><img class='theme-categorie' src='image/$image'	alt='présentation'/></a></p>"
				?>
			</div>
			<div class="decoration">
				<?php

				$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='accueil-decoration.jpg'");
				$tuto = $req->fetch();
				$image = $tuto['chemin'];
				echo "<p><a href='decoration.php'><img class='theme-categorie' src='image/$image' alt='présentation'/></a></p>"
				?>
			</div>
			<div class="cuisine">
				<?php

				$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='accueil-cuisine.jpg'");
				$tuto = $req->fetch();
				$image = $tuto['chemin'];
				echo "<p><a href='cuisine.php'><img class='theme-categorie' src='image/$image' alt='présentation'/></a></p>"
				?>
			</div>
		</div>
		<div class="categorie-2">
			<div class="cosmetique">
				<?php

				$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='accueil-cosmetique.jpg'");
				$tuto = $req->fetch();
				$image = $tuto['chemin'];
				echo "<p><a href='cosmetiques.php'><img class='theme-categorie' src='image/$image' alt='présentation'/></a></p>"
				?>
			</div>
			<div class="produits-menagers">
				<?php

				$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='accueil-menagers.jpg'");
				$tuto = $req->fetch();
				$image = $tuto['chemin'];
				echo "<p><a href='ProduitsMenagers.php'><img class='theme-categorie' src='image/$image' alt='présentation'/></a></p>"
				?>
			</div>
		</div>
	</div>


	<?php
	include('bas.php');
	?>
</body>

</html>
