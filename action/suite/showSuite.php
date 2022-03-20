<?php
require("action/database.php");
$getSuiteInfo = $bdd->query('SELECT * FROM suite
inner join manager on manager.manager_id = suite.manager_id


where suite.manager_id='.$_SESSION['id_manager']);

$getImageInfo = $bdd->query('SELECT * FROM firstphoto
inner join suite on firstphoto.suite_id = suite.id
inner join secondphoto on secondphoto.suite_id = suite.id
inner join thirdphoto on thirdphoto.suite_id = suite.id

where suite.id');

 ?>

