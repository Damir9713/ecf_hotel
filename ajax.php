<?php
require('action/database.php');

if(!empty($_POST["id"])){ 
    // Fetch state data based on the specific country 
    $getList = $bdd->query("SELECT * FROM suite WHERE establishment_id = ".$_POST['id']); 
    
    // Generate HTML of state options list 
    if($getList->rowCount() > 0){ 
        echo '<option value="">Choisir une suite</option>'; 
        while($row = $getList->fetch()){  
            echo '<option value="'.$row['id'].'">'.$row['Title'].'</option>'; 
        } 
    }
}