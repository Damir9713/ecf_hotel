<?php
require("action/database.php");


// $getEstablishmentInfo = $bdd->query('SELECT * FROM establishment

// ORDER BY id ');

$getEstablishmentInfo = $bdd->prepare('SELECT * FROM establishment

ORDER BY id ');
$getEstablishmentInfo->execute();

?>
