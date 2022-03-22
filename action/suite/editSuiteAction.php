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
     )
    {
        
        //Les données de la suite
        //Les données à faire passer dans la requête
        $new_suite_title = htmlspecialchars($_POST['title']);
        $new_suite_price = htmlspecialchars($_POST['price']);
        $new_suite_description = nl2br(htmlspecialchars($_POST['description']));
        $new_suite_establishment = $_SESSION['establishment_manager'] ;
        $new_suite_manager = $_SESSION['id_manager'] ;

        $photo = $_FILES['firstphoto']['name'];
        $upload = "upload/".$photo;

        move_uploaded_file($_FILES['firstphoto']['tmp_name'], $upload);

        $photo1 = $_FILES['secondphoto']['name'];
        $upload1 = "upload/".$photo1;

        move_uploaded_file($_FILES['secondphoto']['tmp_name'], $upload1);

        $photo2 = $_FILES['thirdphoto']['name'];
        $upload2 = "upload/".$photo2;

        move_uploaded_file($_FILES['thirdphoto']['tmp_name'], $upload2);

       
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
             $photo,
             $photo1,
             $photo2,
             $idOfSuite
            )
        );
        
        $successMsg = "Votre suite a bien été ajoutée ";
        header('Location: suiteManager.php');
        
      
        }else{
        $errorMsg = "Veuillez remplir tout les champs";
    }

    


}