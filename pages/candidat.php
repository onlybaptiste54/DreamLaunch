<?php
if (isset($_GET["id_client"]) && $_GET["id_client"] == $_SESSION["id"] && isset($_GET["token"]) && $_GET["token"] == $_SESSION["token"]) {
    if (!isset($_GET["action"])) {
        header("location:index.php?page=home&retour=action_erreur");
    }
    require "./script_php/connection_bdd.php";

    switch ($_GET["action"]) {
        case "info":
            try {
                $client = $bdd->prepare("SELECT * FROM `client` WHERE `id_client`= ?");
                $client->execute([$_GET["id_client"]]);
                $info = $client->fetch();
            } catch (PDOException $e) {
                // Gérez l'exception ici, par exemple, en affichant un message d'erreur
                echo "Une erreur s'est produite : " . $e->getMessage();
            }
?>
            <div class="container">
                <div class="row d-inline">
                    <ul class="d-flex list-inline shadow justify-content-center ">
                        <li class="liste  offre_liste "> <a class="text-decoration-none text-black couleur_texte_only" href="index.php?page=candidat&action=info&token=<?= $_SESSION["token"] ?>&id_client=<?= $_SESSION["id"] ?>"> information</a></li>
                        <li class="liste  offre_liste"> <a class="text-decoration-none text-black couleur_texte_only" href="index.php?page=candidat&action=candidature&token=<?= $_SESSION["token"] ?>&id_client=<?= $_SESSION["id"] ?>">Candidature envoyé !</a></li>
                    </ul>
                </div>

                <div class="container-fluid formulaire mx-auto shadow">
                    <form method='POST' action="./script_php/client.php?action=modifier&id_client=<?= $_GET["id_client"] ?>" class="mx-auto ">
                        <h4 class="text-center couleur_texte_only">Mes informations </h4>
                        <div class="mb-3 mt-5">
                            <label for="prenom" class="form-label ">Prenom</label>
                            <input type="text" value="<?= $info["prenom"] ?>" class="form-control formulaire_conexion" id="prenom" name="prenom" />
                            <label for="nom" class="form-label">Nom </label>
                            <input type="text" value="<?= $info["nom_client"] ?>" class=" form-control formulaire_conexion" name="nom" id="username" title="veuillez mettre que des lettres">
                        </div>

                        <div class="mb-3">
                            <label for="mail" class="form-label">address mail</label>
                            <input type="email" value="<?= $info["email_client"] ?>" class=" form-control formulaire_conexion" id="mail" name="mail" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Numéro de téléphone</label>
                            <input type="tel" value="<?= $info["telephone_client"] ?>" class=" form-control formulaire_conexion" id="telephone" name="telephone" aria-describedby="telHelp">
                            <div id="telHelp" class="form-text">Exemple : +33 06 80 88 88 88</div>
                        </div>
                        <div class="text-center mb-3">
                            <a class="btn btn-warning" href="index.php?page=candidat&action=mdp&token=<?= $_SESSION["token"] ?>&id_client=<?= $_SESSION["id"] ?>"> Changer de mot de passe</a>
                        </div>
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-outline-secondary couleur_bouton ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>




        <?php
            break;
        case "candidature":
        ?>
            <div class="container">
                <div class="row  d-inline ">
                    <ul class="d-flex list-inline shadow justify-content-center ">
                        <li class="liste  offre_liste"> <a class="text-decoration-none text-black couleur_texte_only" href="index.php?page=candidat&action=info&token=<?= $_SESSION["token"] ?>&id_client=<?= $_SESSION["id"] ?>"> information</a></li>
                        <li class="liste  offre_liste "> <a class="text-decoration-none text-black couleur_texte_only" href="index.php?page=candidat&action=candidature&token=<?= $_SESSION["token"] ?>&id_client=<?= $_SESSION["id"] ?>">Candidature envoyé !</a></li>

                    </ul>
                </div>
                <?php

                $postuler = $bdd->prepare("SELECT 
                    nom_metier,
                       email_entreprise,
                       nom_entreprise,
                       adresse,
                       titre
                          from candidature
                        JOIN annonce ON 
                        candidature.id_annonce=annonce.id_annonce
                        JOIN entreprise ON
                        annonce.id_entreprise=entreprise.id_entreprise
                        JOIN secteur ON
                        annonce.id_secteur=secteur.id_secteur
                        WHERE email_candid LIKE ?");
                $postuler->execute(array($_SESSION["mail"]));

                ?>
                <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Titre de l'annonce</th>
                        <th class="text-center">Nom de l'entreprise</th>
                        <th class="text-center">Email de l'entreprise</th>
                        <th class="text-center">Salaire</th>
                        <th class="text-center">Horaire</th>
                        <th class="text-center">Lieu du travail</th>
                        <th class="text-center">CV envoyé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($post = $postuler->fetch()) {
                    ?>
                        <tr>
                            <td><?= $post["titre"] ?></td>
                            <td><?= $post["nom_entreprise"] ?></td>
                            <td><?= $post["email_entreprise"] ?></td>
                            <td><?= $post["Salaire"] ?></td>
                            <td><?= $post["horaire"] ?></td>
                            <td><?= $post["adresse"] ?></td>
                            <td><?= $post["nom_metier"] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            



            </div>
        <?php

            break;
        case "mdp":
        ?>
            <div class="container-fluid formulaire mx-auto shadow">
                <form method='POST' action="./script_php/client.php?action=mdp&id_client=<?= $_SESSION["id"]  ?>" class="mx-auto ">
                    <h4 class="text-center couleur_texte_only">Modifier mon mot de passe </h4>
                    <div class="mb-3">
                        <label for="old_mdp" class="form-label">Anciens mot de passe</label>
                        <input type="password" class="form-control formulaire_conexion" name="old_pass" id="old_mdp" title="veuillez mettre que des lettres">
                    </div>
                    <div class="mb-3">
                        <label for="newpass" class="form-label">Nouveau mot de passe </label>
                        <input type="password" class="form-control formulaire_conexion" name="new_pass" id="newpass" title="veuillez mettre que des lettres">
                    </div>

                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-outline-secondary couleur_bouton ">Submit</button>
                    </div>
                </form>
            </div>
            </div>



<?php
            break;
    }
} else {
    header("location:index.php?page=home&retour=pasco");
}


?>