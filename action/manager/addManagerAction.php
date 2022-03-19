<?php

// se connecter à la bdd
require('action/database.php');

// récupérer info pour liste déroulante
$establishment_list = $bdd->query('SELECT * from establishment order by id');



//Valider le formulaire
if(isset($_POST['valider'])){

    //Vérifier si les champs ne sont pas vides
    if(!empty($_POST['firstname']) 
    AND !empty($_POST['lastname']) 
    AND !empty($_POST['email'])  
    AND !empty($_POST['password']) 
    AND !empty($_POST['establishment']) 
     )
    {
        
        //Les données du manager
        //Les données à faire passer dans la requête
        $new_manager_firstname = htmlspecialchars($_POST['firstname']);
        $new_manager_lastname = htmlspecialchars($_POST['lastname']);
        $new_manager_email = htmlspecialchars($_POST['email']);
        $new_manager_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $new_manager_establishment = htmlspecialchars($_POST['establishment']);

        $checkIfManagerAlreadyExists = $bdd->prepare('SELECT firstname FROM manager WHERE firstname = ?');
        $checkIfManagerAlreadyExists->execute(array($new_manager_firstname));
        
        if($checkIfManagerAlreadyExists->rowCount() == 0) {

              //Insérer le manager sur la bdd
        $insertManagerOnWebsite = $bdd->prepare('INSERT INTO manager(firstname, 
        lastname, 
        email, 
        password,
        establishment_id
        ) VALUES(?, ?, ?, ?, ?)');
        
        $insertManagerOnWebsite->execute(
            array(
             $new_manager_firstname,
             $new_manager_lastname,
             $new_manager_email,
             $new_manager_password,
             $new_manager_establishment
            
            )
        );
        
        $successMsg = "Votre manager a bien été ajoutée ";
        header('Location: managerAdmin.php');
        }else{
            $errorMsg = "L'utilisateur existe déjà sur le site";
        }
      
        }else{
        $errorMsg = "Veuillez remplir tout les champs";
    }

    


}