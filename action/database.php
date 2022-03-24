<?php
try{
    $bdd = new PDO('mysql:host=eu-cdbr-west-02.cleardb.net;dbname=heroku_8da5ba2c697fa10;charset=utf8;', 'b2b83e7814e0cb', '10a7d6bc');
}catch(Exception $e){
    die('Une erreur a été trouvée : ' . $e->getMessage());
}
