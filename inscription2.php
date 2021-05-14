<?php
//page d'inscription 
require_once("fonctionBD.php");


//on regarde si un formulaire a été envoyé avec la méthode POST 
if (!empty($_POST)) {
    extract($_POST);
    $valid = (bool) true;

    if (isset($_POST['inscription'])) {
//on récupere toutes les valeurs du formulaire d'inscription 
        $pseudo = (string) trim($pseudo);
        $email = (string) strtolower(trim($email));
        $mdp = (string) trim($mdp);
        $nom = (string) trim($nom);
        $prenom = (string) trim($prenom);
        $typeinscription = (string) trim($typeinscription);
        $optionPaiement = (string) trim($optionPaiement);
//on fait des vérifications pour voir si tout ce qui a été saisi est correct, sinon on créé des messages d'erreur
        if (empty($pseudo)) {
            $valid = false;
            $err_pseudo = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
        } else {
            $req = $bdd->query("SELECT idutilisateur FROM utilisateur WHERE pseudo = ?", array($pseudo));
            $utilisateur = $req->fetch();
            if (isset($utilisateur['idutilisateur'])) {
                $valid = false;
                $err_pseudo = "<p style=\"color:#FF0000\";>Ce pseudo existe déjà !</p>";
            }
        }

        if (empty($email)) {
            $valid = false;
            $err_email = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
        } else {
            $req = $bdd->query("SELECT idutilisateur FROM utilisateur WHERE email = ?", array($email));
            $utilisateur = $req->fetch();
            if (isset($utilisateur['idutilisateur'])) {
                $valid = false;
                $err_mail = "<p style=\"color:#FF0000\";>Ce mail existe déjà !</p>";
            }
        }

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

        if (empty($nom)) {
            $valid = false;
            $err_nom = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
        }

        if (empty($prenom)) {
            $valid = false;
            $err_prenom = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
        }

        if (empty($theme)) {
            $valid = false;
            $err_theme = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
        }

        if (empty($datenaissance)) {
            $valid = false;
            $err_datenaissance = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
        }
        if (empty($typeinscription)) {
            $valid = false;
            $err_typeinscription = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
        }
//si tout ce qui a été saisi est correct, on ajoute l'utilisateur à la base 
        if ($valid) {
            $mdp = crypt($mdp, '$6$rounds=5000$14ecoaj87enek720LEPuy62m3h5FedXa$');
            $req = $bdd->insert("INSERT INTO utilisateur (themeFavorie, nom, prenom,email,mdp,pseudo,datenaissance) VALUES (?, ?, ?, ?, ?,?,?)", array($theme, $nom, $prenom, $email, $mdp, $pseudo, $datenaissance));


//on récupère l'id de l'utilisateur 
            $req = $bdd->query("SELECT idutilisateur FROM utilisateur where email=?", array($email));
            $utilisateur = $req->fetch();
            $idutilisateur = $utilisateur['idutilisateur'];
            $req->closecursor();

            $date = date("Y-m-d");
            if (!empty($optionPaiement)) {
                $req = $bdd->insert("INSERT INTO souscrire(idabonnement,idutilisateur,typePaiement,dateDebut) VALUES(?,?,?,?)", array($typeinscription, $idutilisateur, $optionPaiement, $date));
            } else {
                $req = $bdd->insert("INSERT INTO souscrire(idabonnement,idutilisateur,dateDebut) VALUES(?,?,?)", array($typeinscription, $idutilisateur, $date));
            }
            header('Location: index.php');
            exit;
        }
    }
}
$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='titre-3.jpg'");
$tuto = $req->fetch();
$image = $tuto['chemin'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Inscription</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" media="all" href="style-3.css">
</head>

<body>
    <div class="titre1">
        <?php echo "<img class='titre' src='image/$image'	alt='présentation'/></a></p>" ?>
    </div>
    <div class="blanc">
        <div class="PageInscription">
            <div class="titre-gd-h1">
                <h1>Inscription</h1>
            </div>
            <p class="ConnexionInscription">
                Vous avez déjà un compte ?
                <a class="lien-ins" href="index.php">Connectez-vous ! </a>
            </p>
            <div class="inscriptionI">
                <form method="post" action="inscription2.php">

                    <p>
                        <label>
                            Nom :
                        </label>
                        <?php
                        if (isset($err_nom)) {
                            echo $err_nom;
                        }
                        ?>
                        <input class="champ2" type="text" id="nom" name="nom" placeholder="Dupont" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" required>
                    </p>

                    <p>
                        <label>
                            Prénom :
                        </label>
                        <?php
                        if (isset($err_prenom)) {
                            echo  $err_prenom;
                        }
                        ?>
                        <input class="champ2" type="text" id="prenom" name="prenom" placeholder="José" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" required>
                    </p>

                    <?php
                    if (isset($err_datenaissance)) {
                        echo $err_datenaissance;
                    }
                    ?>
                    <label>Date de naissance : </label>
                    <input class="champ2" type="date" name="datenaissance">
                    </input>
                    </p>



                    <p>
                        <label>
                            Adresse mail :
                        </label>
                        <?php
                        if (isset($err_email)) {
                            echo $err_email;
                        }
                        ?>
                        <input class="champ2" type="email" id="email" name="email" placeholder="XXX@XXX.XXX">
                    </p>

                    <p>
                        <label>
                            Pseudo :
                        </label>
                        <?php
                        if (isset($err_pseudo)) {
                            echo $err_pseudo;
                        }
                        ?>
                        <input class="champ2" type="text" id="pseudo" name="pseudo" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+">
                    </p>

                    <p>
                        <label>
                            Mot de passe :
                        </label>
                        <?php
                        if (isset($err_mdp)) {
                            echo $err_mdp;
                        }
                        ?>
                        <input class="champ2" type="password" id="mdp" name="mdp" pattern="(?=.*[\.\-\+\*\/\!\?])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,100}">
                        doit comporter minimum 6 caractères dont au moins un caractère spécial et une majuscule.
                    </p>

                    <p>
                        <label>
                            Confirmez votre mot de passe :
                        </label>
                        <?php
                        if (isset($err_mdp2)) {
                            echo $err_mdp2;
                        }
                        ?>
                        <input class="champ2" type="password" id="mdp2" name="mdp2">
                    </p>
                    <p>
                        <label>
                            Quel est votre thème favori ?
                        </label>
                        <?php
                        if (isset($err_theme)) {
                            echo $err_theme;
                        }
                        ?>
                        <select name='theme' class="champ2">
                            <option value='couture'>Couture </option>
                            <option value='decoration'>Décoration </option>
                            <option value='cosmetique'>Cosmétiques</option>
                            <option value='cuisine'>Cuisine </option>
                            <option value='produit_menager'>Produits Ménagers </option>
                        </select>
                    </p>

                    <label>
                        Je souhaite m'inscrire à :
                    </label>
                    <br />
                    <input type="radio" class="versionGratuite" id="typeinscription1" name="typeinscription" value="1" onchange="versionPayante.disabled='disabled' "> La version standard : Vous n'aurez accès qu'à une partie des tutos</span><br />
                    <input type="radio" class="versionPayante" id="typeinscription2" name="typeinscription" value="3" onchange="versionPayante.disabled=''">La version premium : Vous aurez accès à l'ensemble des tutos du site</span>

                    <?php
                    if (isset($err_typeinscription)) {
                        echo $err_typeinscription;
                    }
                    ?>
                    <div class="versionPayante">
                        <fieldset id="versionPayante" disabled="" class="encad1">
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
                        </fieldset>
                    </div>
                    <input type="submit" value="Je m'inscris" name="inscription" class="BoutonInsc">

                </form>
            </div>
        </div>
        <br />
    </div>
    <div class="titre1">
        <?php echo "<img class='titre' src='image/$image'	alt='présentation'/></a></p>" ?>
    </div>
</body>

</html>
