<?php

function getPDO() {
    $host = '127.0.0.1';
    $port = '3306';
    $db = 'ekf_warriors';
    $user = 'user';
    $pass = 'password';

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;charset=utf8;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

function getAllWarriors() {
    $pdo = getPDO();

    $query = "SELECT * FROM warriors";
    $result = $pdo->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}
?>
