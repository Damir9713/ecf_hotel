<?php

require('action/database.php');

//Vérifier si l'id de la cible est bien passé en paramètre dans l'URL
if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfEstablishment = $_GET['id'];

    //Vérifier si la cible existe
    $getEstablishmentInfo = $bdd->prepare('SELECT DISTINCT * FROM establishment
    
    
    
    WHERE id = ?');
    $getEstablishmentInfo->execute(array($idOfEstablishment));

    if($getEstablishmentInfo->rowCount() > 0){

        //Récupérer les données de la cible
        $establishmentInfo = $getEstablishmentInfo->fetch();
        if($establishmentInfo['id']){
            
            $establishment_name = $establishmentInfo['name'];
            $establishment_city = $establishmentInfo['city'];
            $establishment_adress = $establishmentInfo['adress'];
            $establishment_description = $establishmentInfo['description'];

            $establishment_description = str_replace('<br />', '', $establishment_description);
            
          

            
           

        }else{
            $errorMsg = "Vous ne pouvez pas modifier cette cible";
        }

    }else{
        $errorMsg = "Aucune cible n'a été trouvée";
    }

}else{
    $errorMsg = "Aucune cible n'a été trouvée";

}