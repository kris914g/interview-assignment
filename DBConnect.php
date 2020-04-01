<?php

function connect() {

    //Connection details
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "interview-assignment";

    try {
        //Assigning Data Source Name
        $dsn = "mysql:host=$host; dbname=$database;charset=utf8mb4";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connection successfully";

        return $pdo;

        //Catching any PDO error
    } catch (PDOException $e){
        die("Connection failed! " . $e->getMessage());
    }
}