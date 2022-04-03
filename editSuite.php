<?php 
session_start();
require('action/securityManager.php');
require('action/suite/getInfoOfEditedSuite.php');
require('action/suite/editSuiteAction.php');
require 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>
<body>

    <?php include 'includes/navbar.php'; ?>

    <br><br>
    <div class="container">
        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; } ?>
        
        <?php 
            if(isset($_SESSION['id_manager'])){ 
                ?>
    <form class="container"  method="post" enctype="multipart/form-data" >
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Titre</label>
                <input type="text" class="form-control" name="title" value="<?= $suite_Title; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Prix</label>
                <input type="text" class="form-control" name="price" value="<?= $suite_price; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">description</label>
                <textarea type="email" class="form-control" name="description" ><?= $suite_description; ?></textarea>
            </div>

            <div class="mb-3">
              <input type="file" name="firstphoto">
            </div>
            <button type="submit" class="btn btn-outline-warning" name="valider">Modifier la suite</button>
            <br><br>
    </form>

                <?php
                }
                ?>
    <div>
</body>
</html>