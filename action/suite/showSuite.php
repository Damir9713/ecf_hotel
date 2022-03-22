<?php
require("action/database.php");

// $getSuiteInfo = $bdd->query('SELECT * FROM suite
// inner join manager on manager.manager_id = suite.manager_id


// where suite.manager_id='.$_SESSION['id_manager']);

$getSuiteInfo = $bdd->prepare('SELECT * FROM suite
inner join manager on manager.manager_id = suite.manager_id


where suite.manager_id = ? ');
$getSuiteInfo->execute(array($_SESSION['id_manager']));

