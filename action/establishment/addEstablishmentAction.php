<?php 

require("action/database.php");
require 'vendor/autoload.php';


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

    
  
    // $extensions = ['png', 'jpg', 'gif', 'jpeg'];
    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
    $photo = $_FILES['images']['name'];
    $typeExtension ='.'.strtolower(substr(strrchr($photo, '.'),1));
    $uniqueName = uniqid('', true);
    $file = $uniqueName.".".$typeExtension;
    $upload = "upload/".$file;
    $type_file = $_FILES['images']['type'];   
    // move_uploaded_file($_FILES['images']['tmp_name'], $upload);

    if(in_array($type_file, $type)){

      $s3 = new Aws\S3\S3Client([
        'version'  => '2006-03-01',
        'region'   => 'eu-west-3',
      ]);
     
      $bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['images']) && $_FILES['images']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['images']['tmp_name'])) {
        // FIXME: you should add more of your own validation here, e.g. using ext/fileinfo
        try {
            // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
            $upload = $s3->upload(
            $bucket, 
            $file, 
            fopen($_FILES['images']['tmp_name'], 'rb'), 
            'public-read');
    
           echo ('sucess ');
     } catch(Exception $e) { 
            echo('Ereur');
    } } 


    $insertImage = $bdd->prepare('INSERT INTO establishment(name, 
    city, 
    adress, 
    description, 
    photo
    ) VALUES(?, ?, ?, ?, ?)');

$insertImage->execute(
    array(
     $name,
     $city,
     $adress,
     $description,
     $file
    
    )
    );
    $sucessMsg = "Votre établissement a bien été ajoutée ";
    header('Location: establishmentAdmin.php');

    }else{
      $errorMsg = "Veuillez mettre une image au bon format";
    }
    
 
}else{
  $errorMsg = "Veuillez remplir tout les champs";
}
}
