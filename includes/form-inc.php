<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once "dbh-inc.php";

        $query = "INSERT INTO users (username, pwd, email) 
        VALUES (?, ?, ?);";

        $stmt = $pdo-> prepare($query);

        $stmt->execute([$username, $pwd, $email]);

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

        die();

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}