<?php 
$dsn = "mysql:host=localhost;dbname=boutique_en_ligne";
$username = "franck";
$password = "arinfo2021";
$option = [];
$connection = new PDO ($dsn, $username, $password, $option);

try {
    print "Connexion réussie";
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
?>