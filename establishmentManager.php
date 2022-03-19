<?php
 session_start();
 require('action/securityManager.php');
require('action/suite/showManagerEstablishment.php')
?>

<!DOCTYPE html>

<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>

<?php include 'includes/navbar.php'; ?>
<br><br>

<div class="container-fluid">
<?php if(isset($_SESSION['id_manager'])){
  echo '<h1>'.'Bienvenue manager '.$_SESSION['firstname_manager'].'</h1>';
} ?>



</div>
<br><br>

<h1>Votre établissement</h1>

<br><br>

<div class="container-fluid">






<?php while($manager = $getManagerInfo->fetch()){
  ?>
 
 
<div class="card mx-auto mb-3">
  <img src="upload/<?php echo $manager['photo'] ?>" width="1000" height="500" class="card-img-top" alt="...">
  <div class="card-body">
  <h5 class="card-title"><?php echo $manager["name"] ?></h5>
    <p class="card-text"><?php echo $manager["description"] ?>.</p>
  </div>
</div>
   
<?php
}
?>
 

</div>

<?php include('includes/footer.php') ?>
</body>

</html>