<?php
session_start();
if (!isset($_GET["action"])) {
    header("location:../index.php?page=admin_pannel&action=annonce&token=" . $_SESSION["token"]);
}
require './connection_bdd.php';
switch ($_GET["action"]) {

    case "ajout":
        if (
            isset($_POST["titre_annonce"]) && !empty($_POST["titre_annonce"]) &&
            isset($_POST["salaire"]) && !empty($_POST["salaire"]) &&
            isset($_POST["horaire"]) && !empty($_POST["horaire"]) &&
            isset($_POST["lieu"]) && !empty($_POST["lieu"]) &&
            isset($_POST["secteur"]) && !empty($_POST["secteur"]) &&
            isset($_POST["entreprise"]) && !empty($_POST["entreprise"]) &&
            isset($_POST["description"]) && !empty($_POST["description"])
        ) {
            try {
                $Now = new DateTime();
                $create_annonce = $bdd->prepare("INSERT INTO `annonce` (`Description`, `titre`, `Salaire`, `horaire`, `démaré_le`, `adresse`, `id_secteur`, `id_entreprise`) VALUES (:descriptions, :titre, :salaire, :horaire, :debut, :lieu, :secteur, :entreprise)");
                $create_annonce->execute(array(
                    ':descriptions' => $_POST["description"],
                    ':titre' => $_POST["titre_annonce"],
                    ':salaire' => $_POST["salaire"],
                    ':horaire' => $_POST["horaire"],
                    ':debut' => $Now->format('Y-m-d H:i:s'),
                    ':lieu' => $_POST["lieu"],
                    ':secteur' => $_POST["secteur"],
                    ':entreprise' => $_POST["entreprise"]
                ));
                header("location:../index.php?page=admin_pannel&action=annonce&token=" . $_SESSION["token"]);
            } catch (PDOException $e) {
                header("location:../index.php?page=admin_pannel&action=annonce&retour=sql&token=" . $_SESSION["token"]);
            }
        }

        break;

    case "modifier":
        if (!isset($_GET["id_annonce"])) {
            header("location:../index.php?page=admin_pannel&action=annonce&retour=id&token=" . $_SESSION["token"]);
        }

        if (
            isset($_POST["titre_annonce"]) && !empty($_POST["titre_annonce"]) &&
            isset($_POST["salaire"]) && !empty($_POST["salaire"]) &&
            isset($_POST["horaire"]) && !empty($_POST["horaire"]) &&
            isset($_POST["lieu"]) && !empty($_POST["lieu"]) &&
            isset($_POST["secteur"]) && !empty($_POST["secteur"]) &&
            isset($_POST["entreprise"]) && !empty($_POST["entreprise"]) &&
            isset($_POST["description"]) && !empty($_POST["description"])
        ) {
            try {
                $modif_annonce = $bdd->prepare("UPDATE `annonce` SET `Description`=:descriptions, `titre`=:titre, `Salaire`=:salaire, `horaire`=:horaire,  `adresse`=:lieu, `id_secteur`=:secteur, `id_entreprise`=:entreprise WHERE `id_annonce`=:id_annonce");
                $modif_annonce->execute(array(
                    ':descriptions' => $_POST["description"],
                    ':titre' => $_POST["titre_annonce"],
                    ':salaire' => $_POST["salaire"],
                    ':lieu' => $_POST["lieu"],
                    ':horaire' => $_POST["horaire"],
                    ':secteur' => $_POST["secteur"],
                    ':entreprise' => $_POST["entreprise"],
                    ':id_annonce' => $_GET["id_annonce"]  // Assuming you're using GET for the announcement ID
                ));
            
                header("location:../index.php?page=admin_pannel&action=annonce&token=" . $_SESSION["token"]);
            } catch (PDOException $e) {
                // Handle the exception (e.g., display an error message or log it)
                echo $e->getMessage();
            }
            
        }




        break;

    case "supprimer":

        if (!isset($_GET["id_annonce"])) {
            header("location:../index.php?page=admin_pannel&action=annonce&retour=sql&token=" . $_SESSION["token"]);
        }
        $annoncedel = $bdd->prepare("DELETE FROM `annonce` WHERE `id_annonce`= ?");
        $annoncedel->execute(array($_GET["id_annonce"]));


        header("location:../index.php?page=admin_pannel&action=annonce&retour=deleteOK&token=" . $_SESSION["token"]);



        break;
}
