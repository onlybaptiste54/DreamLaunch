<div class="container-fluid formulaire mx-auto shadow">
    <form method='POST' action="./script_php/register.php" class="mx-auto ">
        <h4 class="text-center couleur_texte_only">Inscrivez vous  </h4>
        <div class="mb-3 mt-5">
            <label for="prenom" class="form-label ">Prenom</label>
            <input type="text" class="form-control formulaire_conexion" id="prenom" name="prenom"/>
            <label for="nom" class="form-label">Nom </label>
            <input type="text" class="form-control formulaire_conexion" name="nom" id="username" 
                title="veuillez mettre que des lettres">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control formulaire_conexion" name="password" id="exampleInputPassword1"
                 title="veuillez mettre que des lettres">
            <div id="passwordHelp" class="form-text">Forget password</div>
        </div>

        <div class="mb-3">
            <label for="mail" class="form-label">address mail</label>
            <input type="email" class="form-control formulaire_conexion" id="mail" name="mail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Numéro de téléphone</label>
            <input type="tel" class="form-control formulaire_conexion" id="telephone" name="telephone" aria-describedby="telHelp">
         <div id="telHelp" class="form-text">Exemple : +33 06 80 88 88 88</div>
        </div>
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-outline-secondary couleur_bouton ">Submit</button>
        </div>
    </form>




</div>