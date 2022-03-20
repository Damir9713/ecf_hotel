<?php

//Vérifier si l'utilisateur est authentifié au niveau du site
session_start();
if(!isset($_SESSION['id_manager'])){
    header('Location: ../../index.php');
}

// se connecter à la bdd
require('../database.php');

//Vérifier si l'id est rentré en paramètre dans l'URL
if(isset($_GET['id']) AND !empty($_GET['id'])){

    //L'id de la cible en paramète
    $idOfTheSuite = $_GET['id'];

    //Vérifier si la cible existe
    $checkIfSuiteExists = $bdd->prepare('SELECT id FROM suite WHERE id = ?');
    $checkIfSuiteExists->execute(array($idOfTheSuite));

    if($checkIfSuiteExists->rowCount() > 0){

        //Récupérer les infos de la cible
        $suiteInfos = $checkIfSuiteExists->fetch();
        if( $_SESSION['id_manager']){

            //Supprimer la cible en fonction de son id rentré en paramètre
           
            $deleteThisSuite = $bdd->prepare('DELETE FROM suite WHERE id = ?');
            $deleteThisSuite->execute(array($idOfTheSuite));

            //Rediriger l'utilisateur vers ses questions
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