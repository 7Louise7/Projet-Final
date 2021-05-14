<?php
//page qui permet de changer d'abonnement (du standard vers le premium)
include("fil.php");
include_once("fonctionBD.php");

if (!empty($_POST)) {
    extract($_POST);
    $valid = (bool) true;
//on regarde si l'utilisateur a envoyé un formulaire pour changer d'abonnement
    if (isset($_POST['premium'])) {
        $optionPaiement = (string) trim($optionPaiement);
        if (empty($optionPaiement)) {
            $valid = false;
            $err_paiment = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
        }
//si toutes les valeurs ont été saisies, on change l'abonnement de l'utilisateur en premium donc en 3
        if ($valid) {
            $req = $bdd->query("UPDATE souscrire SET idabonnement=?, typePaiement=? where idutilisateur=?", array(3, $optionPaiement, $_SESSION['id']));
            header("location:profil.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Changement d'abonnement</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" media="all" href="style-3.css">
</head>

<body>
    <div class="titre-gd-h1">
        <h1>S'inscrire à la version payante</h1>
    </div>
    <form method="POST" action="premium.php">
        <div class="versionPayante2">

            <label>
                Option de paiement :
            </label>
            <input type="radio" id="option1" value="paypal" name="optionPaiement" onchange="CB.disabled='disabled'">Paypal
            <input type="radio" id="option2" value="cb" name="optionPaiement" onchange="CB.disabled=''">Carte Bancaire

            <fieldset id="CB" disabled="" class="encad2">
                <label>
                    Nom :
                </label>
                <input class="champ" type="text" placeholder="Dupont" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+">
                <label>
                    Prénom :
                </label>
                <input class="champ" type="text" placeholder="José" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+">
                <br />
                <label>
                    Numéro de carte :
                </label>
                <input class="champ" type="text" id="NumeroCarte" name="NumeroCarte" placeholder="XXXX XXXX XXXX XXXX " pattern="[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}">
                <br />
                <label>
                    Date d'expiration :
                </label>
                <input class="champ" type="text" id="DateExpiration" name="cleSecurite" placeholder="XX/XX" pattern="[0-9]{2}\/[0-9]{2}">
                <br />
                <label>
                    Clé de sécurité :
                </label>
                <input class="champ" type="text" id="cleSecurite" name="cleSecurite" pattern="[0-9]{3}" placeholder="XXX">
            </fieldset>
            <?php
            if (isset($err_paiment)) {
                echo $err_paiment;
            }
            ?>
            <input type="submit" value="Valider mon nouvel abonnement premium" name="premium" class="BoutonInsc2">
        </div>
    </form>
</body>

</html>
<?php

include("bas.php");
?>
