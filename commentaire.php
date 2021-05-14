<?php
//page qui affiche tous les commentaires ou seulement ceux de certains tutos. Elle permet aussi de poster un commentaire 

include_once("fonctionBD.php");

include('fil.php');

//on récupère tous les commentaires de la base pour pouvoir les afficher dès que l'utilisateur arrive sur la page commentaire 
$req_commentaire = $bdd->query("SELECT c.*, u.*, t.titreTuto, DATE_FORMAT(c.dateCommentaire, 'Le %d/%m/%Y') as date_c FROM commentaire c, utilisateur u, tuto t WHERE c.idutilisateur = u.idutilisateur AND t.idtuto = c.idtuto ORDER BY C.dateCommentaire DESC");

$req_commentaire = $req_commentaire->fetchAll();

if (!empty($_POST)) {
    extract($_POST);
    $valid = true;
//on affiche les commentaires en fonction de ce que l'utilisateur a coché
    if (isset($_POST['affiche'])) {
        if ($idtuto2 == 'tous') {
            $req_commentaire = $bdd->query("SELECT c.*, u.*, t.titreTuto, DATE_FORMAT(c.dateCommentaire, 'Le %d/%m/%Y') as date_c FROM commentaire c, utilisateur u, tuto t WHERE c.idutilisateur = u.idutilisateur AND t.idtuto = c.idtuto  ORDER BY C.dateCommentaire DESC");

            $req_commentaire = $req_commentaire->fetchAll();
        } else {
            $req_commentaire = $bdd->query("SELECT c.*, u.*, t.titreTuto, DATE_FORMAT(c.dateCommentaire, 'Le %d/%m/%Y') as date_c FROM commentaire c, utilisateur u, tuto t WHERE c.idutilisateur = u.idutilisateur AND t.idtuto = c.idtuto AND c.idtuto=? ORDER BY C.dateCommentaire DESC", array($idtuto2));

            $req_commentaire = $req_commentaire->fetchAll();
        }
    }
//on ajoute un commentaire dans la base 
    if (isset($_POST['ajout-commentaire'])) {
        $contenucom = (string) trim($contenucom);
//on verifie ce qui a été saisi
        if (empty($contenucom)) {
            $valid = false;
            $er_commentaire = "Il faut écrire un commentaire";
        } elseif (iconv_strlen($contenucom, 'UTF-8') <= 3) {
            $valid = false;
            $er_commentaire = "Il faut mettre plus de 3 caractères";
        }

        $contenucom = (string) trim($contenucom);
//si ce qui a été saisi est correct, on l'ajoute dans la base 
        if ($valid) {
            $dateCommentaire = date("Y-m-d");
            $req = $bdd->insert("INSERT INTO commentaire (note_com, dateCommentaire, contenucom, idutilisateur,idtuto) VALUES ( ?, ?, ?, ?,?)", array($note_com, $dateCommentaire, $contenucom, $_SESSION['id'], $idtuto));
            header('Location: commentaire.php');


            exit;
        }
    }
}


?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Homemade - Commentaire</title>
    <meta charset="UTF-8">
    <link href="style-3.css" rel="stylesheet">
</head>

