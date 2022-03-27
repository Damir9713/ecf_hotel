<?php

// se connecter à la bdd
require('action/database.php');
require 'vendor/autoload.php';

//Valider le formulaire
if(isset($_POST['valider'])){

    
    //Vérifier si les champs ne sont pas vides
    if(!empty($_POST['title']) 
    AND !empty($_POST['price']) 
    AND !empty($_POST['description']) 
    AND !empty($_FILES['firstphoto'])   
     ){
    
        $type_file = $_FILES['firstphoto']['type']; 
        $extensions = ['png', 'jpg', 'gif', 'jpeg'];
        $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
        $photo = $_FILES['firstphoto']['name'];
        $typeExtension ='.'.strtolower(substr(strrchr($photo, '.'),1));
        $uniqueName = uniqid('', true);
        $file = $uniqueName.".".$typeExtension;
        $upload = "upload/".$file;
        // move_uploaded_file($_FILES['images']['tmp_name'], $upload);
        
        if(in_array($type_file, $type)) { 

        $new_suite_title = htmlspecialchars($_POST['title']);
        $new_suite_price = htmlspecialchars($_POST['price']);
        $new_suite_description = nl2br(htmlspecialchars($_POST['description']));
        $new_suite_establishment = $_SESSION['establishment_manager']; 
        $new_suite_manager = $_SESSION['id_manager'];  
      
      
      
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

        $checkIfSuiteAlreadyExists = $bdd->prepare('SELECT Title FROM suite WHERE Title = ?');
        $checkIfSuiteAlreadyExists->execute(array($new_suite_title));
        
        if($checkIfSuiteAlreadyExists->rowCount() == 0) {

              //Insérer le manager sur la bdd
        $insertManagerOnWebsite = $bdd->prepare('INSERT INTO suite(Title, 
        Price, 
        description, 
        establishment_id,
        manager_id,
        photo1,
        photo2,
        photo3
        ) VALUES(?, ?, ?, ?, ?,?,?,?)');
        
        $insertManagerOnWebsite->execute(
            array(
             $new_suite_title,
             $new_suite_price,
             $new_suite_description,
             $new_suite_establishment,
             $new_suite_manager,
             $file,
            )
        );
        
        $successMsg = "Votre suite a bien été ajoutée ";
        header('Location: suiteManager.php');

        }else{
            $errorMsg = "La suite existe déjà sur le site";
        }

        }else{
            $errorMsg = "Veuillez mettre une image au bon format";
        }
   
    }else{
        $errorMsg = "Veuillez remplir tout les champs";
        }
    }
