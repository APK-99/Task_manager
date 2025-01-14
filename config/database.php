<?php
// config/database.php

function getConnection()
{
    $host = '127.0.0.1';
    $dbname = 'tm'; // replace with your database name
    $username = 'root';       // replace with your database username
    $password = '';           // replace with your database password

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Could not connect to the database: " . $e->getMessage());
    }
}
