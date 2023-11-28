<?php
require './connection_bdd.php';

//verification, via dollar post , on tcheke si le formulaire est incomplet .
if (isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST["nom"]) &&
 !empty($_POST["nom"]) && isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["mail"]) && !empty($_POST["mail"])&& isset($_POST["telephone"]) &&!empty($_POST["telephone"]))
 {
    //on recupère les données de l'utilisateur dans une nouvelle variable
    $prenom = $_POST['prenom'];
    $nom=$_POST['nom'];
    $password=$_POST['password'];
    $email=$_POST['mail'];
    $telephone=$_POST['telephone'];

// savoir si l'adresse mail est valide
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

}

 else {
    header('Location:../index.php?page=register&retour=mail');
}
// on hash notre passwordd, pour que personne puisse le recupérer, on hash le mdp que le mec a rentré
$password_hash = password_hash($password,PASSWORD_BCRYPT);

// on prépare la requête sql , pour insérer les données dans la base de données
//$bdd c'est le truc quon utilise pour se conecter a la base de donnée, ya que les requetes que on a preparé qui pourront etre executées dans la base de donnée.
$requete = $bdd->prepare("INSERT INTO `client` (`nom_client`, `prenom`, `email_client`, `mot_de_passe`, `telephone_client`) VALUES (:nom_client, :prenom, :email_client, :mot_de_passe,:telephone_client)");

//maintenant que la requete a été préparé , on l'exécute, CAD on execute la requete quand un utilisateur rentre des données , on insere mais la on execute tout dans notre base de données 
$requete-> execute(array(
":nom_client" => $nom ,
":prenom"=>$prenom,
":email_client"=>$email ,
":mot_de_passe" => $password_hash,
":telephone_client" => $telephone,));


if ($requete){
header('Location:../index.php?page=login');
}else{
    header('Location:../index.php?page=inscription&retour=sql');
}

 }
//donc ici , si il n'yas rien dans le prenom, donc on va dans le false, /header 
//header = fonctionalité php , qui coupe end essous de lui, il ne lis pas le code en dessous et dans notre cas il force a retourner dans une page specifique
else {
    header('Location:../index.php?page=register&retour=vide');
}






?>