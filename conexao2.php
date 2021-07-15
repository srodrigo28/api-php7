<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "celke";
$porta = "3307";

//$conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
try{
    $conn = new PDO("mysql:host=$host;port=$porta;dbname=" . $dbname, $user, $pass);
}catch(PDOException $e){
    echo $e;
}