<?php
//partie du site qui seras présente sur tous les bas de pages 	
include_once("fonctionBD.php");
//on récupére la photo de présentation 
$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='titre-3.jpg'");
$tuto = $req->fetch();
$image = $tuto['chemin'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Homemade</title>
	<meta charset="UTF-8">
	<link href="style-3.css" rel="stylesheet">
</head>

<body>

	<div id="couleur-3-bas-page">
		<div id="bas-page">
			<div class="colonne-1">
				<p><a href="projet.php">Accueil</a></p>
				<p><a href="FormulaireTuto2.php">A votre tour!</a></p>
				<p><a href="commentaire.php">Commentaires</a></p>
			</div>
			<div class="colonne-2">
				<p><a href="couture.php">Couture</a></p>
				<p><a href="decoration.php">Décoration</a></p>
				<p><a href="cuisine.php">Cuisine</a></p>
				<p><a href="cosmetiques.php">Cosmétiques</a></p>
				<p><a href="ProduitsMenagers.php">Produits ménagers</a></p>
			</div>
			<div class="colonne-3">
				<p><a href="credits.php">Crédits</a></p>
				<p><a href="deconnexion.php">Se déconnecter</a></p>
				<p><a href="profil.php">Profil</a></p>
			</div>
		</div>
	</div>
	<div class="titre1">
		<?php echo "<img class='titre-fin' src='image/$image'	alt='présentation'/>" ?>
	</div>
</body>

</html>
