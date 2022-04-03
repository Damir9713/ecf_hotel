<?php
require('action/database.php');


if(!empty($_POST["id"])){ 
    // Fetch state data based on the specific establishment 
    $getList = $bdd->prepare("SELECT * FROM suite WHERE establishment_id = ?"); 
    $getList->execute(array($_POST['id']));
    

    // Generate HTML of establishment options list 
    if($getList->rowCount() > 0){ 
        echo '<option value="">Choisir une suite</option>'; 
        while($row = $getList->fetch()){  
            echo '<option value="'.$row['suite_id'].'">'.$row['Title'].'</option>'; 
        } 
    }
}

if(isset($_POST["debut"], $_POST["fin"], $_POST["suite_id"])) {


    $debut = $_POST["debut"];
    $fin = $_POST["fin"];
    $suite_id = $_POST["suite_id"];

    $checkAvailabilityDate = $bdd->prepare("SELECT COUNT(*) FROM reservation

    inner join suite on reservation.suite_id = suite.suite_id
    and '$debut' < endingDate
    and '$fin' > beginningDate
    where reservation.suite_id = '$suite_id'
     ");
     $checkAvailabilityDate->execute();
        if($checkAvailabilityDate->fetchColumn() == 0){ 
        echo '<p>La suite est disponible</p>'; 
    }else{
        echo '<p>La suite est déja réservé à cette date , veuillez choisir une autre date</p>'; 
    }

}




  
  
  
  
  
    
     
      
