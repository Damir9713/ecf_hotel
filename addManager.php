<?php
session_start();
require('action/securityAdmin.php');
require('action/manager/addManagerAction.php')
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

<form  class="container" method="post">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom</label>
                <input type="text" class="form-control" name="firstname">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">prénom</label>
                <input type="text" class="form-control" name="lastname" >
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="email" class="form-control" name="email" >
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">password</label>
                <input type="password" class="form-control" name="password" >
            </div>
            
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Etablissement</label>
                <select type="text" class="form-control" name="establishment" > 

                    <?php 
                    while($establishment = $establishment_list->fetch()){
                        ?>
                            <option value="<?php echo $establishment['id'] ?>"> <?php echo $establishment['name'] ?> </option>        
                    <?php
                        }
                    ?>
                </select>        
            </div>

            <button type="submit" class="btn btn-outline-warning" name="valider">Ajouter un gérant</button>
            
</form>





    <?php include('includes/footer.php') ?>
</body>
</html>
