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
    $idOfTheMessage = $_GET['id'];

    //Vérifier si la cible existe
    $checkIfMessageExists = $bdd->prepare('SELECT id FROM contactmessage WHERE id = ?');
    $checkIfMessageExists->execute(array($idOfTheMessage));

    if($checkIfMessageExists->rowCount() > 0){

        //Récupérer les infos de la cible
        $messageInfos = $checkIfMessageExists->fetch();
        if( $_SESSION['id_admin']){

            //Supprimer la cible en fonction de son id rentré en paramètre
           
            $deleteThisMessage = $bdd->prepare('DELETE FROM contactmessage WHERE id = ?');
            $deleteThisMessage->execute(array($idOfTheMessage));

            //Rediriger l'utilisateur vers ses questions
            header('Location: ../../showMessage.php');

        }else{
            echo "Vous n'avez pas le droit de supprimer ce message !";
        }

    }else{
        echo "Aucun message n'a été trouvée";
    }


}else{
    echo "Aucun message n'a été trouvée";
}