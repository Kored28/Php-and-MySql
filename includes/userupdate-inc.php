<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once "dbh-inc.php";

        $query = "UPDATE users SET username = ?, pwd = ?, email = ?
        WHERE id = 6;";

        $stmt = $pdo-> prepare($query);

        // $stmt->bindParam(":username", $username);
        // $stmt->bindParam(":pwd", $pwd);
        // $stmt->bindParam(":email", $email);

        $stmt->execute([$username, $pwd, $email]);

        $pdo = null;
        $stmt = null;

        header("Location: ../update.php");

        die();

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}