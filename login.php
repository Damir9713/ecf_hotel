
<?php 

require('action/loginAction.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>

<br><br>

<form class="container" method="POST" action="verify.php">

        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; }
            
        ?>
        
        <?php
          require_once('recaptchalib.php');
          $publickey = "6Le8qDkfAAAAANahmpg14Gar67pxHD7xHmFcg-t_"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>

         

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nom</label>
            <input type="text" class="form-control" name="firstname">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="mdp">
        </div>
        <button type="submit" class="btn btn-outline-warning" name="validate">Se connecter</button>
        <br><br>
        
    </form>
