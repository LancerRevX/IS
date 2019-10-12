<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("Location: sign_in.php");
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <title>Uber Citadel</title>
    </head>
    <body>
        <a id="logout" href="logout.php">Logout</a>
        <br>
        <a id="create" href="create.php">Create document</a>
        <table border="1">
            <tr>
                <td>id</td>
                <td>title</td>
                <td>author</td>
                <td>access</td>
                <td>created</td>
                <td>edited</td>
            </tr>
        </table>
    </body>
</html>
