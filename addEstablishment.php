<?php
session_start();
require('action/securityAdmin.php');
require('action/establishment/addEstablishmentAction.php');
require 'vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>
<br><br>
<div class="container">

        
        <?php 
            if(isset($errorMsg)){ 
                echo '<p>'.$errorMsg.'</p>'; 
            }elseif(isset($successMsg)){ 
                echo '<p>'.$successMsg.'</p>'; 
            }
        ?>


<form  method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ville</label>
                <input type="text" class="form-control" name="city" >
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">adress</label>
                <input type="text" class="form-control" name="adress" >
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            
            <div class="mb-3">
              <input type="file" name="images">
            </div>
            <button type="submit" class="btn btn-outline-warning" name="valider">Ajouter un établissement</button>
</form>


    </div>

<?php include('includes/footer.php') ?>
</body>
</html>
