<?php
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
  
</div>
<br><br>

<div class="container-fluid">


<div class="row">


<?php while($establishment = $getEstablishmentInfo->fetch()){
  ?>
 

  <div class="col-sm-4">

<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-sm-4">
      <img src="upload/<?php echo $establishment['photo']; ?>"  class="image rounded-start img-fluid" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $establishment["name"] ?></h5>
        <p class="card-text"><?php echo $establishment["description"] ?>.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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