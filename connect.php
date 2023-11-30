<?php

//
//
//
//    $db = new mysqli($host, $user, $password, $db, $port);

$host = 'localhost';
$dbname = 'Users';
$user = 'root';
$password = 'Aa220377';
$port = 3306;

// База на сервере
//$host = 'localhost';
//$dbname = 'shilova';
//$user = 'shilova';
//$password = 'shilova1800';
//$port = 3306;

try {
    $dsn = "mysql:host=$host;dbname=$dbname;port=$port";
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo "Failed to connect: " . $e->getMessage();
}