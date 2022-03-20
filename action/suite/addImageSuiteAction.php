<?php 

require("action/database.php");

$suite_list = $bdd->query('SELECT * FROM suite
inner join manager on manager.manager_id = suite.manager_id

where suite.manager_id='.$_SESSION['id_manager']);


$photo = "";
$photo1 = "";
$photo2 = "";

if(isset($_POST['valider'])){

 

    $suite = htmlspecialchars($_POST['suite']);
    


    $photo = $_FILES['firstphoto']['name'];
    $upload = "upload/".$photo;

    move_uploaded_file($_FILES['images']['tmp_name'], $upload);

    $photo1 = $_FILES['secondphoto']['name'];
    $upload1 = "upload/".$photo1;

    move_uploaded_file($_FILES['images']['tmp_name'], $upload1);

    $photo2 = $_FILES['thirdphoto']['name'];
    $upload2 = "upload/".$photo2;

    move_uploaded_file($_FILES['images']['tmp_name'], $upload2);

    $insertImage = $bdd->prepare('INSERT INTO firstphoto(firstimage, 
    suite_id
    ) VALUES(?, ?)');

$insertImage->execute(
    array(
     $photo,
     $suite
    )
);

$insertImage = $bdd->prepare('INSERT INTO secondphoto(secondimage, 
suite_id
) VALUES(?, ?)');

$insertImage->execute(
array(
 $photo1,
 $suite
)
);

$insertImage = $bdd->prepare('INSERT INTO thirdphoto(thirdimage, 
suite_id
) VALUES(?, ?)');

$insertImage->execute(
array(
 $photo2,
 $suite
)
);
$sucessMsg = "Vos images ont bien été ajoutées ";
header('Location: suiteManager.php');

}
?>