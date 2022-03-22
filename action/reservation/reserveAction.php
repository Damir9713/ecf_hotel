<?php

// se connecter à la bdd
require('action/database.php');

//Valider le formulaire
if(isset($_POST['valider'])){

    //Vérifier si les champs ne sont pas vides
    if(!empty($_POST['establishment']) 
    AND !empty($_POST['suite']) 
    AND !empty($_POST['beginning'])  
    AND !empty($_POST['ending']) 
     )
    {
        
        
        //Les données à faire passer dans la requête
        $new_reservation_establishment = htmlspecialchars($_POST['establishment']);
        $new_reservation_suite = htmlspecialchars($_POST['suite']);
        $new_reservation_customer = $_SESSION['id_customer'];
        $new_reservation_beginning = htmlspecialchars($_POST['beginning']);
        $new_reservation_ending = htmlspecialchars($_POST['ending']);
        
              //Insérer le manager sur la bdd
        $insertReservationOnWebsite = $bdd->prepare('INSERT INTO reservation(establishment_id, 
        suite_id, 
        customer_id, 
        beginningDate,
        endingDate
        ) VALUES(?, ?, ?, ?, ?)');
        
        $insertReservationOnWebsite->execute(
            array(
             $new_reservation_establishment,
             $new_reservation_suite,
             $new_reservation_customer,
             $new_reservation_beginning,
             $new_reservation_ending
            
            )
        );
    
        
        $successMsg = "Votre reservation a bien été ajoutée ";
        header('Location: myReservation.php');
        }else{
            $errorMsg = "Veuillez remplir tout les champs";
        }
}