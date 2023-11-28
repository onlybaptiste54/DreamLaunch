<?php
session_start();
//on apelle notre conection
require './connection_bdd.php';
if (isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"])) {
    $mail = trim($_POST['mail']);
    $password = $_POST['mot_de_passe'];

    $requete = $bdd->prepare("SELECT * FROM `client` WHERE email_client LIKE ?");
    $requete->execute(array($_POST['mail']));
    //je recupere toutes les lignes que retourne la requete sql 
    $data = $requete->fetchAll(PDO::FETCH_ASSOC);

    // Je vérifie s'il n'y pas pas de ligne car 0 ligne = pas de resultat = pas de compte
    if (count($data) == 0) {
        header('Location:../index.php?page=home&retour=email&token=' . $_SESSION['token']);
        var_dump($requete, $bdd, $_POST);
        // Il existe au moins une ligne(compte)
        
    } else {
        $compte = $data[0];
        if (password_verify(trim($password), $compte['mot_de_passe'])) {
            // on verifie que notre id client correspond a 1 ca veut qu'il est administrateur 
            $_SESSION['id'] = $compte['id_client'];
            $_SESSION['nom'] = $compte['nom_client'];
            $_SESSION['prenom'] = $compte['prenom'];
            $_SESSION['mail'] = $compte['email_client'];
            $_SESSION["telephone"] = $compte["telephone_client"];
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
            if ($compte['id_client'] == 1) {
                $_SESSION['admin'] = true;
                header('Location:../index.php?page=admin_pannel&action=dashboard&token=' . $_SESSION['token']);
            }
            header('Location:../index.php?page=home&token=' . $_SESSION['token']);
        } else {
            header('Location:../index.php?page=login');
        }
        var_dump($_SESSION, $compte['mot_de_passe']);
    }
}
