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

function deleteWarrior($id) {
    $pdo = getPDO();

    $query = "DELETE FROM warriors WHERE id = :id";

    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
}

function resetAll() {
    $pdo = getPDO();
    $query = "DROP TABLE IF EXISTS warriors";
    $statement = $pdo->prepare($query);
    $statement->execute();
}

function createWarrior($first_name, $last_name, $grade, $description, $image_link) {
    try {
        $pdo = getPDO();

        $query = "INSERT INTO warriors (first_name, last_name, grade, description, image_link) VALUES (:first_name, :last_name, :grade, :description, :image_link)";
        $statement = $pdo->prepare($query);

        $statement->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $statement->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $statement->bindParam(':grade', $grade, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':image_link', $image_link, PDO::PARAM_STR);

        $statement->execute();
        return true;

    } catch (PDOException $e) {
        return false;
    }
}

function getWarriorById($id) {
    $pdo = getPDO();
    $query = "SELECT * FROM warriors WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function updateWarrior($id, $first_name, $last_name, $grade, $description) {
    try {
        $pdo = getPDO();

        $query = "UPDATE warriors SET first_name = :first_name, last_name = :last_name, grade = :grade, description = :description WHERE id = :id";
        $statement = $pdo->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $statement->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $statement->bindParam(':grade', $grade, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);

        $statement->execute();
        return true;

    } catch (PDOException $e) {
        return false;
    }
}

?>
