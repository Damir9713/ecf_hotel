<?php
 session_start();

require('action/securityCustomer.php');
require('action/reservation/showMyReservation.php');
?>

<!DOCTYPE html>

<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>

<?php include 'includes/navbar.php'; ?>
<br><br>

<div class="container-fluid">

<?php 
            if(isset($successMsg)){ 
                echo '<p>'.$successMsg.'</p>'; 
            }

            
        ?>

<?php if(isset($_SESSION['id_customer'])){
  echo '<h1>'.'Bonjour '.$_SESSION['firstname_customer'].'</h1>';
  
} ?>

</div>

<br><br>

<div class="container-fluid">

<div class="row">


<?php while($reservation = $getMyReservation->fetch()){
  ?>
 
<div class="col-md mb-3">

<div class="card mx-auto h-100 " >

    <div class="card-body">
    <h5 class="card-title">Etablissement : <?php echo $reservation["name"] ?></h5>
    <p class="card-text">Suite : <?php echo $reservation["Title"] ?>.</p>
    <p class="card-text">Date d'arrivée : <?php echo $reservation["beginningDate"] ?>.</p>
    <p class="card-text">Date de départ : <?php echo $reservation["endingDate"] ?>.</p>
    
    </div>
</div>
</div>


<!-- style="width: 18rem;" -->

<!-- width="400" height="150" -->


<?php
}
?>
 </div>

</div>

<?php include('includes/footer.php') ?>
</body>

</html>