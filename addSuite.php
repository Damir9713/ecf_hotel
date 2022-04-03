<?php
session_start();
require('action/securityManager.php');
require('action/suite/addSuiteAction.php');
require 'vendor/autoload.php';
require('action/database.php');
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
</div>

<div class="container">

    <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Titre</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Prix</label>
                <input type="text" class="form-control" name="price" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">description</label>
                <textarea type="email" class="form-control" name="description" ></textarea>
            </div>
            
            <div class="mb-3">
              <input type="file" name="firstphoto">
            </div>
            <button type="submit" class="btn btn-outline-warning" name="valider">Ajouter une suite</button>
            
    </form>
</div>
</body>
</html>