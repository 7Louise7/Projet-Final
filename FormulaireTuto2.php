<?php
require_once("fonctionBD.php");
include('fil.php');

//traitement des données du formulaire en php pour rentrer des tutos dans la base 


if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
	$getid = intval($_SESSION['id']);
}

//les fonctions

function inseretape($bdd, $TexteEtape, $tuto, $photo)
{
	$ajout = $bdd->prepare("INSERT INTO etape(texte,idtuto,idphoto) VALUES(?,?,?)");
	$ajout->execute(array($TexteEtape, $tuto, $photo));
	$ajout->closecursor();
}

function inserphoto($bdd, $chemin)
{
	$ajout = $bdd->prepare("INSERT INTO photo(datePhoto,chemin) VALUES(?,?)");
	$ajout->execute(array(date("Y-m-d"), $chemin));
	$ajout->closecursor();
}

function extraireidphoto($bdd, $chemin)
{
	$req = $bdd->prepare("SELECT idphoto FROM photo where chemin=?");
	$req->execute(array($chemin));
	$photo = $req->fetch();
	return $photo['idphoto'];
	$req->closecursor();
}

function extraireidmateriel($bdd, $nom)
{
	$req = $bdd->prepare("SELECT idmateriel FROM materiel where nommateriel=?");
	$req->execute(array($nom));
	$materiel = $req->fetch();
	$req->closeCursor();
	return $materiel['idmateriel'];
}

function photovalide($photo)
{

/*on regarde si le fichier envoye est une image*/
	$subject = $photo['name'];
	$pattern = '/(gif|jpg|png)$/i';
	$a = 0;

	$matches = preg_match($pattern, $subject, $tabMatches);
	if ($matches == 0) {
		return 'Ce fichier n\'est pas une image reconnue';
	} else {
		$a++;
	}

/*on vérifie que le fichier envoyé n'a pas un poids plus gros que celui défini*/
	$max = $_POST["max_file_size"];
	if (filesize($photo['tmp_name']) > $max) {
		return 'Image trop grande, limitée à ' . $max / 1000 . 'Ko';
	} else {
		$a++;
	}

	if ($a == 2) {
		return true;
	}
}
//On met du vide dans les variables afin que ce qu'on écrit reste écrit après la validation du formulaire, s'il n'était pas valide 
$titretuto = "";
$theme = "";
$textpresentation = "";
$Materiel_1 = "";
$Materiel_2 = "";
$Materiel_3 = "";
$Materiel_4 = "";
$Materiel_5 = "";
$Materiel_6 = "";
$Materiel_7 = "";
$Materiel_8 = "";
$Materiel_9 = "";
$Materiel_10 = "";
$Materiel_11 = "";
$TexteEtape1 = "";
$TexteEtape2 = "";
$TexteEtape3 = "";
$TexteEtape4 = "";
$TexteEtape5 = "";
$TexteEtape6 = "";
$TexteEtape7 = "";
$TexteEtape8 = "";
$TexteEtape9 = "";
$TexteEtape10 = "";
$TexteEtape11 = "";
$TexteEtape12 = "";
$quantite_1 = "";
$quantite_2 = "";
$quantite_3 = "";
$quantite_4 = "";
$quantite_5 = "";
$quantite_6 = "";
$quantite_7 = "";
$quantite_8 = "";
$quantite_9 = "";
$quantite_10 = "";
$quantite_11 = "";
$formThemeSelected = ["", "", "", "", ""];
$formaboSelected = ["", ""];


