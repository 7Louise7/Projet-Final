<?php
require_once("fonctionBD.php");
//cette page permet à l'utilisateur de changer son mot de passe s'il l'a oublié

//on recupere la photo d'accueil
$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='titre-3.jpg'");
$tuto = $req->fetch();
$image = $tuto['chemin'];

if (!empty($_POST)) {
    extract($_POST);
    $valid = (bool) true;
//on verifie que les valeurs saisies par l'utilisateur sont correctes, sinon on créé un message d'erreur
    if (empty($mdp)) {
        $valid = false;
        $err_mdp = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
    }
    if (empty($mdp2)) {
        $valid = false;
        $err_mdp2 = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
    }
    if ($mdp2 != $mdp) {
        $valid = false;
        $err_mdp2 = "<p style=\"color:#FF0000\";>vos mots de passe doivent etre identique!</p>";
    }
    if (empty($email)) {
        $valid = false;
        $err_email = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
    }
//si tout est bon, on ajoute le nouveau mot de passe dans la base et on renvoie l'utilisateur sur la page de connexion
    if ($valid) {
        $mdp = crypt($mdp, '$6$rounds=5000$14ecoaj87enek720LEPuy62m3h5FedXa$');
        $req = $bdd->query("UPDATE utilisateur SET mdp=? where email=?", array($mdp, $email));
        header("location:index.php");
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<!-- formulaire pour rentrer des nouveaux tutos
-->

<head>
    <title>Changement de mot de passe</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" media="all" href="style-3.css">

</head>

<body>

    <div class="titre1">
        <?php echo "<img class='titre' src='image/$image'	alt='présentation'/></a></p>" ?>
    </div>
    <div class="recupMDP">
        <div class="titre-gd-h1">
            <h1>Changement de mot de passe</h1>
        </div>
        <div class="formulaireRecupMDP">
            <form action="recuperation.php" method="post">
                <p>
                    <label>
                        Adresse-mail :
                    </label>
                    <?php
                    if (isset($err_email)) {
                        echo $err_email;
                    }
                    ?>
                    <input type="email" id="email" name="email" placeholder="XXX@XXX.XXX">
                </p>
                <p>
                    <label>
                        Nouveau mot de passe :
                    </label>
                    <?php
                    if (isset($err_mdp)) {
                        echo $err_mdp;
                    }
                    ?>
                    <input type="password" id="mdp" name="mdp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
                    doit comporter minimum 6 caractères dont au moins un caractère spécial et une majuscule.
                </p>

                <p>
                    <label>
                        Confirmez votre mot nouveau mot de passe :
                    </label>
                    <?php
                    if (isset($err_mdp2)) {
                        echo $err_mdp2;
                    }
                    ?>
                    <input type="password" id="mdp2" name="mdp2">
                    <input type="submit" name="recupmdp" value="Valider votre nouveau mot de passe" class="BoutonRecup" />
                </p>
            </form>
        </div>
    </div>

</html>
