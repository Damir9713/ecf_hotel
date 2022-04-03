<?php

//Vérifier si l'utilisateur est authentifié au niveau du site
session_start();
if(!isset($_SESSION['id_admin'])){
    header('Location: ../../index.php');
}

// se connecter à la bdd
require('../database.php');

//Vérifier si l'id est rentré en paramètre dans l'URL
if(isset($_GET['id']) AND !empty($_GET['id'])){

    //L'id de la cible en paramète
    $idOfTheEstablishment = $_GET['id'];

    //Vérifier si la cible existe
    $checkIfEstablishmentExists = $bdd->prepare('SELECT id FROM establishment WHERE id = ?');
    $checkIfEstablishmentExists->execute(array($idOfTheEstablishment));

    if($checkIfEstablishmentExists->rowCount() > 0){

        //Récupérer les infos de la cible
        $establishmentInfos = $checkIfEstablishmentExists->fetch();
        if( $_SESSION['id_admin']){

            //Supprimer la cible en fonction de son id rentré en paramètre
           
            $deleteThisEstablishment = $bdd->prepare('DELETE FROM establishment WHERE id = ?');
            $deleteThisEstablishment->execute(array($idOfTheEstablishment));

            //Rediriger l'utilisateur
            header('Location: ../../establishmentAdmin.php');

        }else{
            echo "Vous n'avez pas le droit de supprimer cette établissement !";
        }

    }else{
        echo "Aucun établissement n'a été trouvée";
    }


}else{
    echo "Aucun établissement n'a été trouvée";
}