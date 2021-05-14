<?php
//page de profil de l'utilisateur qui lui permet de visualiser certains avantages premium, s'il l'est, ainsi que ses informations personnelles, qu'il peut modifier 
include("fil.php");
include_once("fonctionBD.php");

//on verifie que l'id de l'utilisateur est correct
if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
   $getid = intval($_SESSION['id']);
//on récupère toutes les infos de l'utilisateur 
   $requser = $bdd->query('SELECT utilisateur.*, DATE_FORMAT(utilisateur.dateNaissance, "%d/%m/%Y") as dateNais FROM utilisateur WHERE idutilisateur = ?', array($getid));
   $userinfo = $requser->fetch();
}

if (!empty($_POST)) {
   extract($_POST);
   $valid = (bool) true;

//on regarde si un nouveau theme favori a été saisi, si oui, on le change dans la base 
   if (isset($_POST['newt'])) {
      if (!empty($theme)) {
         $req = $bdd->query("UPDATE utilisateur SET themefavorie=? where email=?", array($theme, $userinfo['email']));
      } else {
         $err_theme = "<p style=\"color:#FF0000\";>Vous n'avez pas saisie de nouveau theme !</p>";
      }
   }

//on regarde si un nouveau pseudo a été saisi 
   if (isset($_POST['newp'])) {
      if (!empty($pseudo)) {
         $req = $bdd->query("SELECT idutilisateur FROM utilisateur WHERE pseudo = ?", array($pseudo));
         $utilisateur = $req->fetch();
//on vérifie que le pseudo n'est pas déjà attribué 
         if (isset($utilisateur['idutilisateur'])) {
            $err_pseudo = "<p style=\"color:#FF0000\";>Ce pseudo existe déjà !</p>";
         }
//si tout est bon, on échange l'ancien pseudo avec le nouveau    
         else {
            $req = $bdd->query("UPDATE utilisateur SET pseudo=? where email=?", array($pseudo, $userinfo['email']));
         }
      } else {
         $err_pseudo = "<p style=\"color:#FF0000\";>Vous n'avez pas saisie de nouveau pseudo !</p>";
      }
   }
}

if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
   $getid = intval($_SESSION['id']);
   $requser = $bdd->query('SELECT u.*, s.* FROM souscrire s, utilisateur u WHERE s.idutilisateur = u.idutilisateur AND u.idutilisateur = ?', array($getid));
   $userpro = $requser->fetch();
}

//on recupere les images du calendrier dans la base qui seront affichées vers le bas de la page si l'utilisateur est premium 
$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='calendrier-idee.jpg'");
$tuto = $req->fetch();
$image = $tuto['chemin'];

$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='IMG-4337.jpg'");
$tuto = $req->fetch();
$image_1 = $tuto['chemin'];

$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='IMG-4339.jpg'");
$tuto = $req->fetch();
$image_2 = $tuto['chemin'];

$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='IMG-4340.jpg'");
$tuto = $req->fetch();
$image_3 = $tuto['chemin'];

$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='IMG-4341.jpg'");
$tuto = $req->fetch();
$image_4 = $tuto['chemin'];

$req = $bdd->query("SELECT p.* FROM photo p WHERE p.chemin='IMG-4338.jpg'");
$tuto = $req->fetch();
$image_5 = $tuto['chemin'];


?>

<!DOCTYPE html>
<html lang="fr">

<head>
   <title>Homemade - PROFIL</title>
   <meta charset="UTF-8">
   <link href="style-3.css" rel="stylesheet">
</head>

