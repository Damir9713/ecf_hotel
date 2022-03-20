<?php
 session_start();
 require('action/securityManager.php');
require('action/suite/showSuite.php')
?>

<!DOCTYPE html>

<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>

<?php include 'includes/navbar.php'; ?>
<br><br>

<div class="container-fluid">
<?php if(isset($_SESSION['id_manager'])){
  echo '<h1>'.'Bonjour '.$_SESSION['firstname_manager'].'</h1>';
} ?>

<div class="row">
<div class="col ms-5">
        <a href="addSuite.php"class="btn btn-outline-warning">Ajouter une suite</a>
        </div>
</div>


</div>

<br><br>


<div class="container-fluid ">
  
<div class="row ">


  <?php while($suite = $getSuiteInfo->fetch()){
  ?>

<div class="col-lg-4  mb-5">

<div class="card h-100">
  <h3 class="card-header">
   <?php echo $suite["Title"] ?>
</h3>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-inner" data-bs-interval="20">
    <div class="carousel-item active">
      <img src="upload/<?php echo $suite['photo1'] ?>"  class="d-block w-100 h-25" alt="...">
    </div>
    <div class="carousel-item">
      <img src="upload/<?php echo $suite['photo2'] ?>"  class="d-block w-100 h-25" alt="...">
    </div>
    <div class="carousel-item">
      <img src="upload/<?php echo $suite['photo3'] ?>"  class="d-block w-100 h-25" alt="...">
    </div>
    
  </div>
</div>
  <div class="card-body">
 
    <h5 class="card-title">Prix : <?php echo $suite["Price"] ?></h5>
    <h5 class="card-text">description : <?php echo $suite["description"] ?> </h5>
    <div class="col">
    <a href="editSuite.php?id=<?= $suite['id']; ?>" class="btn btn-outline-warning">Modifier</a>
    <a href="action/suite/deleteSuite.php?id=<?= $suite['id']; ?>" class="btn btn-outline-warning">Supprimé</a>
    </div>
    
  </div>

  </div>

  </div>
  
 

<?php
}
?>



</div>
</div>



<?php include('includes/footer.php') ?>
</body>

</html>