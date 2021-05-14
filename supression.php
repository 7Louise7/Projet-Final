<?php
//cette page permet à l'utilisateur de supprimer son compte même s'il ne verra pas cette page, car il sera directement renvoyé sur la page d'inscription
    require_once("fonctionBD.php");
        if(isset($_POST['supression'])){
            $req=$bdd->query("DELETE FROM souscrire WHERE idutilisateur=?",array($_SESSION['id']));
            $req=$bdd->query("DELETE FROM utilisateur WHERE idutilisateur=?",array($_SESSION['id']));
            echo $_SESSION['id'];
            header('Location:inscription2.php');
            exit;
        }
    

?>
