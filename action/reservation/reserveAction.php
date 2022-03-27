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
        $new_reservation_establishment = htmlspecialchars($_POST['establishment']);
        $new_reservation_suite = htmlspecialchars($_POST['suite']);
        $new_reservation_customer = $_SESSION['id_customer'];
        $new_reservation_beginning = htmlspecialchars($_POST['beginning']);
        $new_reservation_ending = htmlspecialchars($_POST['ending']);

        $getDate = $bdd->prepare("SELECT DISTINCT * FROM reservation
        WHERE reservation.suite_id = '$new_reservation_suite'
        ");
        $getDate->execute();

        $reservation = $getDate->fetch();
        $beginning = $reservation['beginningDate'];
        $ending = $reservation['endingDate'];
            
     $checkAvailability = $bdd->prepare("SELECT DISTINCT * FROM reservation
     LEFT JOIN establishment  on reservation.establishment_id = establishment.id
    LEFT JOIN suite  on reservation.suite_id  = suite.suite_id
     WHERE reservation.suite_id = '$new_reservation_suite'
     AND endingDate BETWEEN '$beginning' AND '$ending'
     AND beginningDate BETWEEN '$beginning' AND '$ending'

     ");
     $checkAvailability->execute();
     
     
        if($checkAvailability->rowCount() == 0){
        $insertReservationOnWebsite = $bdd->prepare('INSERT INTO reservation
        (establishment_id, 
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

            
            header('Location: myReservation.php');
            $successMsg = "Votre reservation a bien été ajoutée ";
        }else{
            $errorMsg = "Cette suite n'est pas disponible à cette date";
            
        }
        
        
        }else{
            $errorMsg = "Veuillez remplir tout les champs";
        }
        
}