<?php

require_once("fonctionBD.php");

//cette page est le modèle de templates qui nous permet d'afficher tous les tutos qui sont dans la base 
$html = file_get_contents("tuto.html");

//fonction pour obtenir la moyenne des notes des commentaires
function moyenne($bdd, $idtuto)
{
	$req = $bdd->query("SELECT COUNT(*) as note from commentaire where idtuto=?", array($idtuto));
	$compte = $req->fetch();
	$req = $bdd->query("SELECT sum(note_com) as somme from commentaire where idtuto=?", array($idtuto));
	$somme = $req->fetch();
	if ($compte['note'] != 0) {
		return $somme['somme'] / $compte['note'];
	} else {
		return "Pas encore de note pour ce tuto";
	}
}

function http_redirect($url, $statusCode = 303)
{
	header('Location: ' . $url, true, $statusCode);
	die();
}

if ($html === false) {
	http_redirect("erreur.html");
	exit();
} else {

	$idTuto = $_GET['id'];





	$req = 'SELECT * FROM tuto t, etape e, photo p WHERE t.idtuto = e.idtuto AND e.idphoto = p.idphoto AND t.idtuto = ' . $idTuto;

	$data = $bdd->query($req);

	if ($data == NULL)
		die("Problème d'exécution de la requête \n");


	$titre_tuto = null;
	$date_tuto = null;
	$presentation_tuto = null;
	$liste_materiel = null;

	$htmlEtapes = "";
	$i = 1;
	while ($info = $data->fetch()) {

		$titre_tuto = $info['titreTuto'];
		$date_tuto = $info['dateCreation'];
		$presentation_tuto = $info['textpresentation'];



		$idEtape = $info['idetape'];
		$texteEtape = $info['texte'];

		$cheminPhoto = $info['chemin'];

		$htmlEtape = file_get_contents("tuto_etape.html");
		$htmlEtape = str_replace('[[idEtape]]', $i, $htmlEtape);
		$htmlEtape = str_replace('[[texte_etape]]', $texteEtape, $htmlEtape);
		$htmlEtape = str_replace('[[img_etape]]', $cheminPhoto, $htmlEtape);

		$htmlEtapes .= $htmlEtape;
		$i++;
	}


/// Materiel
	$req = "SELECT * FROM necessite n, materiel m WHERE n.idmateriel = m.idmateriel AND n.idtuto = $idTuto";
	$data = $bdd->query($req);

	if ($data == NULL)
		die("Problème d'exécution de la requête 2 \n");



	$htmlListeMateriels = "<ul>";
	while ($info = $data->fetch()) {
		$htmlListeMateriels .= '<li>' . $info['quantité'] . " " . $info['nommateriel'] . '</li>';
	}
	$htmlListeMateriels .= "<ul>";


/// IMAGE PRESENTATION TUTO : 

	$req = "SELECT tuto.idtuto, titreTuto, chemin FROM tuto, photo where tuto.idtuto = $idTuto AND tuto.idtuto=photo.idtuto";
	$data = $bdd->query($req);

	if ($data == NULL)
		die("Problème d'exécution de la requête 3 \n");

	while ($info = $data->fetch()) {
		$img_tuto = $info['chemin'];
	}

/// LOGO : 

	$req = "SELECT p.* FROM photo p WHERE p.chemin='titre-3.jpg'";
	$data = $bdd->query($req);

	if ($data == NULL)
		die("Problème d'exécution de la requête 4 \n");

	while ($info = $data->fetch()) {
		$logo = $info['chemin'];
	}

/// LOGO ETAPE : 

	$req = "SELECT p.* FROM photo p WHERE p.chemin='grand-titre-8.jpg'";
	$data = $bdd->query($req);

	if ($data == NULL)
		die("Problème d'exécution de la requête 5 \n");

	while ($info = $data->fetch()) {
		$img_logo_etape = $info['chemin'];
	}

//note du tuto 
	$htmlnotetuto = moyenne($bdd, $idTuto);

	$html = str_replace('[[logo]]', $logo, $html);
	$html = str_replace('[[img_logo_etape]]', $img_logo_etape, $html);
	$html = str_replace('[[img_tuto]]', $img_tuto, $html);
	$html = str_replace('[[titreTuto]]', $titre_tuto, $html);
	$html = str_replace('[[dateCreation]]', $date_tuto, $html);
	$html = str_replace('[[TextePresentation]]', $presentation_tuto, $html);
	$html = str_replace('[[ETAPES]]', $htmlEtapes, $html);
	$html = str_replace('[[ListeMateriel]]', $htmlListeMateriels, $html);
	$html = str_replace('[[notetuto]]', $htmlnotetuto, $html);

	echo $html;
}
