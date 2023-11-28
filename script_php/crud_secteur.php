<?php
session_start();

require './connection_bdd.php';
if (!isset($_GET["action"])) {
    header("Location:../index.php?page=admin_pannel&action=dashboard&token=" . $_SESSION["token"]);
}
switch ($_GET["action"]) {
    case "ajout":

        if (
            isset($_POST["ajout_secteur"]) && !empty($_POST["ajout_secteur"])) {


                $verifsecteur = $bdd->prepare("SELECT * FROM `secteur` WHERE `nom_metier` = ?");
                $verifsecteur->execute(array($_POST["ajout_secteur"]));

                if ($verifsecteur->rowCount() != 0) {
                    header("location:../index.php?page=dashboard&action");}
                    else{
                        $verifsecteur->closeCursor();
                        
                        $requete =  $bdd->prepare(" INSERT INTO `secteur`(`nom_metier`) VALUES (:nom_secteur)");
                        
                        $requete->execute(array(':nom_secteur'=>$_POST["ajout_secteur"]));

                        header("Location:../index.php?page=admin_pannel&action=dashboard&retour=ok&token=" . $_SESSION["token"]);
                    }

            }default; 
                    
            header("Location:../index.php?page=admin_pannel&action=dashboard&retour=erreur404&token=" . $_SESSION["token"]);
            break;
        
            case "delete":
                if (!isset($_POST["list_secteur"])) {
                    header("location:../index.php?page=admin_pannel&action=dashboard&token=" . $_SESSION["token"]);
                } else {
                    // Sanitize and validate input here if necessary
                    $id_secteur = $_POST["list_secteur"];
                    // Use prepared statements to delete the sector
                    $delete_secteur = $bdd->prepare("DELETE FROM `secteur` WHERE `id_secteur` = ?");
                    if ($delete_secteur->execute(array($_POST['list_secteur']))) {
                        header("location:../index.php?page=admin_pannel&action=dashboard&retour=success&token=" . $_SESSION["token"]);
                    } else {
                        // Handle the case where the deletion failed
                        // You can redirect with an error message
                        header("location:../index.php?page=admin_pannel&action=dashboard&retour=error&token=" . $_SESSION["token"]);
                    }
                }
                break;
        

    
    
    
    }