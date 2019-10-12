<?php
    require_once("connection.php");

    session_start();
    if (!isset($_SESSION['login']))
        header("Location: sign_in.php");
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="favicon.png">
        <title>Uber Citadel</title>
    </head>
    <body>
        <a href="index.php">Return</a>
        <br>
        <p>
        <?php
            $sql = "SELECT * FROM documents WHERE id = ".$_GET['id'];
            $query = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($query);
            if (!mysqli_num_rows($query))
                echo "This document does not exist";
            elseif ($_SESSION['access'] < $row['access'])
                echo "Access denied";
            else
            {
                echo "<h1>".$row['title']."</h1><br>".$row['text'];
                $sql = "UPDATE documents SET `read` = now() WHERE id = ".$_GET['id'];
                $query = mysqli_query($con, $sql);
            }
        ?>
        </p>
    </body>
</html>
