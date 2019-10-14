<?php
    require_once("connection.php");

    session_start();
    if (!isset($_SESSION['login']))
        header("Location: sign_in.php");

    if (isset($_POST['submit']))
    {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $access = $_POST['access'];
        if (empty($title) || empty($text) || $access > $_SESSION['access'] || $access < 'A')
            header("Location: ".$_SERVER['REQUEST_URI']);
        else
        {
            $sql = "UPDATE documents SET title = '".$title."', text = '".$text."', access = '".$access."', edited = now() WHERE id = ".$_GET['id'];
            $query = mysqli_query($con, $sql);
            header("Location: index.php");
        }
    }
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
        <div style="margin-top: 16px;">
            <a href="index.php">Return</a>
        </div>
        <form class="editForm">
            <div>
                Title
                <input type="text" name="title" value="New Document">
                Access
                <label for="A">A</label>
                <input id="A" type="radio" name="access" value="A" checked>
                <label for="B">B</label>
                <input id="B" type="radio" name="access" value="B">
                <label for="C">C</label>
                <input id="C" type="radio" name="access" value="C">
            </div>
            <textarea name="text" spellcheck="false">Text</textarea>
            <div>
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </body>
</html>
