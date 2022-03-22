<?php
require("action/database.php");
$getMyReservation = $bdd->query('SELECT * FROM reservation
inner join customer on reservation.customer_id = customer.id
inner join establishment on reservation.establishment_id = establishment.id
inner join suite on reservation.suite_id = suite.suite_id

where reservation.customer_id='.$_SESSION['id_customer']);
