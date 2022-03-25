<?php 
session_start();
require('action/securityManager.php');
require('action/suite/getInfoOfEditedSuite.php');
// require('action/suite/editSuiteAction.php');
require 'vendor/autoload.php';

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
            if(isset($_SESSION['id_manager'])){ 
                ?>
                <form class="container"  method="post" enctype="multipart/form-data" >
      <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Titre</label>
                <input type="text" class="form-control" name="title" value="<?= $suite_Title; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Prix</label>
                <input type="text" class="form-control" name="price" value="<?= $suite_price; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">description</label>
                <textarea type="email" class="form-control" name="description" ><?= $suite_description; ?></textarea>
            </div>

            <div class="mb-3">
              <input type="file" name="firstphoto" muultiple>
              1 ère image carousel
            </div>
            <!-- <div class="mb-3">
              <input type="file" name="secondphoto">
              2 ème image carousel
            </div>
            <div class="mb-3">
              <input type="file" name="thirdphoto">
              3 ème image carousel
            </div> -->
            
            
       
                    <button type="submit" class="btn btn-outline-warning" name="valider">Modifier la suite</button>
                    <br><br>
                </form>


                
                
                <?php
            }
        ?>
        <?php
        // se connecter à la bdd
require('action/database.php');

//Valider le formulaire
if(isset($_POST['valider'])){


    $type_file = $_FILES['firstphoto']['type'];     
    if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') ) {     
       exit("Erreur : Un des fichier n'est pas une image");     
    }
    
    $type_file1 = $_FILES['secondphoto']['type'];     
    if( !strstr($type_file1, 'jpg') && !strstr($type_file1, 'jpeg') && !strstr($type_file1, 'bmp') && !strstr($type_file1, 'gif') ) {     
       exit("Erreur : Un des fichier n'est pas une image");   
    }
    
    $type_file2 = $_FILES['thirdphoto']['type'];     
    if( !strstr($type_file2, 'jpg') && !strstr($type_file2, 'jpeg') && !strstr($type_file2, 'bmp') && !strstr($type_file2, 'gif') ) {     
       exit("Erreur : Un des fichier n'est pas une image");  
    };

    // $extensions = ['png', 'jpg', 'gif', 'jpeg'];
    $photo = $_FILES['firstphoto']['name'];
    $photo1 = $_FILES['secondphoto']['name'];
    $photo2 = $_FILES['thirdphoto']['name'];
    $typeExtension ='.'.strtolower(substr(strrchr($photo, '.'),1));
    $typeExtension1 ='.'.strtolower(substr(strrchr($photo1, '.'),1));
    $typeExtension2 ='.'.strtolower(substr(strrchr($photo2, '.'),1));
    $uniqueName = uniqid('', true);
    $file = $uniqueName.".".$typeExtension;
    $file1 = $uniqueName.".".$typeExtension1;
    $file2 = $uniqueName.".".$typeExtension2;
    // $upload = "upload/".$file;
    // move_uploaded_file($_FILES['images']['tmp_name'], $upload);

      
  
    $s3 = new Aws\S3\S3Client([
      'version'  => '2006-03-01',
      'region'   => 'eu-west-3',
    ]);
   
    $bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['firstphoto']) && $_FILES['firstphoto']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['firstphoto']['tmp_name'])) {
      // FIXME: you should add more of your own validation here, e.g. using ext/fileinfo
      try {
          // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
          $upload = $s3->upload(
          $bucket, 
          $file, 
          fopen($_FILES['firstphoto']['tmp_name'], 'rb'), 
          'public-read');
  
         echo ('sucess ');
   } catch(Exception $e) { 
          echo('Ereur');
  } } 

//   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['secondphoto']) && $_FILES['secondphoto']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['secondphoto']['tmp_name'])) {
//     // FIXME: you should add more of your own validation here, e.g. using ext/fileinfo
//     try {
//         // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
//         $upload1 = $s3->upload(
//         $bucket, 
//         $file1, 
//         fopen($_FILES['secondphoto']['tmp_name'], 'rb'), 
//         'public-read');

//        echo ('sucess ');
//  } catch(Exception $e) { 
//         echo('Ereur');
// } } 

// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['thirdphoto']) && $_FILES['thirdphoto']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['thirdphoto']['tmp_name'])) {
//     // FIXME: you should add more of your own validation here, e.g. using ext/fileinfo
//     try {
//         // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
//         $upload2 = $s3->upload(
//         $bucket, 
//         $file2, 
//         fopen($_FILES['thirdphoto']['tmp_name'], 'rb'), 
//         'public-read');

//        echo ('sucess ');
//  } catch(Exception $e) { 
//         echo('Ereur');
// } } 
  

    //Vérifier si les champs ne sont pas vides
    if(!empty($_POST['title']) 
    AND !empty($_POST['price']) 
    AND !empty($_POST['description'])   
     )
    {
        
        //Les données de la suite
        //Les données à faire passer dans la requête
        $new_suite_title = htmlspecialchars($_POST['title']);
        $new_suite_price = htmlspecialchars($_POST['price']);
        $new_suite_description = nl2br(htmlspecialchars($_POST['description']));
        $new_suite_establishment = $_SESSION['establishment_manager'] ;
        $new_suite_manager = $_SESSION['id_manager'] ;

              //Insérer la suite sur la bdd
              $editSuiteOnWebsite = $bdd->prepare('UPDATE suite SET Title = ?, 
              Price = ?, 
              description = ?, 
              establishment_id = ?, 
              manager_id = ?,
              photo1 = ?,
              photo2 = ?,
              photo3 = ?  
              WHERE suite_id = ?');
        
        $editSuiteOnWebsite->execute(
            array(
             $new_suite_title,
             $new_suite_price,
             $new_suite_description,
             $new_suite_establishment,
             $new_suite_manager,
             $file,
             $file1,
             $file2,
             $idOfSuite
            )
        );
        
        $successMsg = "Votre suite a bien été ajoutée ";
        header('Location: suiteManager.php');
        
      
        }else{
        $errorMsg = "Veuillez remplir tout les champs";
    }

}

?>

        <div>