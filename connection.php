<?php

function connection()
{
    $host = "localhost";
    $user = "root";
    $pass = "XXXXX";
    $db = "crud-php";

    // Crea una nueva instancia de PDO
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);

    // Configura PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Devuelve la instancia de PDO
    return $pdo;
}
