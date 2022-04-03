<?php

// se connecter à la base de donnée
require('action/database.php');

//Validation du formulaire
if(isset($_POST['valider'])){

    //Vérifier si les champs sont remplis
    if(!empty($_POST['firstname']) 
    AND !empty($_POST['lastname']) 
    AND !empty($_POST['email'])  
    AND !empty($_POST['password']) 
    AND !empty($_POST['establishment']) 
    
    ){

        //Les données à faire passer dans la requête
        $new_manager_firstname = htmlspecialchars($_POST['firstname']);
        $new_manager_lastname = htmlspecialchars($_POST['lastname']);
        $new_manager_email = htmlspecialchars($_POST['email']);
        $new_manager_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $new_manager_establishment = htmlspecialchars($_POST['establishment']);
        
        
        //Modifier les informations 
        $editManagerOnWebsite = $bdd->prepare('UPDATE manager SET firstname = ?, 
        lastname = ?, 
        email = ?, 
        password = ?, 
        establishment_id = ?  
        WHERE manager_id = ?');

        $editManagerOnWebsite->execute(array($new_manager_firstname, 
        $new_manager_lastname, 
        $new_manager_email, 
        $new_manager_password, 
        $new_manager_establishment,  
        $idOfManager));

        //Redirection 
        header('Location: managerAdmin.php');
        
    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
        
    }

}