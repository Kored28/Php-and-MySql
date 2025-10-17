<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userSearch = $_POST["usersearch"];


    try {
        require_once "includes/dbh-inc.php";

        $query = "SELECT * FROM comments WHERE username = :usersearch";

        $stmt = $pdo-> prepare($query);

        $stmt->bindParam(":usersearch", $userSearch);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;


    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../select.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Select Data</title>
</head>
<body>
    
    <h3>Search Results</h3>

    <?php

        if(empty($results)){
            $empty = <<<TEXT
                <div class='empty'>
                    <p> There were no results </p> 
                </div>
            TEXT;
            echo $empty;
        } else {
            foreach ($results as $row ) {
                $username = htmlspecialchars($row["username"]);
                $comment_text = htmlspecialchars($row["comment_text"]);
                $created_at = htmlspecialchars($row["created_at"]);
                $success = <<<TEXT
                    <div class='success'>
                        <h4> {$username} </h4>
                        <p class='comment'> {$comment_text} </p>
                        <p> {$created_at} </p>
                    </div>
                TEXT;
                echo $success;
            }
        }
    ?>

</body>
</html>