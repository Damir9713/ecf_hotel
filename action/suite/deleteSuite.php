<?php

//Vérifier si l'utilisateur est authentifié au niveau du site
session_start();
if(!isset($_SESSION['id_manager'])){
    header('Location: ../../index.php');
}

// se connecter à la bdd
require('../database.php');

//Vérifier si l'id est rentré en paramètre dans l'URL
if(isset($_GET['suite_id']) AND !empty($_GET['suite_id'])){

    //L'id de la cible en paramète
    $idOfTheSuite = $_GET['suite_id'];

    //Vérifier si la cible existe
    $checkIfSuiteExists = $bdd->prepare('SELECT suite_id FROM suite WHERE suite_id = ?');
    $checkIfSuiteExists->execute(array($idOfTheSuite));

    if($checkIfSuiteExists->rowCount() > 0){

        //Récupérer les infos de la cible
        $suiteInfos = $checkIfSuiteExists->fetch();
        if( $_SESSION['id_manager']){

            //Supprimer la cible en fonction de son id rentré en paramètre
           
            $deleteThisSuite = $bdd->prepare('DELETE FROM suite WHERE suite_id = ?');
            $deleteThisSuite->execute(array($idOfTheSuite));

            //Rediriger l'utilisateur
            header('Location: ../../suiteManager.php');

        }else{
            echo "Vous n'avez pas le droit de supprimer cette suite !";
        }

    }else{
        echo "Aucune suite n'a été trouvée";
    }


}else{
    echo "Aucun suite n'a été trouvée";
}