<?php
require("action/database.php");

$getManagerInfo = $bdd->prepare('SELECT * FROM manager
inner join establishment on manager.establishment_id = establishment.id
where manager.manager_id= ?');
$getManagerInfo->execute(array($_SESSION['id_manager']));


