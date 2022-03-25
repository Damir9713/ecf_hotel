<?php 
session_start();
require('action/securityAdmin.php');
require('action/establishment/getInfoOfEditedEstablishment.php');
// require('action/establishment/editEstablishment.php');
require 'vendor/autoload.php';
$link = ("https://hotelhypnos.s3.eu-west-3.amazonaws.com/");
use Aws\S3\S3Client;

?>




<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>

    <br><br>
    <div class="container">
        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>';} 



        ?>


        
        <?php 
            if(isset($_SESSION['id_admin'])){ 
                ?>
                <form  action="<?php $_SERVER['PHP_SELF'] ?>" class="container" method="post" enctype="multipart/form-data">
      <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom</label>
                <input type="text" class="form-control" name="name" value="<?= $establishment_name; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ville</label>
                <input type="text" class="form-control" name="city" value="<?= $establishment_city; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">adress</label>
                <input type="text" class="form-control" name="adress" value="<?= $establishment_adress; ?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">description</label>
                <textarea class="form-control" name="description" ><?= $establishment_description; ?></textarea>
            </div>
            
            <div class="mb-3">
              <input type="file" name="images">

            </div>
            
            <button type="submit" class="btn btn-outline-warning" name="valider">Modifier l'établissement</button>
                 
                    <br><br>
            </form>
            
                
                <?php
            }
        ?>



<?php 

require("action/database.php");



if(isset($_POST['valider'])){

  
  $type_file = $_FILES['images']['type'];     
  if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') ) {    
    exit ("Le fichier n'est pas une image");
  }

 


  $extensions = ['png', 'jpg', 'gif', 'jpeg'];
  $photo = $_FILES['images']['name'];
  $typeExtension ='.'.strtolower(substr(strrchr($photo, '.'),1));
  $uniqueName = uniqid('', true);
  $file = $uniqueName.".".$typeExtension;
  $upload = "upload/".$file;
  // move_uploaded_file($_FILES['images']['tmp_name'], $upload);

  $fileDir = $_FILES["images"]['tmp_name'];

  $bucketName = 'hotelhypnos';
	$IAM_KEY = 'AKIAUNFIAS2JOT26HUPX';
	$IAM_SECRET = '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';

	// Connect to AWS
	try {
		// You may need to change the region. It will say in the URL when the bucket is open
		// and on creation.
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'eu-west-3'
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
		die("Error: " . $e->getMessage());
	}

	
	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
	$keyName =  $uniqueName.".".$typeExtension;
	$pathInS3 = 'https://s3.eu-west-3.amazonaws.com/' . $bucketName . '/' . $keyName;

	// Add it to S3
	try {
		// Uploaded:
		
    

		$s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' => $keyName,
				'SourceFile' => $fileDir,
        'StorageClass' => 'REDUCED_REDUNDANCY',
        'ACL'    => 'public-read',
        
			)
		);

	} catch (S3Exception $e) {
		die('Error:' . $e->getMessage());
	} catch (Exception $e) {
		die('Error:' . $e->getMessage());
	}


	echo 'Image envoyé';




  if(!empty($_POST['name'])
    AND !empty($_POST['city']) 
    AND !empty($_POST['adress'])  
    AND !empty($_POST['description']) 
  ){

    $name = htmlspecialchars($_POST['name']);
    $description = nl2br(htmlspecialchars($_POST['description']));
    $city = htmlspecialchars($_POST['city']);
    $adress = htmlspecialchars($_POST['adress']);


   
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

<?php 

$sql = $bdd->prepare('SELECT * FROM establishment where id = 1');
$sql->execute();

while($img = $sql->fetch()){
  ?>
    <img src="https://hotelhypnos.s3.eu-west-3.amazonaws.com/<?php echo $img['photo'];?>" alt="" width="200" class="img-fluid">
  <?php
}

?> 
                      
        </div>
</body>
</html>




