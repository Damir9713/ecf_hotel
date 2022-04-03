<?php 
session_start();
require('action/securityAdmin.php');
require('action/manager/getInfoOfEditedManager.php');
require('action/manager/editManagerAction.php');

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
        if(isset($_SESSION['id_admin']))
        { 
        ?>

        <form class="container" method="post" >
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom</label>
                <input type="text" class="form-control" name="firstname" value="<?= $manager_firstname; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="lastname" value="<?= $manager_lastname; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="email" class="form-control" name="email" value="<?= $manager_email; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">password</label>
                <input type="password" class="form-control" name="password" >
            </div>
            
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Etablissement</label>
                <select type="text" class="form-control" name="establishment">                     
                        <?php while($establishment = $establishment_list->fetch())
                        {
                        echo '<option ';
                        if($manager_establishment==$establishment['id'])
                        {
                        echo 'selected="selected" ';
                        }
                        echo 'value="'.$establishment['id'].'">'.$establishment['name'].'</option>' ;
                        } ?>
                </select>
                
            </div>
       
            <button type="submit" class="btn btn-outline-warning" name="valider">Modifier le manager</button>
            <br><br>
        </form>
                
                <?php
                }
                ?>

    </div>

</body>
</html>
