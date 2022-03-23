<?php 
session_start();
require('action/securityAdmin.php');
require('action/establishment/getInfoOfEditedEstablishment.php');
// require('action/establishment/editEstablishment.php');

?>




<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>

    <br><br>
    <div class="container">
        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>';} 

        ?>
        
        <?php 
            if(isset($_SESSION['id_admin'])){ 
                ?>
                <form name="fo" class="container" method="post" enctype="multipart/form-data">
      <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom</label>
                <input type="text" class="form-control" name="name" value="<?= $establishment_name; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ville</label>
                <input type="text" class="form-control" name="city" value="<?= $establishment_city; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">adress</label>
                <input type="text" class="form-control" name="adress" value="<?= $establishment_adress; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">description</label>
                <textarea class="form-control" name="description" ><?= $establishment_description; ?></textarea>
            </div>
            
            <div class="mb-3">
              <input type="file" name="images">

            </div>
            
            
    
            
                    <button type="submit" class="btn btn-outline-warning" name="valider">Modifier l'établissement</button>
                    <br><br>
                </form>

                
                <?php
            }
        ?>


<?php 

require("action/database.php");

$photo = "";

if(isset($_POST['valider'])){

  if(!empty($_POST['name'])
    AND !empty($_POST['city']) 
    AND !empty($_POST['adress'])  
    AND !empty($_POST['description']) 
  ){

    $name = htmlspecialchars($_POST['name']);
    $description = nl2br(htmlspecialchars($_POST['description']));
    $city = htmlspecialchars($_POST['city']);
    $adress = htmlspecialchars($_POST['adress']);


    $type_file = $_FILES['images']['type'];     
    if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') ) {    
      exit ("Le fichier n'est pas une image");
    }
    
    $photo = $_FILES['images']['name'];
    $extensions = ['png', 'jpg', 'jpeg'];
    $uniqueName = uniqid('', true);
    $file = $uniqueName.".".strtolower(end($extensions));
    $upload = "upload/".$file;
    move_uploaded_file($_FILES['images']['tmp_name'], $upload);

    $insertImage = $bdd->prepare('UPDATE establishment 
    SET name = ?, 
    city = ?, 
    adress = ?, 
    description = ?, 
    photo = ?  
    WHERE id = ?');

$insertImage->execute(
    array(
     $name,
     $city,
     $adress,
     $description,
     $file,
     $idOfEstablishment
    )
);
$sucessMsg = "Votre établissement a bien été ajoutée ";
header('Location: establishmentAdmin.php');
  
}else{
  $errorMsg = "Veuillez remplir tout les champs";
}
}

?>  
        
                        
    </div>
    

</body>
</html>


