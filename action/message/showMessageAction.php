<?php
require("action/database.php");

$getMessageInfo = $bdd->prepare('SELECT * FROM contactmessage
order by id');
$getMessageInfo->execute();
?>