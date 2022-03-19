<?php
session_start();
require('action/database.php');

//Validation du formulaire
if(isset($_POST['validate'])){

    //Vérifier si l'user a bien complété tous les champs
    if( !empty($_POST['lastname']) AND !empty($_POST['firstname'])  AND !empty($_POST['password'])){
        
        //Les données de l'user
        
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        

        //Vérifier si l'utilisateur existe déjà sur le site
        $checkIfUserAlreadyExists = $bdd->prepare('SELECT firstname_admin FROM admin WHERE firstname_admin = ?');
        $checkIfUserAlreadyExists->execute(array($user_firstname));

        if($checkIfUserAlreadyExists->rowCount() == 0){
            
            //Insérer l'utilisateur dans la bdd
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO admin(firstname_admin, lastname_admin, password)VALUES(?, ?, ? )');
            $insertUserOnWebsite->execute(array( $user_firstname, $user_lastname, $user_password));

            //Récupérer les informations de l'utilisateur
            $getInfosOfThisUserReq = $bdd->prepare('SELECT id , firstname_admin, lastname_admin FROM admin WHERE firstname_admin = ? AND lastname_admin = ? ');
            $getInfosOfThisUserReq->execute(array($user_firstname, $user_lastname));

            $usersInfos = $getInfosOfThisUserReq->fetch();

            //Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales sessions
            $_SESSION['auth'] = true;
            $_SESSION['id_admin'] = $usersInfos['id'];
            $_SESSION['lastname_admin'] = $usersInfos['lastname_admin'];
            $_SESSION['firstname_admin'] = $usersInfos['firstname_admin'];
            
            
            //Rediriger l'utilisateur vers la page d'accueil
            header('Location: index.php');

        }else{
            $errorMsg = "L'utilisateur existe déjà sur le site";
        }

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }

}