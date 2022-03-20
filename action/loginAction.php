<?php
session_start();
require('action/database.php');

//Validation du formulaire
if(isset($_POST['validate'])){

    //Vérifier si l'user a bien complété tous les champs
    if(!empty($_POST['firstname']) AND !empty($_POST['mdp'])){
        
        //Les données de l'user
        $user_pseudo = htmlspecialchars($_POST['firstname']);
        $user_password = htmlspecialchars($_POST['mdp']);

        //Vérifier si l'utilisateur existe (si le pseudo est correct)
        $checkIfUserExists = $bdd->prepare('SELECT * FROM admin WHERE firstname_admin = ?');
        $checkIfUserExists->execute(array($user_pseudo));

        $checkIfManagerExists = $bdd->prepare('SELECT * FROM manager 
        
        WHERE firstname = ?');
        $checkIfManagerExists->execute(array($user_pseudo));

        if($checkIfUserExists->rowCount() > 0){
            
            //Récupérer les données de l'utilisateur
            $usersInfos = $checkIfUserExists->fetch();

            //Vérifier si le mot de passe est correct
            if(password_verify($user_password , $usersInfos['password'])){
                
                //Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales sessions
                $_SESSION['auth'] = true;
                $_SESSION['id_admin'] = $usersInfos['id'];
                $_SESSION['lastname_admin'] = $usersInfos['lastname_admin'];
                $_SESSION['firstname_admin'] = $usersInfos['firstname_admin'];
                
                
                //Rediriger l'utilisateur vers la page d'accueil
                header('Location: establishmentAdmin.php');
            }else{
                $errorMsg = " Votre mot de passe est incorrect";
            }
        }else{
            $errorMsg = "Votre pseudo est incorrect...";
        }

        if($checkIfManagerExists->rowCount() > 0){
            
            
            //Récupérer les données de l'utilisateur
            $managerInfos = $checkIfManagerExists->fetch();
    
            //Vérifier si le mot de passe est correct
            if(password_verify($user_password , $managerInfos['password'])){
                
                //Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales sessions
                $_SESSION['auth'] = true;
                $_SESSION['id_manager'] = $managerInfos['manager_id'];
                $_SESSION['lastname_manager'] = $managerInfos['lastname'];
                $_SESSION['firstname_manager'] = $managerInfos['firstname'];
                $_SESSION['establishment_manager'] = $managerInfos['establishment_id'];
                
                
                //Rediriger l'utilisateur vers la page d'accueil
                header('Location: establishmentManager.php');
            }else{
                $errorMsg = " Votre mot de passe est incorrect";
            }
        }else{
            $errorMsg = "Votre pseudo est incorrect...";
        }
    
    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }

}