
<?php 

require('action/message/sendMessageAction.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>

<br><br>

<form class="container" method="POST">

        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; }
              if(isset($sucessMsg)){ echo '<p>'.$sucessMsg.'</p>'; } 
        ?>
        
         

        <div class="mb-3">
            <label for="firstname" class="form-label">Nom</label>
            <input type="text" class="form-control" name="firstname">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="lastname">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
        </div>

        

        <div class="mb-3">
            <label for="subject" class="form-label">Sujets</label>
            <select type="text" class="form-control" name="subject">
            <option value="Je souhaite poser une réclamation">Je souhaite poser une réclamation</option>
            <option value="Je souhaite commander un service supplémentaire">Je souhaite commander un service supplémentaire</option>
            <option value="Je souhaite en savoir plus sur une suite">Je souhaite en savoir plus sur une suite</option>
            <option value="J’ai un souci avec cette application">J’ai un souci avec cette application</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Message</label>
            <textarea type="text" class="form-control" name="description"></textarea>
        </div>
        
        <button type="submit" class="btn btn-outline-warning" name="valider">Envoyer</button>
        
        
    </form>
