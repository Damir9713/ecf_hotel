<?php

// se connecter à la bdd
require('action/database.php');

//Valider le formulaire
if(isset($_POST['valider'])){

    
    //Vérifier si les champs ne sont pas vides
    if(!empty($_POST['title']) 
    AND !empty($_POST['price']) 
    AND !empty($_POST['description'])   
     ){
    
        
        //Les données du manager
        //Les données à faire passer dans la requête
        $new_suite_title = htmlspecialchars($_POST['title']);
        $new_suite_price = htmlspecialchars($_POST['price']);
        $new_suite_description = nl2br(htmlspecialchars($_POST['description']));
        $new_suite_establishment = $_SESSION['establishment_manager'] ;
        $new_suite_manager = $_SESSION['id_manager'] ;

        $type_file = $_FILES['firstphoto']['type'];     
        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') ) {     
           exit("Erreur : Un des fichier n'est pas une image");     
        }
        
        $type_file1 = $_FILES['secondphoto']['type'];     
        if( !strstr($type_file1, 'jpg') && !strstr($type_file1, 'jpeg') && !strstr($type_file1, 'bmp') && !strstr($type_file1, 'gif') ) {     
           exit("Erreur : Un des fichier n'est pas une image");   
        }
        
        $type_file2 = $_FILES['thirdphoto']['type'];     
        if( !strstr($type_file1, 'jpg') && !strstr($type_file1, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file1, 'gif') ) {     
           exit("Erreur : Un des fichier n'est pas une image");  
        };

        $extensions = ['png', 'jpg', 'gif', 'jpeg'];
        $photo = $_FILES['images']['name'];
        $typeExtension ='.'.strtolower(substr(strrchr($photo, '.'),1));
        $uniqueName = uniqid('', true);
        $file = $uniqueName.".".$typeExtension;
        $upload = "upload/".$file;
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

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['secondphoto']) && $_FILES['secondphoto']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['secondphoto']['tmp_name'])) {
        // FIXME: you should add more of your own validation here, e.g. using ext/fileinfo
        try {
            // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
            $upload = $s3->upload(
            $bucket, 
            $file, 
            fopen($_FILES['secondphoto']['tmp_name'], 'rb'), 
            'public-read');
    
           echo ('sucess ');
     } catch(Exception $e) { 
            echo('Ereur');
    } } 

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['thirdphoto']) && $_FILES['thirdphoto']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['thirdphoto']['tmp_name'])) {
        // FIXME: you should add more of your own validation here, e.g. using ext/fileinfo
        try {
            // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
            $upload = $s3->upload(
            $bucket, 
            $file, 
            fopen($_FILES['thirdphoto']['tmp_name'], 'rb'), 
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
             $photo,
             $photo1,
             $photo2
            
            )
        );
        
        $successMsg = "Votre suite a bien été ajoutée ";
        header('Location: suiteManager.php');

        }else{
            $errorMsg = "La suite existe déjà sur le site";
        }
      
    }else{
        $errorMsg = "Veuillez remplir tout les champs";
        }
    }
