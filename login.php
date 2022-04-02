
<?php 

require('action/loginAction.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>

<br><br>

<form class="container" method="POST">

        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; }
            
        ?>
         

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nom</label>
            <input type="text" class="form-control" name="firstname">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="mdp">
        </div>
        <input type="hidden" name="token_generate" id="token_generate">
        <button type="submit" class="btn btn-outline-warning" name="validate">Se connecter</button>
        <br><br>
        
    </form>



</body>

<script src="https://www.google.com/recaptcha/api.js?render=6LfhPjsfAAAAAMEaWi6NUqqfg4ae50pXhsfE2lJY"></script>

<script>
      
        grecaptcha.ready(function() {
          grecaptcha.execute('6LfhPjsfAAAAAMEaWi6NUqqfg4ae50pXhsfE2lJY', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
          let response = document.getElementById('token_generate')
          response.value = token;
            });
        });
      
  </script>

</html>