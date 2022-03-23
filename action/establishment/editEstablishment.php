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


    $type_file = $_FILES['images']['type'];     
    if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') ) {     
      exit ("Le fichier n'est pas une image");
    }
    
    $photo = $_FILES['images']['name'];
    $extensions = ['png', 'jpg', 'jpeg'];
    $uniqueName = uniqid('', true);
    $file = $uniqueName.".".strtolower(end($extensions));
    $upload = "upload/".$file;
    move_uploaded_file($_FILES['images']['tmp_name'], $upload);

    $insertImage = $bdd->prepare('UPDATE establishment 
    SET name = ?, 
    city = ?, 
    adress = ?, 
    description = ?, 
    photo = ?  
    WHERE id = ?');

$insertImage->execute(
    array(
     $name,
     $city,
     $adress,
     $description,
     $file,
     $idOfEstablishment
    )
);
$sucessMsg = "Votre établissement a bien été ajoutée ";
header('Location: establishmentAdmin.php');
  
}else{
  $errorMsg = "Veuillez remplir tout les champs";
}
}
?>  

