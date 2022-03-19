<?php

//Vérifier si l'utilisateur est authentifié au niveau du site
session_start();
if(!isset($_SESSION['id_admin'])){
    header('Location: ../../index.php');
}

// se connecter à la bdd
require('../database.php');

//Vérifier si l'id est rentré en paramètre dans l'URL
if(isset($_GET['manager_id']) AND !empty($_GET['manager_id'])){

    //L'id de la cible en paramète
    $idOfTheManager = $_GET['manager_id'];

    //Vérifier si la cible existe
    $checkIfManagerExists = $bdd->prepare('SELECT manager_id FROM manager WHERE manager_id = ?');
    $checkIfManagerExists->execute(array($idOfTheManager));

    if($checkIfManagerExists->rowCount() > 0){

        //Récupérer les infos de la cible
        $managerInfos = $checkIfManagerExists->fetch();
        if( $_SESSION['id_admin']){

            //Supprimer la cible en fonction de son id rentré en paramètre
           
            $deleteThisManager = $bdd->prepare('DELETE FROM manager WHERE manager_id = ?');
            $deleteThisManager->execute(array($idOfTheManager));

            //Rediriger l'utilisateur vers ses questions
            header('Location: ../../managerAdmin.php');

        }else{
            echo "Vous n'avez pas le droit de supprimer ce manager !";
        }

    }else{
        echo "Aucun manager n'a été trouvée";
    }


}else{
    echo "Aucun manager n'a été trouvée";
}