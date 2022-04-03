<?php

require('action/database.php');

//Vérifier si l'id de la cible est bien passé en paramètre dans l'URL
if(isset($_GET['suite_id']) AND !empty($_GET['suite_id'])){

    $idOfSuite = $_GET['suite_id'];

    //Vérifier si la cible existe
    $getSuiteInfo = $bdd->prepare('SELECT DISTINCT * FROM suite
   
    WHERE suite_id = ?');
    $getSuiteInfo->execute(array($idOfSuite));

    if($getSuiteInfo->rowCount() > 0){

        //Récupérer les données de la cible
        $suiteInfo = $getSuiteInfo->fetch();
        if($suiteInfo['suite_id']){
            
            $suite_Title = $suiteInfo['Title'];
            $suite_price = $suiteInfo['Price'];
            $suite_description = $suiteInfo['description'];

            $suite_description = str_replace('<br />', '', $suite_description);
            
        }else{
            $errorMsg = "Vous ne pouvez pas modifier cette suite ";
        }

    }else{
        $errorMsg = "Aucune suite n'a été trouvée";
    }

}else{
    $errorMsg = "Aucune suite n'a été trouvée";

}