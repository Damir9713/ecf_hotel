<?php
session_start();
require('action/securityManager.php');
require('action/suite/addSuiteAction.php')
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



<form  class="container" method="post" enctype="multipart/form-data">
      <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Ttire</label>
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
              1 ère image carousel
            </div>
            <div class="mb-3">
              <input type="file" name="secondphoto">
              2 ème image carousel
            </div>
            <div class="mb-3">
              <input type="file" name="thirdphoto">
              3 ème image carousel
            </div>
      
            <button type="submit" class="btn btn-outline-warning" name="valider">Ajouter une suite</button>
            </div>
    </form>
