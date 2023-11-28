
<div class="container formulaire mx-auto shadow">
    <form method="POST" action="./script_php/user_login.php" class="mx-auto">
        <h4 class="text-center couleur_texte_only">Connexion</h4>
        <div class="col-mb-3 mt-5">
            <label for="mail" class="form-label ">Adresse mail</label>
            <input type="emaim" class="form-control formulaire_conexion" id="mai" name="mail" 
                title="veuillez mettre que des lettres" required>
        </div>
        <div class="col-mb-3">
            <label for="mdp" class="form-label">Password</label>
            <input type="password" class="form-control formulaire_conexion" id="mdp" name="mot_de_passe"
                 title="veuillez mettre que des lettres" required>
            <div id="passwordHelp" class="form-text">Forget password</div>
        </div>


        <div class="text-center mb-3">
            <button type="submit" class="btn btn-outline-secondary couleur_bouton ">Submit</button>
            <p>Pas inscrit ? Cliquez <a class="couleur_texte_only" href="index.php?page=inscription ">ici</a> : </p>
        </div>
    </form>
</div>