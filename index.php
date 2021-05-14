<?php
//page de connexion au site
require_once("fonctionBD.php");

//on récupère l'image d'accueil
$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='titre-3.jpg'");
$tuto = $req->fetch();
$image = $tuto['chemin'];


//on créé une fonction pour vérifier que le mot de passe rentré est bien celui qui est dans la base mais crypté 
function verifyMdp($bdd, $idenfiant, $mdp)
{
	$req = "SELECT * FROM utilisateur WHERE email = ? ";
	$reqUser = $bdd->query($req, [$idenfiant]);
	$userexist = $reqUser->rowCount();

	if ($userexist == 0) {
		return false;
	}

	$requser = $bdd->query("SELECT * FROM utilisateur WHERE email = ?", array($idenfiant));

	$userinfo = $requser->fetch();
	if (password_verify($mdp, $userinfo['mdp'])) {
		return true;
	}
	return false;
}
//on vérifie que le formulaire de connexion a été envoyé
if (isset($_POST['connexion'])) {
	$mailconnect = htmlspecialchars($_POST['identifiant']);
	$mdpconnect = htmlspecialchars($_POST['mdp']);
//on vérifie que les champs à saisir ne sont pas vides 
	if (!empty($mailconnect) and !empty($mdpconnect)) {
//si le mot de passe est correct, on connecte l'utilisateur
		if (verifyMdp($bdd, $mailconnect, $mdpconnect)) {
//on récupère les infos de l'utilisateur pour pouvoir les réutiliser dans d'autres pages 
			$requser = $bdd->query("SELECT * FROM utilisateur WHERE email = ?", array($mailconnect));
			$userinfo = $requser->fetch();

			$_SESSION['id'] = $userinfo['idutilisateur'];
			$_SESSION['pseudo'] = $userinfo['pseudo'];
			$_SESSION['mail'] = $userinfo['email'];

			header("Location: projet.php");
		}
//sinon on affiche les erreurs 
		else {
			$erreur = "Mauvais mail ou mot de passe !";
		}
	} else {
		$erreur = "Tous les champs doivent être complétés !";
	}
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Connexion</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" media="all" href="style-3.css">
</head>

<body>
	<div class="titre1">
		<?php echo "<img class='titre' src='image/$image'	alt='présentation'/></a></p>" ?>
	</div>

	<div class="blanc">
		<div class="titre-gd-h1">
			<h1>
				Se connecter
			</h1>
		</div>
		<div class="tableau-index">
			<div class="inscriptionC">
				<h2>
					Pas encore de compte?</h2>
				<a class="lien-ins" href='inscription2.php'>
					Inscrivez-vous !
				</a>
			</div>
			<div class="connexion">
				<h2 class="motconnexion">
					Connexion
				</h2>
				<form method="post" action="index.php">
					<div class="espace">
						<p><label>
								Adresse-mail :
							</label>
							<input type="email" id="identifiant" name="identifiant" required>
						</p>
					</div>
					<div class="espace">
						<p><label>
								Mot de passe :
							</label>
							<input type="password" id="mdp" name="mdp" required>
						</p>
					</div>
					<div class="espace">
						<a class="lien-ins" href="recuperation.php">
							Mot de passe oublié ?
						</a>
						<br />
					</div>
					<input type="submit" name="connexion" value=" Se connecter" class="BoutonConn">
					<?php
					if (isset($erreur)) {
						echo $erreur;
					}
					?>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
