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
                    <select type="text" readonly   class="form-control" name="establishment" > 

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
                <input type="date" id="debut"  class="form-control" name="beginning" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Date de départ</label>
                <input type="date" id="fin" class="form-control" name="ending" >
            </div>
                        
            </div>

             <!-- Button trigger modal -->
             <button type="button" id="disponibility" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Disponibilité
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Disponibilité de la suite</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Fermer</button>
                    </div>
                    </div>
                </div>
                </div>
           
      
            <button type="submit" class="btn btn-outline-warning" name="valider">Valider réservation</button>
            
</form>


<script src="src/ajax.js" type='text/javascript'>
</script>

    </body>
