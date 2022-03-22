<?php
session_start();
require('action/securityCustomer.php');
require('action/reservation/reserveAction.php');
require('action/reservation/quickReserveAction.php')
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
      
                <?php 
                    while($suite = $getSuiteInfo->fetch()){
                        ?>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">establishment</label>    
                    <select type="text" readonly  id="suite" class="form-control" name="establishment" > 

                    <option value="<?php echo $suite['id'] ?>"><?php echo $suite['name'] ?></option>
                    </select>
                        
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">establishment</label>
                        <select type="text" readonly  id="suite" class="form-control" name="suite" > 

                    <option value="<?php echo $suite['suite_id'] ?>"><?php echo $suite['Title'] ?></option>
                    </select>
                    </div>
                
                    <?php
                        }
                    ?>
                
                <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Date d'arrivée</label>
                <input type="date" class="form-control" name="beginning" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Date de départ</label>
                <input type="date" class="form-control" name="ending" >
            </div>
                        
            </div>
           
      
            <button type="submit" class="btn btn-outline-warning" name="valider">Valider réservation</button>
            </div>
    </form>

    </body>
