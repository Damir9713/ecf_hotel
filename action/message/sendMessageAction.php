<?php 

require("action/database.php");



if(isset($_POST['valider'])){

 


  if(!empty($_POST['firstname'])
    AND !empty($_POST['lastname']) 
    AND !empty($_POST['email'])
    AND !empty($_POST['subject']) 
    AND !empty($_POST['description'])
  )
  {

    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = nl2br(htmlspecialchars($_POST['lastname']));
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $description = htmlspecialchars(nl2br($_POST['description']));

    
    $sendMessage = $bdd->prepare('INSERT INTO contactmessage(subject, 
    description, 
    firstname, 
    lastname, 
    email
    ) VALUES(?, ?, ?, ?, ?)');

    $sendMessage->execute(
    array(
     $subject,
     $description,
     $firstname,
     $lastname,
     $email
    
    )
    );
    $sucessMsg = "Votre message a bien été envoyé ";
}else{
  $errorMsg = "Veuillez remplir tout les champs";
}

}
