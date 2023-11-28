<?php
require "./connection_bdd.php";
/*if(isset($_FILES["cv"]) && $_FILES["cv"]["error"] === 0) {
    // Un fichier a été téléchargé, vous pouvez continuer le traitement.
    $filename = $_FILES["cv"]["name"];
    $filesize = $_FILES["cv"]["size"];

    $extensions = array(".pdf");
    $extensions_file = strrchr($filename, ".");

    if (!in_array($extensions_file, $extensions)) {
        header("location: ../index.php?page=postulation&retour=extension");
        exit;
    }

    $newName = time() . '-' . $filename;
    $lien = "../lescv/" . $newName;
    

    $move_file = move_uploaded_file($_FILES["cv"]["tmp_name"], $lien);

    if ($move_file) {
        echo "COOL";
    } else {
      
       var_dump(error_get_last());
    }
} else {
    // Aucun fichier n'a été téléchargé, vous pouvez afficher un message d'erreur approprié.
    echo "Aucun fichier n'a été téléchargé.";
    echo  $_FILES["cv"]["error"];
}



*/

if (isset($_POST["prenom"])&&!empty($_POST["prenom"]) && 
isset($_POST["nom"])&&!empty($_POST["nom"]) 
&& isset($_POST["mail"])&&!empty($_POST["mail"]) 
&& isset ($_POST["telephone"])&&!empty($_POST["telephone"])) {
    


    
                if (isset($_GET['id_annonce'])){
                    $requete = $bdd->prepare("INSERT INTO `candidature` (message, email_candid, prenom_candid, nom_candid, telephone_candid, id_annonce) VALUES (:message_formulaire, :mail, :prenom, :nom, :telephone, :id_annonce)");
                    
                    $requete->execute(array(
                        ':message_formulaire' => $_POST['messages'],
                        ':mail' => $_POST['mail'],
                        ':nom' => $_POST['nom'],
                        ':telephone' => $_POST['telephone'],
                        ':prenom' => $_POST['prenom'],
                        ':id_annonce' => $_GET['id_annonce']
                        

                    ));
                    header('Location:../index.php?page=home');
                
                    var_dump($requete);
                }
                


        
        
        
        
            }
            
    
    
    else{
        echo "error";
    }


   



?>

