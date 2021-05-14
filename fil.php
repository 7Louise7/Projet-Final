<?php
//page qui sera présente sur le haut de toutes les pages de notre site 
require_once("fonctionBD.php");

//on créé un fonction afin de récupérer tous les tutos qui ont un même thème 
function recupereTuto($bdd, $themeTuto)
{
	$html = "";
//on regarde l'abonnement de l'utilisteur pour savoir lesquels on peut afficher 
	$getid = intval($_SESSION['id']);
	$req = $bdd->query("SELECT idabonnement FROM souscrire WHERE idutilisateur=?", array($getid));
	$idabonnement = $req->fetch();
	$a = 0;
//on regarde si l'abonné est premium
	if ($idabonnement['idabonnement'] == 3) {
		$a = 1;
	}
//donc si l'abonné n'est pas premium on lui montre que les tutos standards (qui ont un idabonnement=1)
	if ($a == 0) {
		$req = $bdd->query("SELECT titreTuto, idtuto FROM tuto where theme=? and idabonnement=?", array($themeTuto, 1));
		while ($tuto = $req->fetch()) {
			$titretuto = $tuto['titreTuto'];
			$idtuto = $tuto['idtuto'];
			$html .= "<p class='lien'><a href='tuto.php?id=$idtuto'>$titretuto</a></p>";
		}
	}
//si l'abonné est premium, on affiche tous les tutos 
	else {
		$req = $bdd->query("SELECT titreTuto, idtuto FROM tuto where theme=? ", array($themeTuto));
		while ($tuto = $req->fetch()) {
			$titretuto = $tuto['titreTuto'];
			$idtuto = $tuto['idtuto'];
			$html .= "<p class='lien'><a href='tuto.php?id=$idtuto'>$titretuto</a></p>";
		}
	}
	return $html;
}

//on recupere l'image d'accueil
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

	<div class="titre1">
		<?php echo "<img class='titre' src='image/$image'	alt='présentation'/>" ?>
	</div>

	<div class="fil">
		<div class="categorie">
			<a href="projet.php">Accueil</a>
		</div>
		<div class="categorie">
			<a href="couture.php">Couture</a>
			<div class="diy">
				<?= recupereTuto($bdd, "couture") ?>
			</div>
		</div>
		<div class="categorie">
			<a href="decoration.php">Décoration</a>
			<div class="diy">
				<?= recupereTuto($bdd, "decoration") ?>

			</div>
		</div>
		<div class="categorie">
			<a href="cuisine.php">Cuisine</a>
			<div class="diy">
				<?= recupereTuto($bdd, "cuisine") ?>
			</div>
		</div>
		<div class="categorie">
			<a href="cosmetiques.php">Cosmétiques</a>
			<div class="diy">
				<?= recupereTuto($bdd, "cosmetique") ?>
			</div>
		</div>
		<div class="categorie">
			<a href="ProduitsMenagers.php">Produits Ménagers</a>
			<div class="diy">
				<?= recupereTuto($bdd, "produit_menagers") ?>
			</div>
		</div>
		<div class="categorie">
			<a href="FormulaireTuto2.php">A votre tour!</a>
		</div>
		<div class="categorie">
			<a href="profil.php">Profil</a>
		</div>
	</div>
</body>

</html>
