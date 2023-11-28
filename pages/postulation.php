<?php
require "./script_php/connection_bdd.php";
if (!isset($_GET["id_annonce"])) {
    header("location:index.php?page=home&retour=annonce");
}

if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $email = $_SESSION["mail"];
    $telephone = $_SESSION["telephone"];
    


} else {
    $id = "";
    $nom = "";
    $prenom = "";
    $email = "";
    $telephone = "";
}
?>
<div class="container-fluid formulaire mx-auto shadow">
    <form method="post" enctype="multipart/form-data" action="./script_php/postulation.php?id_annonce=<?= $_GET['id_annonce']?>" class="mx-auto ">
        <h4 class="text-center couleur_texte_only">Candidatez</h4>
        <div class="mb-3 mt-5">
            <label for="prenom" class="form-label ">Prenom</label>
            <input type="text" class="form-control formulaire_conexion" value="<?= $prenom ?>" id="prenom" name="prenom" />
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control formulaire_conexion" value="<?= $nom ?>" name="nom" id="username">
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control formulaire_conexion" value="<?= $email ?>" id="mail" name="mail" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Telephone</label>
            <input type="text" class="form-control formulaire_conexion" value="<?= $telephone ?>" id="telephone" name="telephone" aria-describedby="telephone">
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Messages</label>
            <textarea class="form-control formulaire_conexion" id="message" name="messages" rows="3"></textarea>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="cv">Deposer votre CV ici</label>
            <input type="file" class="form-control" id="cv" name="cv">
        </div>
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-success couleur_bouton ">Candidater</button>
        </div>
    </form>




</div>