//Vérification qu'un formulaire a été envoyé + définition de nos variables qui viennent du formulaire 
if (!empty($_POST)) {
	extract($_POST);
	$valid = true;

	if ($theme == "couture") {
		$formThemeSelected[0] = "selected";
	} elseif ($theme == "decoration") {
		$formThemeSelected[1] = "selected";
	} elseif ($theme == "cosmetique") {
		$formThemeSelected[2] = "selected";
	} elseif ($theme == "cuisine") {
		$formThemeSelected[3] = "selected";
	} elseif ($theme == "produit_menagers") {
		$formThemeSelected[4] = "selected";
	}

	if ($abonnement == "1") {
		$formaboSelected[0] = "selected";
	} elseif ($abonnement == "3") {
		$formaboSelected[1] = "selected";
	}


	if (isset($_POST['fichier'])) {
		$titretuto = trim($titretuto);
		$theme =  trim($theme);
		$textpresentation = trim($textpresentation);
		$Materiel_1 =  trim($Materiel_1);
		$Materiel_2 =  trim($Materiel_2);
		$Materiel_3 = trim($Materiel_3);
		$Materiel_4 =  trim($Materiel_4);
		$Materiel_5 =  trim($Materiel_5);
		$Materiel_6 =  trim($Materiel_6);
		$Materiel_7 =  trim($Materiel_7);
		$Materiel_8 =  trim($Materiel_8);
		$Materiel_9 =  trim($Materiel_9);
		$Materiel_10 =  trim($Materiel_10);
		$Materiel_11 =  trim($Materiel_11);
		$TexteEtape1 =  trim($TexteEtape1);
		$TexteEtape2 =  trim($TexteEtape2);
		$TexteEtape3 =  trim($TexteEtape3);
		$TexteEtape4 =  trim($TexteEtape4);
		$TexteEtape5 =  trim($TexteEtape5);
		$TexteEtape6 =  trim($TexteEtape6);
		$TexteEtape7 =  trim($TexteEtape7);
		$TexteEtape8 =  trim($TexteEtape8);
		$TexteEtape9 =  trim($TexteEtape9);
		$TexteEtape10 =  trim($TexteEtape10);
		$quantite_1 =  trim($quantite_1);
		$quantite_2 =  trim($quantite_2);
		$quantite_3 =  trim($quantite_3);
		$quantite_4 =  trim($quantite_4);
		$quantite_5 =  trim($quantite_5);
		$quantite_6 =  trim($quantite_6);
		$quantite_7 =  trim($quantite_7);
		$quantite_8 =  trim($quantite_8);
		$quantite_9 =  trim($quantite_9);
		$quantite_10 =  trim($quantite_10);
		$quantite_11 =  trim($quantite_11);
	}

//on affiche des messages des erreurs pour guider le visiteur 
	if (empty($titretuto)) {
		$valid = false;
		$err_titre = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champ !</p>";
	} else {
		$req = $bdd->query("SELECT idtuto FROM tuto WHERE  titreTuto= ?", array($titretuto));
		$tuto = $req->fetch();
		if (isset($tuto['idtuto'])) {
			$valid = false;
			$err_titre = "<p style=\"color:#FF0000\";>Ce tuto existe déjà !</p>";
		}
	}

	if (empty($theme)) {
		$valid = false;
		$err_theme = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champ !</p>";
	}

	if (empty($textpresentation)) {
		$valid = false;
		$err_textepresentation = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champ !</p>";
	}

	if (empty($TexteEtape1)) {
		$valid = false;
		$err_etape = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champ, au moins une étape est requise !</p>";
		echo $err_etape;
	}

	if (empty($Materiel_1)) {
		$valid = false;
		$err_materiel = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champ, au moins un matériel est requis !</p>";
		echo $err_materiel;
	}
	if (empty($abonnement)) {
		$valid = false;
		$err_abonnement = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champ, au moins un matériel est requis !</p>";
		echo $err_abonnement;
	}
	if (true !== (photovalide($_FILES['photopresentation']))) {
		$valid = false;
		$err_photo = photovalide($_FILES['photopresentation']);
	}


//si tout va bien, on commence à introduire dans la base 

	if ($valid) {
//ajout d'un tuto 
		echo 'oui';

		$date = date("Y-m-d");
		$ajout = $bdd->insert("INSERT INTO tuto(dateCreation,theme,titreTuto,textpresentation,idutilisateur,idabonnement) VALUES(?,?,?,?,?,?)", array($date, $theme, $titretuto, $textpresentation, $getid, $abonnement));



//on recupere l'identifiant du tuto 
		$req = $bdd->query("SELECT idtuto FROM tuto where titreTuto=?", array($titretuto));
		$tuto = $req->fetch();
		$req->closeCursor();
		$idtuto = $tuto['idtuto'];
		echo $idtuto;

//ajout de la photo d'un tuto 

		$ajout = $bdd->insert("INSERT INTO photo(datePhoto,chemin,idtuto) VALUES(?,?,?)", array($date, $_FILES['photopresentation']['name'], $idtuto));


//ajout d'une photo et de son etape 
		$compteur = 1;
		while (!empty($_FILES['PhotoEtape' . $compteur . '']['name']) and !empty(${'TexteEtape' . $compteur}) and true == (photovalide($_FILES['PhotoEtape' . $compteur . '']))) {
			inserphoto($bdd, $_FILES['PhotoEtape' . $compteur . '']['name']);
			$idphoto = extraireidphoto($bdd, $_FILES['PhotoEtape' . $compteur . '']['name']);
			inseretape($bdd, ${'TexteEtape' . $compteur}, $idtuto, $idphoto);
			$compteur = $compteur + 1;
		}

//ajout d'un materiel a la liste
		$compte = 1;
		while (!empty(${'Materiel_' . $compte}) and !empty(${'quantite_' . $compte})) {
//on regarde si le materiel est deja dans la base 
			$req = $bdd->query("SELECT idmateriel FROM materiel WHERE  nommateriel= ?", array(${'Materiel_' . $compte}));
			$materiel = $req->fetch();
//s'il l'est on rajoute juste un ligne dans la table necessite qu'on relie au materiel deja existant 
			if (!empty($materiel['idmateriel'])) {
				$ajout = $bdd->insert("INSERT INTO necessite(idmateriel,idtuto,quantité) VALUES(?,?,?)", array($materiel['idmateriel'], $idtuto, ${'quantite_' . $compte}));
				$compte++;
			}
//sinon on ajoute le materiel à la base dans la table matetriel et on le relie au tuto grace a la table necessite 
			else {
				$ajout = $bdd->insert("INSERT INTO materiel(nommateriel) VALUES(?)", array(${'Materiel_' . $compte}));
				$idmateriel = extraireidmateriel($bdd, ${'Materiel_' . $compte});
				$ajout = $bdd->insert("INSERT INTO necessite(idmateriel,idtuto,quantité) VALUES(?,?,?)", array($idmateriel, $idtuto, ${'quantite_' . $compte}));
				$compte++;
			}
		}


		header('Location: projet.php');
		exit;
	}
}

