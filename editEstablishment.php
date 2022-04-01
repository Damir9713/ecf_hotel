<?php 
session_start();
require('action/securityAdmin.php');
require('action/establishment/getInfoOfEditedEstablishment.php');
require('action/establishment/editEstablishment.php');
require 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>

    <br><br>
    <div class="container">
        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>';} 



        ?>
        <?php 
            if(isset($_SESSION['id_admin'])){ 
                ?>
                <form   class="container" method="post" enctype="multipart/form-data">
      <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom</label>
                <input type="text" class="form-control" name="name" value="<?= $establishment_name; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ville</label>
                <input type="text" class="form-control" name="city" value="<?= $establishment_city; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">adress</label>
                <input type="text" class="form-control" name="adress" value="<?= $establishment_adress; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">description</label>
                <textarea class="form-control" name="description" ><?= $establishment_description; ?></textarea>
            </div>
            
            <div class="mb-3">
              <input type="file" name="images">

            </div>
            
            <button type="submit" class="btn btn-outline-warning" name="valider">Modifier l'établissement</button>
                 
                    <br><br>
            </form>
            
                
                <?php
            }
        ?>

                  
        </div>
</body>
</html>




