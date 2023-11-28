<div class="container-fluid">
  <nav class="navbar sticky-top  navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand couleur_texte_only" href="index.php?pages=home">DreamLaunch</a>
      
      <button class="navbar-toggler couleur_bouton" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse  " id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          </ul>
          
          <div class="d-flex justify-content-end"> 
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link d-none d-lg-inline couleur_texte_only" href="#">Entreprise / Publiez une annonce</a>
          </li>
          
          <?php
          if(isset($_SESSION["id"])){
            echo '<li class="nav-item">
            <a class="nav-link d-none d-lg-inline couleur_texte_only" href="index.php?page=candidat&action=info&token=' . $_SESSION["token"] . '&id_client='.$_SESSION["id"].'">mon compte</a>
            </li>';
          }
          
          
          
          if (isset($_SESSION["admin"]) && !empty($_SESSION["admin"])) {
            // Le $_SESSION["id_client"] existe et n'est pas vide
            echo '<li class="nav-item">
            <a class="nav-link d-none d-lg-inline couleur_texte_only" href="index.php?page=admin_pannel&action=dashboard&token=' . $_SESSION["token"] . '">dashboard</a>
            </li>';
          } else {
          }
          ?>

          <?php
          if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
            // Le $_SESSION["id_client"] existe et n'est pas vide
            echo '<li class="nav-item ">
            <a href="./script_php/deconnexion.php" class="btn btn-outline-secondary couleur_bouton d-flex justify-content-end w-10">Deconnexion</a>
            </li>';
          } else {
            // Le $_SESSION["id_client"] n'existe pas ou est vide
            echo '<li class="nav-item ">
            <a href="index.php?page=login" class="btn btn-outline-secondary text-end couleur_bouton">Connexion</a>
            </li>';

          }
          
          
          ?>
        </ul>
      </div>
      </div>
    </div>
    
  </nav>
</div>