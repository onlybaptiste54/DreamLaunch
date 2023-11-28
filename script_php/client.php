<?php
session_start();

require './connection_bdd.php';
if (!isset($_GET["action"])) {
    header("Location:../index.php?page=admin_pannel&action=client&token=" . $_SESSION["token"]);
}
switch ($_GET["action"]) {



    case "modifier":
        if (!$_GET["id_client"]) {
            header("location:../index.php?page=admin_pannel&action=client&token=" . $_SESSION["token"]);
        }
        if (
            isset($_POST["nom_client"]) && !empty($_POST["nom_client"]) &&
            isset($_POST["prenom_client"]) && !empty($_POST["prenom_client"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["telephone"]) && !empty($_POST["telephone"])
        ) {

            $modif_client = $bdd->prepare("UPDATE `client` SET `nom_client`=:nom_client, `prenom`=:prenom_client, `telephone_client`=:telephone_client,`email_client`=:email_client WHERE `id_client`= " . $_GET["id_client"]);
            $modif_client->execute(array(
                ":nom_client" => $_POST["nom_client"],
                ":prenom_client" => $_POST["prenom_client"],
                ":email_client" => $_POST["email"],
                ":telephone_client" => $_POST["telephone"]
            ));
            header("location:../index.php?page=admin_pannel&action=client&retour=success&token=" . $_SESSION["token"]);
        }

        break;
    case "supprimer":
        if (!$_GET["id_client"]) {
            header("location:../index.php?page=admin_pannel&action=client&token=" . $_SESSION["token"]);
        }
        $delete_client = $bdd->prepare("DELETE FROM `client` WHERE `id_client` = ?");
        $delete_client->execute(array($_GET["id_client"]));
        header("location:../index.php?page=admin_pannel&action=client&retour=success&token=" . $_SESSION["token"]);

        break;

    case "mdp":
        if (!$_GET["id_client"]) {
            header("location:../index.php?page=admin_pannel&action=client&token=" . $_SESSION["token"]);
        }
        if (isset($_POST["old_pass"]) && isset($_POST["new_pass"])) {


            $checkmdp = $bdd->prepare("SELECT `mot_de_passe` FROM `client` WHERE `id_client`= ?");
            $checkmdp->execute(array($_GET["id_client"]));
            $mdpbdd = $checkmdp->fetch();

            $hash = password_hash($_POST["new_pass"], PASSWORD_BCRYPT);

            $changemdp = $bdd->prepare("UPDATE `client` SET `mot_de_passe`= ? WHERE `id_client`=" . $_GET["id_client"]);
            $changemdp->execute(array($hash));

            header("location:../index.php?page=home");
        }
        break;
}
