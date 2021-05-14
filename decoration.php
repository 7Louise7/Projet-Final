<?php
require_once("fonctionBD.php");
//page de présentation de la catégorie décoration

?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Homemade - Décoration</title>
	<meta charset="UTF-8">
	<link href="style-3.css" rel="stylesheet">
</head>

<body>

	<?php
	include('fil.php');
	?>


	<div class="titre-gd-h1">
		<h1>Décoration</h1>
	</div>




	<div class="presentation-tuto">
		<?php
//on cherche à savoir quel abonnement possède l'utilisateur  
		$getid = intval($_SESSION['id']);
		$req = $bdd->query("SELECT idabonnement FROM souscrire WHERE idutilisateur=?", array($getid));
		$idabonnement = $req->fetch();
//s'il a un abonnement standard, on affiche que les tutos standards qui ont pour thème décoration
		if ($idabonnement['idabonnement'] == 1) {
			$req = $bdd->query("SELECT tuto.idtuto, titreTuto, chemin FROM tuto, photo where theme='decoration' AND tuto.idtuto=photo.idtuto and tuto.idabonnement=1");
			$compteur = 1;
			while ($tuto = $req->fetch()) {

				$idtuto = $tuto['idtuto'];
				$image = $tuto['chemin'];
				$titretuto = $tuto['titreTuto'];
				echo "<div class='liste-tuto'>";
				echo "<div class='liste-tuto-.$compteur'>";
				echo "<p><a class='liste-tuto-lien' href='tuto.php?id=$idtuto'><img src='image/$image' class='image_categorie' alt='présentation'/></a></p>";
				echo "<p class='liste-tuto-l'><a class='liste-tuto-lien' href='tuto.php?id=$idtuto'>$titretuto</a> </p>";
				echo "</div>";
				echo "</div>";
				$compteur++;
			}
		}
//sinon on affiche tous les tutos qui ont pour thème décoration  (comme il a un abonnement premium)
		else {
			$req = $bdd->query("SELECT tuto.idtuto, titreTuto, chemin FROM tuto, photo where theme='decoration' AND tuto.idtuto=photo.idtuto");
			$compteur = 1;
			while ($tuto = $req->fetch()) {

				$idtuto = $tuto['idtuto'];
				$image = $tuto['chemin'];
				$titretuto = $tuto['titreTuto'];
				echo "<div class='liste-tuto'>";
				echo "<div class='liste-tuto-.$compteur'>";
				echo "<p><a class='liste-tuto-lien' href='tuto.php?id=$idtuto'><img src='image/$image' class='image_categorie' alt='présentation'/></a></p>";
				echo "<p class='liste-tuto-l'><a class='liste-tuto-lien' href='tuto.php?id=$idtuto'>$titretuto</a> </p>";
				echo "</div>";
				echo "</div>";
				$compteur++;
			}
		}
		?>

	</div>


	<?php
	include('bas.php');
	?>


</body>

</html>