<body>
   <div align="center" class="profil">
      <div class="titre-gd-h1">
         <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
      </div>
      <div class="tableau-profil">
         <div class="infoperso">
            <h3>Informations personnelles</h3>
            <p>
            <p>Nom : <?php echo $userinfo['nom']; ?></p>

            <p>Prénom : <?php echo $userinfo['prenom']; ?></p>

            <p>Date de naissance : <?php echo $userinfo['dateNais']; ?></p>

            Pseudo : <?php echo $userinfo['pseudo']; ?></p>

            <p>Mail : <?php echo $userinfo['email']; ?></p>

            <p>Thème favori : <?php echo $userinfo['themefavorie']; ?></p>
            </p>
         </div>
         <div class="operations">
            <h3>Opérations sur mon compte</h3>
            <div class="deconnexion">
               <?php
               if (isset($_SESSION['id']) and $userinfo['idutilisateur'] == $_SESSION['id']) {
               ?>
                  <p><a class="lien-deconnex" href="deconnexion.php">Se déconnecter</a></p>
               <?php
               }
               ?>
               <form method='post' action='profil.php'>
                  <p class="ope-espace">
                  <p class="ope-titre"><label>Changer mon pseudo :</label></p>
                  <?php
                  if (isset($err_pseudo)) {
                     echo $err_pseudo;
                  }
                  ?>
                  <p><input type="text" id="pseudo" name="pseudo" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+"></p>
                  <p><input type="submit" class="lien-ins" value="Valider mon nouveau pseudo" name="newp"></p>
                  </p>

                  <p class="ope-espace">
                  <p class="ope-titre"><label>Changer mon thème favori :</label></p>
                  <?php
                  if (isset($err_theme)) {
                     echo $err_theme;
                  }
                  ?>
                  <p>
                     <select name='theme' class="champ2">
                        <option value='couture'>Couture </option>
                        <option value='decoration'>Décoration </option>
                        <option value='cosmetique'>Cosmétiques</option>
                        <option value='cuisine'>Cuisine </option>
                        <option value='produit_menager'>Produits Ménagers </option>
                     </select>
                  </p>
                  <p><input type="submit" class="lien-ins" value="Valider mon nouveau thème favori" name="newt"></p>
                  </p>
               </form>
            </div>
            <form method="post" action="supression.php">
               <p><input type="submit" value="Supprimer mon compte" name="supression" class="BoutonSupp"></p>
            </form>
         </div>
      </div>
   </div>
   <?php
   if (isset($_SESSION['id']) and $userpro['idabonnement'] == 3 and $userinfo['idutilisateur'] == $_SESSION['id']) {
   ?>
      <div class="couleur-beige">
         <p class="comm-1">Tips pour devenir plus écolos </p>
         <p class="comm-2">Un calendrier : </p>
         <p><?php echo "<img class='img-calendrier' src='image/$image'	alt='calendrier-prenium'/></a></p>" ?></p>
         <p class="comm-2">Thème de semainier à imprimer : </p>
         <div class="tableau-semainier">
            <table>
               <tr>
                  <td><?php echo "<img class='img-theme-semainier' src='image/$image_1'	alt='présentation'/></a></p>" ?></td>
                  <td><?php echo "<img class='img-theme-semainier' src='image/$image_2'	alt='présentation'/></a></p>" ?></td>
               </tr>
               <tr>
                  <td><?php echo "<img class='img-theme-semainier' src='image/$image_3'	alt='présentation'/></a></p>" ?></td>
                  <td><?php echo "<img class='img-theme-semainier' src='image/$image_4'	alt='présentation'/></a></p>" ?></td>
               </tr>
               <tr>
                  <td><?php echo "<img class='img-theme-semainier' src='image/$image_5'	alt='présentation'/></a></p>" ?></td>
                  <td>
                     <div class="texte-semainier">
                        <p>Petite info pour toi :</p>
                        <p>Pour enregistrer la photo puis l'impimer clique-droit sur celle-ci puis enregistre la sur ton ordinateur !</p>
                     </div>
                  </td>
               </tr>
            </table>
         </div>
      </div>
   <?php
   } else {
   ?>
      <a class="comm-3" href="premium.php">
         <p class="comm-1">Pour accéder à d'autres options, insrivez vous à la version payante ! <br />Cliquez ici :) </p>
      </a>
   <?php
   }
   ?>

</body>

</html>
<?php

include("bas.php")
?>
