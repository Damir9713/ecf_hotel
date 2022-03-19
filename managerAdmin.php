<?php
 session_start();
 require('action/securityAdmin.php');
require('action/manager/showManager.php')
?>

<!DOCTYPE html>

<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>

<?php include 'includes/navbar.php'; ?>
<br><br>

<div class="container-fluid">
<?php if(isset($_SESSION['id_admin'])){
  echo '<h1>'.'Bonjour '.$_SESSION['firstname_admin'].'</h1>';
} ?>

<div class="row">
<div class="col ms-5">
        <a href="addManager.php"class="btn btn-outline-warning">Ajouter un gérant</a>
        </div>
</div>

</div>

<br><br>

<div class="container">

<?php while($manager = $getManagerInfo->fetch()){
  ?>
 
 <div class="card">
  <h3 class="card-header">
  <?php echo $manager["firstname"] ?> <?php echo $manager["lastname"] ?>
</h3>
  <div class="card-body">
    <h5 class="card-title">Gérant de l'établissement : <?php echo $manager["name"] ?></h5>
    <h5 class="card-text">Email : <?php echo $manager["email"] ?> </h5>
    <div class="col">
    <a href="editManager.php?manager_id=<?= $manager['manager_id']; ?>" class="btn btn-outline-warning">Modifier</a>
    <a href="action/manager/deleteManagerAction.php?manager_id=<?= $manager['manager_id']; ?>" class="btn btn-outline-warning">Supprimé</a>
    </div>
    
  </div>
</div>
<br><br>
<?php
}
?>
 
</div>

<?php include('includes/footer.php') ?>
</body>

</html>