<?php
session_start();
require('action/securityCustomer.php');
require('action/establishment/showEstablishment.php');
require('action/reservation/reserveAction.php')
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
                <label for="exampleInputEmail1" class="form-label">Etablissement</label>
                
                <select type="text" class="form-control" id="establishment" name="establishment" > 

                    <?php 
                    while($establishment = $getEstablishmentInfo->fetch()){
                        ?>
                            <option value="<?php echo $establishment['id'] ?>"> <?php echo $establishment['name'] ?> </option>        
                    <?php
                        }
                    ?>
                </select>
                    </div>

                    <div class="mb-3">

                    <label for="exampleInputEmail1" class="form-label">Suite</label>
                    <select type="text"  id="suite" class="form-control" name="suite" > 

                    <option value="">selectionner l'établissement</option>
                    </select>
                        
                    </div>
                



                <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Date d'arrivée</label>
                <input type="text" class="form-control" name="beginning" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Date de départ</label>
                <input type="text" class="form-control" name="ending" >
            </div>
                        
            </div>
           
      
            <button type="submit" class="btn btn-outline-warning" name="valider">Valider réservation</button>
            </div>
    </form>

    <script>
     
     $(document).ready(function(){
    $('#establishment').on('change', function(){
        var id = $(this).val();
        if(id){
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:'id='+id,
                success:function(html){
                    $('#suite').html(html);
                     
                }
            }); 
        }
    });
    
    
});
    </script>
    
    </body>

   
   