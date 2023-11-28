<?php
require './script_php/connection_bdd.php';

if (isset($_SESSION['token']) && $_SESSION['token'] === $_GET['token'] && $_SESSION["admin"]) {
    switch ($_GET["action"]) {

        case "dashboard":
            $dashboard = "active";
            break;
        case "client":
            $client = "active";
            break;

        case "entreprise":

            $entreprise = "active";
            break;

        case "annonce":
            $annonce = "active";
            break;
    }
?>

    <div class="d-flex justify-content-between">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="index.php?page=admin_pannel&action=dashboard&token=<?= $_SESSION['token'] ?>" class="nav-link link-dark <?= $dashboard ?>">

                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="index.php?page=admin_pannel&action=client&token=<?= $_SESSION['token'] ?>" class="nav-link link-dark <?= $client ?>">


                        Client
                    </a>
                </li>
                <li>
                    <a href="index.php?page=admin_pannel&action=annonce&token=<?= $_SESSION['token'] ?>" class="nav-link link-dark <?= $annonce ?>">

                        Annonce
                    </a>
                </li>
                <li>
                    <a href="index.php?page=admin_pannel&action=entreprise&token=<?= $_SESSION['token'] ?>" class="nav-link <?= $entreprise ?> link-dark">
                        Entreprise
                    </a>
                </li>
            </ul>
        </div>
        <div class="container mt-5">
            <?php
            switch ($_GET["action"]) {
                case "dashboard":

            ?>



                    <div class="text-center">
                        <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-toggle="modal" data-bs-target="#create_secteur">
                            Créer un secteur
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="create_secteur" tabindex="-1" aria-labelledby="label_secteur" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="label_entreprise">Créer un secteur</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container mt-5">
                                        <form method="POST" action="./script_php/crud_secteur.php?action=ajout" class="mx-auto">
                                            <div class="col-mb-3">
                                                <label for="mdp" class="form-label">Nom du secteur</label>
                                                <input type="text" class="form-control formulaire_conexion" id="ajout_secteur" name="ajout_secteur" required>
                                                <div id="secteur" class="form-text">Nom du secteur</div>
                                                <button type="submit" class="btn btn-outline-secondary couleur_bouton">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around align-items-center">
                        <div class="col-3 text-center mx-auto">
                        <form action="./script_php/crud_secteur.php?action=delete" method="post">

                            <label for="secteur">Liste des secteurs existants</label>

                                <select name="list_secteur" class="form-control text-center">**selectionner**
                                    <?php
                                    $secteur = $bdd->prepare("SELECT * FROM `secteur`");
                                    $secteur->execute();

                                    while ($secteurs = $secteur->fetch()) {
                                    ?>
                                        <option  value="<?= $secteurs['id_secteur'] ?>">
                                            <?= $secteurs['nom_metier'] ?>
                                        </option>
                                    <?php } ?>

                                </select>

                                <button type="submit" class="btn btn-outline-secondary couleur_bouton">Supprimer</button>
                            </form>
                        </div>

                        <div class="col-7 text-center text-light">
                            <div class="col-3 mt-2 bg-danger mx-auto">

                            </div>
                            <div class="col-3 mt-2 bg-danger mx-auto">
                                <p>Nombre d'utilisateur crée :
                                <p>
                                    <?php
                                    $requete = $bdd->prepare("SELECT count(*) as nbclient FROM `client`");
                                    $requete->execute();

                                    $data = $requete->fetch();
                                    echo ($data['nbclient']);

                                    ?>
                            </div>
                        </div>

                    </div>
                    <?php

                    break;
                case "client":

                    $client = $bdd->prepare("SELECT * FROM `client`");
                    $client->execute();

                    while ($clients = $client->fetch()) {
                    ?>



                        <div class="card text-center mt-2">
                            <div class="card-header">
                                <h3>Client N°
                                    <?= $clients["id_client"] ?>
                                </h3>
                            </div>
                            <div class="card-body d-flex justify-content-between flex-wrap mx-auto col-6">
                                <p class="card-text">
                                Nom:     <?= $clients["nom_client"] ?>
                                </p>
                                <p class="card-text">
                                Prenom:     <?= $clients["prenom"] ?>
                                </p>
                                <p class="card-text">
                                Email client:     <?= $clients["email_client"] ?>
                                </p>
                                <p class="card-text">
                                Telephone client:     <?= $clients["telephone_client"] ?>
                                </p>
                            </div>
                            <div class="card-footer text-body-secondary">
                                <a href="#" class="btn btn-outline-secondary couleur_bouton">Voir les propositions</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-toggle="modal" data-bs-target="#modif_client<?= $clients["id_client"] ?>">
                                    Modifier
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modif_client<?= $clients["id_client"] ?>" tabindex="-1" aria-labelledby="titre_modif_client" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="titre_modif_client">Modifier
                                                    client</h1>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container mt-5">
                                                    <form method="POST" action="./script_php/client.php?action=modifier&id_client=<?= $clients["id_client"] ?>" class="mx-auto">
                                                        <div class="col-mb-3">
                                                            <label for="mdp" class="form-label">Nom du
                                                                client</label>
                                                            <input type="text" value="<?= $clients["nom_client"] ?> " class="form-control formulaire_conexion" id="nom_client" name="nom_client" required>
                                                        </div>
                                                        <div class="col-mb-3">
                                                            <label for="mdp" class="form-label">prenom du
                                                                client</label>
                                                            <input type="text" value="<?= $clients["prenom"] ?> " class="form-control formulaire_conexion" id="prenom_client" name="prenom_client" required>
                                                        </div>
                                                        <div class="col-mb-3 mt-5">
                                                            <label for="mail" class="form-label ">Adresse
                                                                mail</label>
                                                            <input type="email" value="<?= $clients["email_client"] ?> " class="form-control formulaire_conexion" id="mail" name="email" required>
                                                        </div>
                                                        <div class="col-mb-3">
                                                            <label for="telephone" class="form-label">telephone</label>
                                                            <input type="text" value="<?= $clients["telephone_client"] ?> " class="form-control formulaire_conexion" id="tel" name="telephone" required>
                                                        </div>
                                                        <div class="text-center mb-3">
                                                            <button type="submit" class="btn btn-outline-secondary couleur_bouton ">Modifier</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-dismiss="modal">retour</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="./script_php/client.php?id_client=<?= $clients["id_client"] ?>&action=supprimer&token=<?= $_SESSION["token"] ?>" class="btn btn-outline-secondary couleur_bouton">Supprimer</a>
                            </div>
                        </div>
                    <?php
                    }
                    break;

                case "entreprise":
                    ?>

                    <div class="text-center">
                        <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-toggle="modal" data-bs-target="#create_entreprise">
                            Créer une entreprise
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="create_entreprise" tabindex="-1" aria-labelledby="label_entreprise" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="label_entreprise">Créer une entreprise</h5>
                                    <button type="button btn-outline-secondary couleur_bouton" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container mt-5">
                                        <form method="POST" action="./script_php/entreprise.php?action=ajout" class="mx-auto">
                                            <div class="col-mb-3">
                                                <label for="mdp" class="form-label">Nom de
                                                    l'entreprise</label>
                                                <input type="text" class="form-control formulaire_conexion" id="entreprise" name="entreprise" required>
                                                <div id="passwordHelp" class="form-text">Nom de l'entreprise
                                                </div>
                                            </div>
                                            <div class="col-mb-3 mt-5">
                                                <label for="mail" class="form-label ">Adresse mail</label>
                                                <input type="email" class="form-control formulaire_conexion" id="mail" name="email" required>
                                            </div>
                                            <div class="col-mb-3">
                                                <label for="mdp" class="form-label">telephone</label>
                                                <input type="number" class="form-control formulaire_conexion" id="tel" name="telephone" title="veuillez mettre que des lettres" required>
                                                <div id="passwordHelp" class="form-text">Telephone</div>
                                            </div>
                                            <div class="text-center mb-3">
                                                <button type="submit" class="btn btn-outline-secondary couleur_bouton ">valider</button>
                                            </div>
                                        </form>

                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="d-flex justify-content-around flex-wrap col-12">

                        <?php






                        $entreprise = $bdd->prepare("SELECT * FROM `entreprise`");
                        $entreprise->execute();

                        while ($entreprises = $entreprise->fetch()) {
                        ?>
                            <div class="card text-center mt-2">
                                <div class="card-header">
                                    <h3>Entreprise N°
                                        <?= $entreprises["id_entreprise"] ?>
                                    </h3>
                                </div>
                                <div class="card-body d-flex justify-content-between flex-wrap mx-auto col-6">
                                    <p class="card-text">
                                    Nom entreprise:    <?= $entreprises["nom_entreprise"] ?>
                                    </p>
                                    <p class="card-text">
                                    Mail entreprise:  <?= $entreprises["email_entreprise"] ?>
                                    </p>
                                    <p class="card-text">
                                    Telephone entreprise:     <?= $entreprises["telephone_entreprise"] ?>
                                    </p>
                                </div>
                                <div class="card-footer text-body-secondary">
                                    <a href="#" class="btn btn-outline-secondary couleur_bouton">Voir les propositions</a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-toggle="modal" data-bs-target="#modif_entreprise<?= $entreprises["id_entreprise"] ?>">
                                        Modifier
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modif_entreprise<?= $entreprises["id_entreprise"] ?>" tabindex="-1" aria-labelledby="titre_modif_entreprise" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="titre_modif_entreprise">
                                                        Modifier entreprise</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container mt-5">
                                                        <form method="POST" action="./script_php/entreprise.php?action=modifier&id_entreprise=<?= $entreprises["id_entreprise"] ?>" class="mx-auto">
                                                            <div class="col-mb-3">
                                                                <label for="mdp" class="form-label">Nom de
                                                                    l'entreprise</label>
                                                                <input type="text" value="<?= $entreprises["nom_entreprise"] ?> " class="form-control formulaire_conexion" id="entreprise" name="entreprise" required>
                                                            </div>
                                                            <div class="col-mb-3 mt-5">
                                                                <label for="mail" class="form-label ">Adresse
                                                                    mail</label>
                                                                <input type="email" value="<?= $entreprises["email_entreprise"] ?> " class="form-control formulaire_conexion" id="mail" name="email" required>
                                                            </div>
                                                            <div class="col-mb-3">
                                                                <label for="telephone" class="form-label">telephone</label>
                                                                <input type="text" value="<?= $entreprises["telephone_entreprise"] ?> " class="form-control formulaire_conexion" id="tel" name="telephone" required>
                                                            </div>
                                                            <div class="text-center mb-3">
                                                                <button type="submit" class="btn btn-outline-secondary couleur_bouton ">Modifier</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-dismiss="modal">retour</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="./script_php/entreprise.php?id_entreprise=<?= $entreprises["id_entreprise"] ?>&action=supprimer&token=<?= $_SESSION["token"] ?>" class="btn btn-outline-secondary couleur_bouton">Supprimer</a>
                                </div>
                            </div>

                        <?php

                        }
                        ?>
                    </div>
                <?php
                    break;




                case "annonce":
                ?>

                    <div class="col-12 d-flex flex-column align-items-center">

                        <div class="text-center">
                            <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-toggle="modal" data-bs-target="#create_ads">
                                Créer une annonce
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="create_ads" tabindex="-1" aria-labelledby="label_entreprise" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="label_entreprise">Créer une annonce</h5>
                                        <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container mt-5">
                                            <form method="POST" action="./script_php/annonce.php?action=ajout" class="mx-auto">
                                                <div class="col-mb-3">
                                                    <label for="titre" class="form-label">Titre de
                                                        l'annonce</label>
                                                    <input type="text" class="form-control formulaire_conexion" id="titre_annonce" name="titre_annonce" required>
                                                    <div class="form-text">Titre de l'annoncce</div>
                                                </div>
                                                <div class="col-mb-3 mt-5">
                                                    <label for="salaire" class="form-label ">Salaire</label>
                                                    <input type="number" class="form-control formulaire_conexion" id="salaire" name="salaire" required>
                                                </div>
                                                <div class="col-mb-3">
                                                    <label for="horaire" class="form-label">horaire</label>
                                                    <input type="text" class="form-control formulaire_conexion" id="tel" name="horaire" required>
                                                    <div class="form-text">horaire</div>
                                                </div>
                                                <div class="col-mb-3">
                                                    <label for="lieu" class="form-label">lieu</label>
                                                    <input type="text" class="form-control formulaire_conexion" id="tel" name="lieu" required>
                                                    <div class="form-text">lieu</div>
                                                </div>
                                                <div class="col-mb-3">
                                                    <label for="secteur" class="form-label">secteur</label>
                                                    <select class="form-select form-select-lg mb-3" name="secteur" aria-label="select">
                                                        <option selected disabled>Veuillez choisir un métier
                                                        </option>
                                                        <?php
                                                        $secteur = $bdd->prepare("SELECT * FROM `secteur`; ");
                                                        $secteur->execute();
                                                        while ($metier = $secteur->fetch()) {
                                                            echo '
                                                            <option value="' . $metier["id_secteur"] . '">' . $metier["nom_metier"] . '</option>
                                                            ';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-mb-3">
                                                    <label for="entreprise" class="form-label">Entreprise</label>
                                                    <select class="form-select form-select-lg mb-3" name="entreprise" aria-label="select">
                                                        <option selected disabled>Veuillez choisir une
                                                            entreprise</option>
                                                        <?php
                                                        $entreprise = $bdd->prepare("SELECT * FROM `entreprise`; ");
                                                        $entreprise->execute();
                                                        while ($metier = $entreprise->fetch()) {
                                                            echo '
                                                            <option value="' . $metier["id_entreprise"] . '">' . $metier["nom_client"] . '</option>
                                                            ';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-mb-3">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Décriver le post de votre annonce" name="description" id="description" style="height: 100px"></textarea>
                                                        <label for="description">Description</label>
                                                    </div>
                                                </div>

                                                <div class="text-center mb-3">
                                                    <button type="submit" class="btn btn-outline-secondary couleur_bouton ">valider</button>
                                                </div>
                                            </form>

                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $annonce = $bdd->prepare("SELECT * FROM `annonce` JOIN `entreprise` ON `annonce`.`id_entreprise` = `entreprise`.`id_entreprise` JOIN `secteur` ON `annonce`.`id_secteur` = `secteur`.`id_secteur`");
                        $annonce->execute();

                        while ($annonces = $annonce->fetch()) {
                        ?>
                            <div class="card text-center mt-2">
                                <div class="card-header">
                                    <h3>ANNONCE N°
                                        <?= $annonces["id_annonce"] ?>
                                    </h3>
                                </div>
                                <div class="card-body d-flex justify-content-around flex-wrap mx-auto col-12">

                                    <div class="col-4">
                                        <h4>
                                          Titre de l'annonce:   <?= $annonces["titre"] ?>
                                        </h4>
                                        <p>
                                         Horaire:    <?= $annonces["horaire"] ?>
                                        </p>
                                        <p>
                                        Date:     <?= $annonces["démaré_le"] ?>
                                        </p>
                                        <p>
                                        Salaire:     <?= $annonces["Salaire"] ?>
                                        </p>

                                        <p>
                                        Adresse:     <?= $annonces["adresse"] ?>
                                        </p>
                                        <p>
                                        Description:  <?= $annonces["Description"] ?>
                                        </p>

                                    </div>
                                    <div class="col-4">
                                        <h4>
                                           Nom entreprise: <?= $annonces["nom_entreprise"] ?>
                                        </h4>
                                        <p>
                                        Mail:     <?= $annonces["email_entreprise"] ?>
                                        </p>
                                        <p>
                                        Tel:     <?= $annonces["telephone_entreprise"] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer text-body-secondary">
                                    <a href="#" class="btn btn-outline-secondary couleur_bouton">Voir plus</a>
                                    <a href="./script_php/annonce.php?action=supprimer&id_annonce=<?= $annonces["id_annonce"] ?>" class="btn btn-outline-secondary couleur_bouton">Supprimer</a>
                                    <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-toggle="modal" data-bs-target="#modif_entreprise<?= $annonces["id_annonce"] ?>">
                                        Modifier
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modif_entreprise<?= $annonces["id_annonce"] ?>" tabindex="-1" aria-labelledby="titre_modif_entreprise" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="titre_modif_entreprise">
                                                        Modifier annonce</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container mt-5">
                                                        <form method="POST" action="./script_php/annonce.php?action=modifier&id_annonce=<?= $annonces["id_annonce"] ?>" class="mx-auto">
                                                            <div class="col-mb-3">
                                                                <label for="titre" class="form-label">Titre de
                                                                    l'annonce</label>
                                                                <input type="text" class="form-control formulaire_conexion" value="<?= $annonces["titre"] ?>" id="titre_annonce" name="titre_annonce" required>
                                                                <div class="form-text">Titre de l'annoncce</div>
                                                            </div>
                                                            <div class="col-mb-3 mt-5">
                                                                <label for="salaire" class="form-label ">Salaire</label>
                                                                <input type="number" class="form-control formulaire_conexion" value="<?= $annonces["Salaire"] ?>" id="salaire" name="salaire" required>
                                                            </div>
                                                            <div class="col-mb-3">
                                                                <label for="horaire" class="form-label">horaire</label>
                                                                <input type="text" class="form-control formulaire_conexion" id="horaire" value="<?= $annonces["horaire"] ?>" name="horaire" required>
                                                                <div class="form-text">horaire</div>
                                                            </div>
                                                            <div class="col-mb-3">
                                                                <label for="lieu" class="form-label">lieu</label>
                                                                <input type="text" class="form-control formulaire_conexion" value="<?= $annonces["adresse"] ?>" id="lieu" name="lieu" required>
                                                                <div class="form-text">lieu</div>
                                                            </div>
                                                            <div class="col-mb-3">
                                                                <label for="secteur" class="form-label">secteur</label>
                                                                <select class="form-select form-select-lg mb-3" name="secteur" aria-label="select">
                                                                    <option selected value="<?= $annonces["id_secteur"]; ?>">
                                                                        <?= $annonces["nom_metier"]; ?>
                                                                    </option>
                                                                    <?php
                                                                    $secteur_metier = $bdd->prepare("SELECT * FROM `secteur`; ");
                                                                    $secteur_metier->execute();
                                                                    while ($metier = $secteur_metier->fetch()) {
                                                                        echo '
                                                            <option value="' . $metier["id_secteur"] . '">' . $metier["nom_metier"] . '</option>
                                                            ';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-mb-3">
                                                                <label for="entreprise" class="form-label">Entreprise</label>
                                                                <select class="form-select form-select-lg mb-3" name="entreprise" aria-label="select">
                                                                    <option selected value="<?= $annonces["id_entreprise"]; ?>">
                                                                        <?= $annonces["nom_entreprise"]; ?>
                                                                    </option>
                                                                    <?php
                                                                    $entreprise = $bdd->prepare("SELECT * FROM `entreprise`; ");
                                                                    $entreprise->execute();
                                                                    while ($metier = $entreprise->fetch()) {
                                                                        echo '
                                                                        <option value="' . $metier["id_entreprise"] . '">' . $metier["nom_entreprise"] . '</option>
                                                                        ';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-mb-3">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" placeholder="Décriver le post de votre annonce" name="description" id="description" style="height: 100px">
                                                                                                    <?= $annonces["Description"] ?>
                                                                                                </textarea>
                                                                    <label for="description">Description</label>
                                                                </div>
                                                            </div>

                                                            <div class="text-center mb-3">
                                                                <button type="submit" class="btn btn-outline-secondary couleur_bouton ">valider</button>
                                                            </div>
                                                        </form>

                                                    </div>





                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary couleur_bouton" data-bs-dismiss="modal">retour</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php

                        }

                        ?>
                    </div>
            <?php
                    break;
            }


            ?>

        </div>



    </div>
    <!-- on peut couper le php
<?php } else {
    echo "Vous n'avez pas les droits ";

    var_dump($_SESSION);
}
