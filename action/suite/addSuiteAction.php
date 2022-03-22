<?php

// se connecter à la bdd
require('action/database.php');

$photo = "";
$photo1 = "";
$photo2 = "";

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
    
        $type_file = $_FILES['secondphoto']['type'];     
        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') ) {     
           exit("Erreur : Un des fichier n'est pas une image");   
        }
    
        $type_file = $_FILES['thirdphoto']['type'];     
        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') ) {     
           exit("Erreur : Un des fichier n'est pas une image");     
        }

        $photo = $_FILES['firstphoto']['name'];
        $upload = "upload/".$photo;

        move_uploaded_file($_FILES['firstphoto']['tmp_name'], $upload);

        $photo1 = $_FILES['secondphoto']['name'];
        $upload1 = "upload/".$photo1;

        move_uploaded_file($_FILES['secondphoto']['tmp_name'], $upload1);

        $photo2 = $_FILES['thirdphoto']['name'];
        $upload2 = "upload/".$photo2;

        move_uploaded_file($_FILES['thirdphoto']['tmp_name'], $upload2);

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
