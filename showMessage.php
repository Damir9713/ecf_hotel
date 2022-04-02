<?php
 session_start();
 require('action/securityAdmin.php');
require('action/message/showMessageAction.php')
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

</div>

<br><br>

<div class="container-fluid">

<div class="row ">


<?php while($message = $getMessageInfo->fetch()){
  ?>
 <div class="col-lg-4 mb-3">


 <div class="card mx-auto h-100">
  <div class="card-header">
    <h1>Expediteur du message : <?php echo $message["firstname"] ?> <?php echo $message["lastname"] ?></h1>
  </div>
  <div class="card-body">
    <h5 class="card-title">Sujet : <?php echo $message["subject"] ?></h5>
    <h5 class="card-title">Email : <?php echo $message["email"] ?></h5>
    <p class="card-text">Message : <?php echo $message["description"] ?></p>
    <a href="action/message/deleteMessageAction.php?id=<?= $message['id']; ?>" class="btn btn-outline-warning">Supprimer message</a>
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