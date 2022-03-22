<?php
require("action/database.php");
// $getManagerInfo = $bdd->query('SELECT * FROM manager
// inner join establishment on manager.establishment_id = establishment.id

// where manager.manager_id ');

$getManagerInfo = $bdd->prepare('SELECT * FROM manager
inner join establishment on manager.establishment_id = establishment.id

where manager.manager_id');
$getManagerInfo->execute();
?>