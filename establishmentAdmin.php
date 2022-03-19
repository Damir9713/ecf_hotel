<?php
 session_start();
 require('action/securityAdmin.php');
require('action/establishment/showEstablishment.php')
?>

<!DOCTYPE html>

<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>

<?php include 'includes/navbar.php'; ?>
<br><br>

<div class="container-fluid">
<?php if(isset($_SESSION['id_admin'])){
  echo '<h1>'.'Bienvenue admnistrateur '.$_SESSION['firstname_admin'].'</h1>';
} ?>
<div class="row">
<div class="col ms-5">
        <a href="addEstablishment.php"class="btn btn-outline-warning">Ajouter un établissement</a>
        </div>
</div>


</div>

<br><br>

<div class="container-fluid">

<div class="row ">


<?php while($establishment = $getEstablishmentInfo->fetch()){
  ?>
 <div class="col-lg-4">

 <div class="card mx-auto mb-3" style="width: 18rem;">
  <img src="upload/<?php echo $establishment['photo'] ?>" width="400" height="150" class="card-img-top" alt="...">
  <div class="card-body">
  <h5 class="card-title"><?php echo $establishment["name"] ?></h5>
    <p class="card-text"><?php echo $establishment["description"] ?>.</p>
    <div class="row">
        <div class="col">
        <a href="editEstablishment.php?id=<?= $establishment['id']; ?>" class="btn btn-outline-warning">Modifier</a>
        </div>
        <div class="col">
        <a href="action/establishment/deleteEstablishmentAction.php?id=<?= $establishment['id']; ?>" class="btn btn-outline-warning">Supprimer</a>
        </div>
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