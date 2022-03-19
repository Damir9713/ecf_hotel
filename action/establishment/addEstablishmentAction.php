<?php 

require("action/database.php");

$photo = "";

if(isset($_POST['valider'])){

  if(!empty($_POST['name'])
    AND !empty($_POST['city']) 
    AND !empty($_POST['adress'])  
    AND !empty($_POST['description']) 
  ){

    $name = htmlspecialchars($_POST['name']);
    $description = nl2br(htmlspecialchars($_POST['description']));
    $city = htmlspecialchars($_POST['city']);
    $adress = htmlspecialchars($_POST['adress']);


    $photo = $_FILES['images']['name'];
    $upload = "upload/".$photo;

    move_uploaded_file($_FILES['images']['tmp_name'], $upload);

    $insertImage = $bdd->prepare('INSERT INTO establishment(name, 
    city, 
    adress, 
    description, 
    photo
    ) VALUES(?, ?, ?, ?, ?)');

$insertImage->execute(
    array(
     $name,
     $city,
     $adress,
     $description,
     $photo
    
    )
);
$sucessMsg = "Votre établissement a bien été ajoutée ";
header('Location: index.php');
}else{
  $errorMsg = "Veuillez remplir tout les champs";
}
}
?>