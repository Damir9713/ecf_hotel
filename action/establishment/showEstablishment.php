<?php
require("action/database.php");

$getEstablishmentInfo = $bdd->prepare('SELECT * FROM establishment

ORDER BY id ');
$getEstablishmentInfo->execute();

?>
