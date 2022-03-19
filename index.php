<?php
 session_start();
require('action/establishment/showEstablishment.php')

?>

<!DOCTYPE html>

<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>

<?php include 'includes/navbar.php'; ?>
<br><br>

<div class="container-fluid">
  <h1 class="">NOS ETABLISSEMENTS</h1>
<br><br>
</div>
<div class="container-fluid">
<?php if(isset($_SESSION['id_admin'])){
  echo '<h1>'.'Bonjour '.$_SESSION['firstname_admin'].'</h1>';
} ?>
<?php if(isset($_SESSION['id_manager'])){
  echo '<h1>'.'Bonjour '.$_SESSION['firstname_manager'].'</h1>';
  
} ?>

</div>

<br><br>

<div class="container-fluid">



<div class="row">


<?php while($establishment = $getEstablishmentInfo->fetch()){
  ?>
 
<div class="col-lg-4">

<div class="card mx-auto mb-3" style="width: 18rem;">
 <img src="upload/<?php echo $establishment['photo'] ?>" width="400" height="150" class="card-img-top" alt="...">
 <div class="card-body">
 <h5 class="card-title"><?php echo $establishment["name"] ?></h5>
   <p class="card-text"><?php echo $establishment["description"] ?>.</p>
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