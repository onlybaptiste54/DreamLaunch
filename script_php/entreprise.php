<?php
session_start();

require './connection_bdd.php';
if (!isset($_GET["action"])) {
    header("Location:../index.php?page=admin_pannel&action=entreprise&token=" . $_SESSION["token"]);
}
switch ($_GET["action"]) {

    case "ajout":
        if (
            isset($_POST["entreprise"]) && !empty($_POST["entreprise"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["telephone"]) && !empty($_POST["telephone"])
        ) {

            $verifEmail = $bdd->prepare("SELECT * FROM `entreprise` WHERE `email_entreprise` = ?");
            $verifEmail->execute(array($_POST["email"]));

            if ($verifEmail->rowCount() != 0) {
                header("location:../index.php?page=entreprise&action=email");
            } else {
                $verifEmail->fetchAll();
                $verifEmail->closeCursor();
                try {
                    $entreprise_requete = $bdd->prepare("INSERT INTO `entreprise` (`id_entreprise`, `nom_entreprise`, `telephone_entreprise`, `email_entreprise`) VALUES (NULL, ?, ?, ?)");
                    $entreprise_requete->execute(array(
                        $_POST["entreprise"],
                        $_POST["telephone"],
                        $_POST["email"]
                    ));
                    header("location:../index.php?page=admin_pannel&action=entreprise&token=" . $_SESSION["token"]);
                } catch (PDOException $e) {
                    echo "Erreur d'exécution de la requête : " . $e->getMessage();
                }
            }
        }
        break;
    case "modifier":
        if (!$_GET["id_entreprise"]) {
            header("location:../index.php?page=admin_pannel&action=entreprise&token=" . $_SESSION["token"]);
        }
        if (
            isset($_POST["entreprise"]) && !empty($_POST["entreprise"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["telephone"]) && !empty($_POST["telephone"])
        ) {

            $modif_entreprise = $bdd->prepare("UPDATE `entreprise` SET `nom_entreprise`=:nom_entreprise,`telephone_entreprise`=:telephone_entreprise,`email_entreprise`=:email_entreprise WHERE `id_entreprise`= " . $_GET["id_entreprise"]);
            $modif_entreprise->execute(array(
                ":nom_entreprise" => $_POST["entreprise"],
                ":email_entreprise" => $_POST["email"],
                ":telephone_entreprise" => $_POST["telephone"]
            ));
            header("location:../index.php?page=admin_pannel&action=entreprise&retour=success&token=" . $_SESSION["token"]);
        }

        break;
    case "supprimer":
        if (!$_GET["id_entreprise"]) {
            header("location:../index.php?page=admin_pannel&action=entreprise&token=" . $_SESSION["token"]);
        }
        $delete_entreprise = $bdd->prepare("DELETE FROM `entreprise` WHERE `id_entreprise` = ?");
        $delete_entreprise->execute(array($_GET["id_entreprise"]));
        header("location:../index.php?page=admin_pannel&action=entreprise&retour=success&token=" . $_SESSION["token"]);

        break;
}