//on recupere l'image de l'étape
$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='grand-titre-8.jpg'");
$tuto = $req->fetch();
$image_et = $tuto['chemin'];
?>

<!DOCTYPE html>
<html lang="fr">

<!-- formulaire pour rentrer des nouveaux tutos
-->

<head>
	<title>Ajouter un tuto</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" media="all" href="style-3.css">

</head>

<body>
	<h1 class="titre-gd-h1">
		Nouveau Tuto
	</h1>

	<form action="formulaireTuto2.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="max_file_size" value="50000" />
		<p>
		<div class="themeFormTuto">
			<label>
				Ce tuto est destiné aux abonnés :
			</label>
			<select id="abonnement" name="abonnement">
				<option value="1" <?= $formaboSelected[0] ?>>Standards</option>
				<option value="3" <?= $formaboSelected[1] ?>>Premiums</option>
			</select><br />
			<?= isset($err_abonnement) ?  $err_abonnement : "" ?>
			<div class="Theme">
				<label>
					Thème :
				</label>
				<select id="theme" name="theme">
					<option value="couture" <?= $formThemeSelected[0] ?>>Couture</option>
					<option value="decoration" <?= $formThemeSelected[1] ?>>Décoration</option>
					<option value="cosmetique" <?= $formThemeSelected[2] ?>>Cosmétiques</option>
					<option value="cuisine" <?= $formThemeSelected[3] ?>>Cuisine</option>
					<option value="produit_menagers" <?= $formThemeSelected[4] ?>>Produits ménagers</option>
				</select><br />
				<?= isset($err_theme) ?  $err_theme : "" ?>
			</div>
			<label>
				Photo présentation :
			</label>
			<input type="file" name="photopresentation" />
			<?= isset($err_photo) ?  $err_photo : "" ?>
		</div>
		<div id="sous-titre">


			<div class="droite">
				<div class="titre-h1">
					<label>
						<h1>Titre Tuto :</h1>
					</label>
					<input type="text" name="titretuto" value="<?= $titretuto ?>" /><br />
					<?= isset($err_titre) ?  $err_titre : "" ?>

				</div>

				<div class="titre-date">
					<?php echo date('d/m/Y') ?>
				</div>

				<div class="premier">
					<label>
						Présentation :
					</label>
					<textarea name="textpresentation" rows="3" cols="33"><?= $textpresentation ?>
					</textarea><br />
					<?= isset($err_textepresentation) ?  $err_textepresentation : "" ?>

				</div>

				<div class="liste">
					<label>
						<p class="titre-materiel">Matériel nécessaire :</p>
					</label>

					<ul>
						<li>
							<input type="text" name="Materiel_1" value="<?= $Materiel_1 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_1" value="<?= $quantite_1 ?>" placeholder="Quantité" />
						</li>

						<li>
							<input type="text" name="Materiel_2" value="<?= $Materiel_2 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_2" value="<?= $quantite_2 ?>" placeholder="Quantité" />
						</li>

						<li>
							<input type="text" name="Materiel_3" value="<?= $Materiel_3 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_3" value="<?= $quantite_3 ?>" placeholder="Quantité" />
						</li>

						<li>
							<input type="text" name="Materiel_4" value="<?= $Materiel_4 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_4" value="<?= $quantite_4 ?>" placeholder="Quantité" />
						</li>


						<li>
							<input type="text" name="Materiel_5" value="<?= $Materiel_5 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_5" value="<?= $quantite_5 ?>" placeholder="Quantité" />
						</li>

						<li>
							<input type="text" name="Materiel_6" value="<?= $Materiel_6 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_6" value="<?= $quantite_6 ?>" placeholder="Quantité" />
						</li>

						<li>
							<input type="text" name="Materiel_7" value="<?= $Materiel_7 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_7" value="<?= $quantite_7 ?>" placeholder="Quantité" />
						</li>

						<li>
							<input type="text" name="Materiel_8" value="<?= $Materiel_8 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_8" value="<?= $quantite_8 ?>" placeholder="Quantité" />
						</li>

						<li>
							<input type="text" name="Materiel_9" value="<?= $Materiel_9 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_9" value="<?= $quantite_9 ?>" placeholder="Quantité" />
						</li>


						<li>
							<input type="text" name="Materiel_10" value="<?= $Materiel_10 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_10" value="<?= $quantite_10 ?>" placeholder="Quantité" />
						</li>

						<li>
							<input type="text" name="Materiel_11" value="<?= $Materiel_11 ?>" placeholder="Nom du materiel" /> <input type="text" name="quantite_11" value="<?= $quantite_11 ?>" placeholder="Quantité" />
						</li>
					</ul>
					<?= isset($err_materiel) ?  $err_materiel : "" ?>


				</div>
			</div>
		</div>

		<div class="couleur">
			<?php echo "<img class='image' src='image/$image_et'	alt='grand-titre'/></a></p>" ?>
		</div>

		<div id="etape">
			<div class="num1">
				<p>
					<label>
						Photo Etape 1 :
					</label>

					<input type="file" name="PhotoEtape1" />
				</p>
				<p>
					<label>
						Texte Etape 1 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape1"><?= $TexteEtape1 ?></textarea>
				</p>
			</div>

			<div class="num2">
				<p>
					<label>
						Photo Etape 2 :
					</label>

					<input type="file" name="PhotoEtape2" />
				</p>
				<p>
					<label>
						Texte Etape 2 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape2"><?= $TexteEtape2 ?></textarea>
				</p>
			</div>

			<div class="num3">
				<p>
					<label>
						Photo Etape 3 :
					</label>

					<input type="file" name="PhotoEtape3" />
				</p>
				<p>
					<label>
						Texte Etape 3 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape3"><?= $TexteEtape3 ?></textarea>
				</p>
			</div>

			<div class="num4">
				<p>
					<label>
						Photo Etape 4 :
					</label>

					<input type="file" name="PhotoEtape4" />
				</p>
				<p>
					<label>
						Texte Etape 4 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape4"><?= $TexteEtape4 ?></textarea>
				</p>
			</div>


			<div class="num5">
				<p>
					<label>
						Photo Etape 5 :
					</label>

					<input type="file" name="PhotoEtape5" />
				</p>
				<p>
					<label>
						Texte Etape 5 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape5"><?= $TexteEtape5 ?></textarea>
				</p>
			</div>

			<div class="num6">
				<p>
					<label>
						Photo Etape 6 :
					</label>

					<input type="file" name="PhotoEtape6" />
				</p>
				<p>
					<label>
						Texte Etape 6 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape6"><?= $TexteEtape6 ?></textarea>
				</p>
			</div>

			<div class="num7">
				<p>
					<label>
						Photo Etape 7 :
					</label>

					<input type="file" name="PhotoEtape7" />
				</p>
				<p>
					<label>
						Texte Etape 7 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape7"><?= $TexteEtape7 ?></textarea>
				</p>
			</div>

			<div class="num8">
				<p>
					<label>
						Photo Etape 8 :
					</label>

					<input type="file" name="PhotoEtape8" />
				</p>
				<p>
					<label>
						Texte Etape 8 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape8"><?= $TexteEtape8 ?></textarea>
				</p>
			</div>

			<div class="num9">
				<p>
					<label>
						Photo Etape 9 :
					</label>

					<input type="file" name="PhotoEtape9" />
				</p>
				<p>
					<label>
						Texte Etape 9 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape9"><?= $TexteEtape9 ?></textarea>
				</p>
			</div>

			<div class="num10">
				<p>
					<label>
						Photo Etape 10 :
					</label>

					<input type="file" name="PhotoEtape10" />
				</p>
				<p>
					<label>
						Texte Etape 10 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape10"><?= $TexteEtape10 ?></textarea>
				</p>
			</div>

			<div class="num11">
				<p>
					<label>
						Photo Etape 11 :
					</label>

					<input type="file" name="PhotoEtape11" />
				</p>
				<p>
					<label>
						Texte Etape 11 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape11"><?= $TexteEtape11 ?></textarea>
				</p>
			</div>

			<div class="num12">
				<p>
					<label>
						Photo Etape 12 :
					</label>

					<input type="file" name="PhotoEtape12" />
				</p>
				<p>
					<label>
						Texte Etape 12 :
					</label>

					<textarea class="texteEtape" type="text" name="TexteEtape12"><?= $TexteEtape12 ?></textarea>
				</p>
			</div>
			<?= isset($err_etape) ?  $err_etape : "" ?>


		</div>

		<input type="submit" name="fichier" value="Envoyer les fichiers" />
		</p>
	</form>

</body>

</html>

<?php
include 'bas.php';
?>
