<?php
require("action/database.php");

$getSuiteInfo = $bdd->prepare('SELECT * FROM suite
inner join establishment on suite.establishment_id = establishment.id
where suite.establishment_id= ?');
$getSuiteInfo->execute(array($_GET['id']));


