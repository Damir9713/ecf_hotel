<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">HYPNOS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <?php
        if(isset($_SESSION['id_admin']))  
                {  
                ?>  
        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="logout.php">Déconnexion</a>
        </li>

        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="establishmentAdmin.php">Les établissements</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="managerAdmin.php">Les gérants</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="showMessage.php">Messages</a>
        </li>
    <?php        
    } 
    elseif(isset($_SESSION['id_manager'])){
      ?>
    
        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="establishmentManager.php">Accueil</a>
        </li>

        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="suiteManager.php">Suite</a>
        </li>

        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="logout.php">Déconnexion</a>
        </li>

      <?php
    }
    elseif(isset($_SESSION['id_customer'])){
      ?>

        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="reserveSuite.php">Réserver une suite</a>
        </li>

        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="myReservation.php">Voir mes réservations</a>
        </li>

        <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="logout.php">Déconnexion</a>
        </li>

      <?php
    }
else 
{  
?>  


  <li class="nav-item">
          <a class="nav-link" href="index.php">Accueil</a>
         </li>

         <li class="nav-item ">
          <a class="nav-link text-decoration-none" href="reserveSuite.php">Réserver une suite</a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="signupCustomer.php">S'inscrire</a>
         </li>
    
        <li class="nav-item">
          <a class="nav-link" href="login.php">Se connecter </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="sendMessage.php">Contactez-nous</a>
        </li>
        

<?php  
}  
?>  
      </ul>
    </div>
  </div>
</nav>