<body>

    <div class="acceuil">
        <div class="titre-gd-h1">
            <h1>Commentaires : </h1>
        </div>

        <div class="commentaire-g">

            <p class="comm-1">Donnez-nous votre avis </p>

            <form method="post" action="commentaire.php" class="formulaireSuggestions">

                <p class="titre-comm"><label>Nom du tuto :</label></p>
                <div class="commentaire">
                    <?php
                    //on cherche a connaitre l'abonnement de l'utilisateur
                    $req = $bdd->query("SELECT idabonnement from souscrire where idutilisateur=?", array($_SESSION['id']));
                    $abonnement = $req->fetch();
                    //s'il est premium, il peut laisser des commentaires sur tous les tutos, donc on affiche tous les tutos dans le select
                    if ($abonnement['idabonnement'] == 3) {
                        echo "<select name='idtuto'>";
                        $req = $bdd->query("SELECT titreTuto, idtuto,theme FROM tuto ORDER BY theme");
                        while ($tuto = $req->fetch()) {
                            $themetuto2 = $tuto['theme'];
                            if ($themetuto2 !== $themetuto and !empty($themetuto)) {
                                echo "</optgroup>";
                                echo "<optgroup label='$themetuto2'>";
                                $titreTuto = $tuto['titreTuto'];
                                $idtuto = $tuto['idtuto'];
                                echo "<option value='$idtuto'>$titreTuto</option>";
                                $themetuto = $tuto['theme'];
                            } elseif ($themetuto2 == $themetuto and !empty($themetuto)) {
                                $titreTuto = $tuto['titreTuto'];
                                $idtuto = $tuto['idtuto'];
                                $themetuto = $tuto['theme'];
                                echo "<option value='$idtuto'>$titreTuto</option>";
                            } else {
                                $titreTuto = $tuto['titreTuto'];
                                $idtuto = $tuto['idtuto'];
                                $themetuto = $tuto['theme'];
                                echo "<optgroup label='$themetuto2'>";
                                echo "<option value='$idtuto'>$titreTuto</option>";
                            }
                        }
                        echo "</optgroup>";
                        echo "</select>";
                    }
                    //sinon il peut laisser des commentaires que sur les tutos standards dont l'id abonnement est 1
                    else {
                        echo "<select name='idtuto'>";
                        $req = $bdd->query("SELECT titreTuto, idtuto,theme FROM tuto where idabonnement=1 ORDER BY theme");
                        while ($tuto = $req->fetch()) {
                            $themetuto2 = $tuto['theme'];
                            if ($themetuto2 !== $themetuto and !empty($themetuto)) {
                                echo "</optgroup>";
                                echo "<optgroup label='$themetuto2'>";
                                $titreTuto = $tuto['titreTuto'];
                                $idtuto = $tuto['idtuto'];
                                echo "<option value='$idtuto'>$titreTuto</option>";
                                $themetuto = $tuto['theme'];
                            } elseif ($themetuto2 == $themetuto and !empty($themetuto)) {
                                $titreTuto = $tuto['titreTuto'];
                                $idtuto = $tuto['idtuto'];
                                $themetuto = $tuto['theme'];
                                echo "<option value='$idtuto'>$titreTuto</option>";
                            } else {
                                $titreTuto = $tuto['titreTuto'];
                                $idtuto = $tuto['idtuto'];
                                $themetuto = $tuto['theme'];
                                echo "<optgroup label='$themetuto2'>";
                                echo "<option value='$idtuto'>$titreTuto</option>";
                            }
                        }
                        echo "</optgroup>";
                        echo "</select>";
                    }

                    ?>
                </div>

                <p class="titre-comm"><label>Ma note :</label></p>
                <p class="commentaire">
                    <input type="radio" name="note_com" value="1" />1
                    <input type="radio" name="note_com" value="2" />2
                    <input type="radio" name="note_com" value="3" />3
                    <input type="radio" name="note_com" value="4" />4
                    <input type="radio" name="note_com" value="5" />5
                </p>

                <p class="titre-comm"><label>Mon commentaire :</label></p>
                <p class="commentaire"><textarea class="texte-comm" name="contenucom"></textarea></p>

                <p class="envoi-comm"><input class="envoi-comm-style" name="ajout-commentaire" type="submit" value="Envoyer"></p>
            </form>

            <form method="post" action="commentaire.php" class="formulaireSuggestions">
                <div class="afficher-commentaire">
                    <p class="comm-1">Je souhaite voir les commentaires du tuto </p>
                    <div class="commentaire">
                        <?php
                        //les commentaires sur les tutos de type premium peuvent etre vus par tous le monde mais ils sont indiqués 
                        echo "<select name='idtuto2'>";
                        $req = $bdd->query("SELECT titreTuto, idtuto,theme,idabonnement FROM tuto ORDER BY theme");
                        while ($tuto2 = $req->fetch()) {
                            $themetuto2 = $tuto2['theme'];
                            $titreTuto2 = $tuto2['titreTuto'];
                            if ($tuto2["idabonnement"] == 3) {
                                $titreTuto2 = $titreTuto2 . "(premium)";
                            }
                            if ($themetuto2 !== $themetuto3 and !empty($themetuto3)) {
                                echo "</optgroup>";
                                echo "<optgroup label='$themetuto2'>";
                                $idtuto2 = $tuto2['idtuto'];
                                echo "<option value='$idtuto2'>$titreTuto2</option>";
                                $themetuto3 = $tuto2['theme'];
                            } elseif ($themetuto2 == $themetuto3 and !empty($themetuto3)) {
                                $idtuto2 = $tuto2['idtuto'];
                                $themetuto3 = $tuto2['theme'];
                                echo "<option value='$idtuto2'>$titreTuto2</option>";
                            } else {
                                $idtuto2 = $tuto2['idtuto'];
                                $themetuto3 = $tuto2['theme'];
                                echo "<optgroup label='$themetuto2'>";
                                echo "<option value='$idtuto2'>$titreTuto2</option>";
                            }
                        }
                        echo "</optgroup>";
                        echo "<option value='tous'>tous</option>";
                        echo "</select>"
                        ?>
                    </div>
                    <p class="envoi-comm"><input class="envoi-comm-style" name="affiche" type="submit" value="Afficher"></p>
                </div>

                <!-- on affiche les commentaires -->
                <table class="liste_commentaire">
                    <?php
                    foreach ($req_commentaire as $rc) {
                    ?>
                        <tr>
                            <td class="list_com_personne">
                                <?= "De " . $rc['pseudo'] ?>
                            </td>
                            <td class="list_com_tuto">
                                <?= " TUTO : " . $rc['titreTuto'] ?>
                            </td>
                            <td class="list_com_note">
                                <?= $rc['note_com'] . " / 5" ?>
                            </td>
                            <td class="list_com_contenu">
                                <?= $rc['contenucom'] ?>
                            </td>
                            <td class="list_com_date">
                                <?= $rc['date_c'] ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>

        </div>


    </div>


    <?php
    include('bas.php');
    ?>

</body>

</html>
