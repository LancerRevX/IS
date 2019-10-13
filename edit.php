<?php
    require_once("connection.php");

    session_start();
    if (!isset($_SESSION['login']))
        header("Location: sign_in.php");

    if (!isset($_GET['id']))
        header("Location: index.php");

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
        <a href="index.php">Return</a>
        <br>
        <?php
            $sql = "SELECT * FROM documents WHERE id = ".$_GET['id'];
            $query = mysqli_query($con, $sql);
            if (!mysqli_num_rows($query))
                echo "<p>This document does not exist</p>";
            elseif ($_SESSION['access'] < mysqli_fetch_array($query)['access'])
                echo "<p>Access denied</p>";
            else
            {
                $row = mysqli_fetch_array($query);
                echo "
                <form class='editForm' method='post'>
                    <div class=''
                    Title <input type='text' name='title' size=32 value='".$row['title']."'>
                    Access
                ";
                switch ($_SESSION['access'])
                {
                    case 'A':
                    echo "
                        A <input type='radio' name='access' value='A' checked>
                    ";
                    break;

                    case 'B':
                    echo "
                        A <input type='radio' name='access' value='A'>
                        B <input type='radio' name='access' value='B' checked>
                    ";
                    break;

                    case 'C':
                    echo "
                        A <input type='radio' name='access' value='A'>
                        B <input type='radio' name='access' value='B'>
                        C <input type='radio' name='access' value='C' checked>
                    ";
                    break;
                }
                echo "
                    <textarea name='text'>".$row['text']."</textarea>
                    <button type='submit' name='submit'>Submit</button>
                </form>
                ";
            }
        ?>
    </body>
</html>
