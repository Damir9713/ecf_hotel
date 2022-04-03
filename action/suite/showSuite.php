<?php
require("action/database.php");

$getSuiteInfo = $bdd->prepare('SELECT * FROM suite
inner join manager on manager.manager_id = suite.manager_id
where suite.manager_id = ? ');
$getSuiteInfo->execute(array($_SESSION['id_manager']));

