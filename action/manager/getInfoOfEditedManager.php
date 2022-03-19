<?php

require('action/database.php');

$establishment_list = $bdd->query('SELECT DISTINCT * from establishment ');

//Vérifier si l'id de la cible est bien passé en paramètre dans l'URL
if(isset($_GET['manager_id']) AND !empty($_GET['manager_id'])){

    $idOfManager = $_GET['manager_id'];

    //Vérifier si la cible existe
    $getManagerInfo = $bdd->prepare('SELECT DISTINCT * FROM manager
   
    WHERE manager_id = ?');
    $getManagerInfo->execute(array($idOfManager));

    if($getManagerInfo->rowCount() > 0){

        //Récupérer les données de la cible
        $managerInfo = $getManagerInfo->fetch();
        if($managerInfo['manager_id']){
            
            $manager_firstname = $managerInfo['firstname'];
            $manager_lastname = $managerInfo['lastname'];
            $manager_email = $managerInfo['email'];
            $manager_establishment = $managerInfo['establishment_id'];
           

        }else{
            $errorMsg = "Vous ne pouvez pas modifier cette cible";
        }

    }else{
        $errorMsg = "Aucune cible n'a été trouvée";
    }

}else{
    $errorMsg = "Aucune cible n'a été trouvée";

}