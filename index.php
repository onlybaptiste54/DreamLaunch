<?php session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="./style.css">
    <title>Welcome</title>
</head>

<body>



    <?php
    include("./pages/header.php");

    //tableau des pages disponibles

    $tabPage = array("home", "contact", "admin_pannel", "postulation","login", "candidat", "inscription");

    //chemin des pages

    $page = "./pages/";
    ?>


    <?php

    //je teste si la page existe
    if (isset($_GET["page"])) {
        if (in_array($_GET["page"], $tabPage)) {
            include($page . "/" . $_GET["page"] . ".php");
        } else {
            include("./pages/404.php");
        }
    } else {
        // par defaut la 1er page sera accueil.php
        include("./pages/home.php");
    }

    //retour = message d'information sous forme de popup 
    $message = "";

    if (isset($_GET["retour"])) {
        switch ($_GET["retour"]) {
                //Communs
            case "vide":
                $message = "Veuillez renseigner tous les champs obligatoires.";
                break;
            case "sql":
                $message = "Erreur dans la base de données.";
                break;

            default:
                $message = " oups ! Erreur inattendue!";
        }
    }

    if (!empty($message)) {
        echo "<div class='notification'>
        <p> $message </p>
        <span class='notification__progresse'></span>
        </div>";
    }
    ?>


    <?php
    // cookies & footer
    include("./pages/footer.php"); ?>
    </script>


</body>

</html>