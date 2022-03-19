<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8;', 'root', 'grimmjow9713');
}catch(Exception $e){
    die('Une erreur a été trouvée : ' . $e->getMessage());
}
