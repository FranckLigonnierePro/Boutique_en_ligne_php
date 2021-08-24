<?php 
$dbhost = "localhost";
$username = "franck";
$password = "arinfo2021";
$dbname = "boutique_en_ligne";
if(!$con = mysqli_connect($dbhost, $username, $password, $dbname))
{
    die("failed to connect!");
}

?>