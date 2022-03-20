<?php
session_start();
require('action/securityManager.php');
require('action/suite/addImageSuiteAction.php')
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>
<br><br>

<?php 
            if(isset($errorMsg)){ 
                echo '<p>'.$errorMsg.'</p>'; 
            }elseif(isset($successMsg)){ 
                echo '<p>'.$successMsg.'</p>'; 
            }
        ?>


<form name="fo" class="container" method="post" enctype="multipart/form-data">
      
<div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Etablissement</label>
                
                <select type="text" class="form-control" name="suite" > 

                    <?php 
                    while($suite = $suite_list->fetch()){
                        ?>
                            <option value="<?php echo $suite['id'] ?>"> <?php echo $suite['Title'] ?> </option>        
                    <?php
                        }
                    ?>
                </select>
                        
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
      
            <button type="submit" class="btn btn-outline-warning" name="valider">Ajouter les photos</button>
            </div>
    </form>





    <?php include('includes/footer.php') ?>
</body>
</html>
