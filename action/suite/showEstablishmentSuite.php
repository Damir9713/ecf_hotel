<?php
require("action/database.php");
$getSuiteInfo = $bdd->query('SELECT * FROM suite
inner join establishment on suite.establishment_id = establishment.id


where suite.establishment_id='.$_GET['id']);


