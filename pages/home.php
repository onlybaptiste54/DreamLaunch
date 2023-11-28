<?php require './script_php/connection_bdd.php';
?>

<div class="container contenaire_recherche">
    <div class="row">
        <div class=col-md-12>
       <p> Décrochez le job de vos rêves dès maintenant.




</p>
        </div>
    </div>



    <div class="container shadow p-3 mb-5 bg-white rounded ">

        <form>
            <div class="row  ">
                <div class="col-md-6 recherche">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" name="search1" placeholder="Secteur"
                            aria-label="Rechercher un métier...">
                    </div>
                </div>
                <div class="col-md-6 recherche">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" name="search2" placeholder="département"
                            aria-label="Rechercher autre chose...">
                        <button type="submit" class="btn btn-outline-secondary couleur_bouton">Rechercher</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-5 ">
        <?php
        // la je lui dit de mer ecuperer le tableaux d'annonce, j'ai mes infos sous la forme d'un array.
        $requete = $bdd->prepare("SELECT * FROM `annonce`");

        $requete->execute();
        // pdo fetch assoc, c'est pour dire aa ma requte que mes données je les veux sour format de tableaux . 
        // le fetch permet d'afficher que une seule ligne,  
        //et le fetch all affiche le tableaux.
        $data = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $annonce) {
            $description = $annonce['Description'];

        echo <<<CARD
            <div class="card fs-6 text w-100">
                <div class="card-body">
                    <h5 class="card-title carte_titre">Titre ; {$annonce['titre']}</h5>
                    <h5 class="card-title carte_titre">Adresse : {$annonce['adresse']}</h5>

                    <p class="card-text limite">{$annonce['Description']}</p>

                    <p>
                        <button class="btn btn-outline-secondary couleur_bouton" type="button" data-bs-toggle="collapse"
                            data-bs-target="#annonce{$annonce['id_annonce']}" aria-expanded="false" aria-controls="annonce{$annonce['id_annonce']}">
                            En apprendre plus
                        </button>
                    </p>
                    <div class="collapse" id="annonce{$annonce['id_annonce']}">
                        <p class="card-text">{$annonce['Description']}</p>
                        <p class="card-text">Salaire; {$annonce['Salaire']} , Horaire ; {$annonce['horaire']}</p>


                        <a href="index.php?page=postulation&id_annonce={$annonce['id_annonce']}" class="btn btn-outline-secondary couleur_bouton">Postulez</a>
                    </div>
                </div>
            </div>
       
  
        CARD;
    }
    ?>
           
    </div>
    <script>
        const elements = document.querySelectorAll(".limite");
        Array.from(elements).forEach(function (lettre) {
            let text = lettre.textContent;
            if (text.length > 50) {
                let shortenedText = text.substring(0, 50) + '...';
                lettre.textContent = shortenedText;
            }
        });
    </script>

</div>