<?php
    require_once("connection.php");

    session_start();
    if (!isset($_SESSION['login']))
        header("Location: sign_in.php");

    $message = "";
    $title = "";
    $text = "";
    if (isset($_POST['submit']))
    {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $access = $_POST['access'];
        if (empty($title) || empty($text) || $access > $_SESSION['access'] || $access < 'A')
            $message = "Fill all fields";
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
        <?php if (!empty($message)) echo "<br>".$message; ?>
        <form class='editForm' method='post'>
            Title <input style='margin-top: 16px' type='text' name='title' size=32>
            Access
            <?php
            switch ($_SESSION['access'])
            {
                case 'A':
                echo "
                    A <input style='margin-top: 16px' type='radio' name='access' value='A' checked>
                ";
                break;

                case 'B':
                echo "
                    A <input style='margin-top: 16px' type='radio' name='access' value='A'>
                    B <input style='margin-top: 16px' type='radio' name='access' value='B' checked>
                ";
                break;

                case 'C':
                echo "
                    A <input style='margin-top: 16px' type='radio' name='access' value='A'>
                    B <input style='margin-top: 16px' type='radio' name='access' value='B'>
                    C <input style='margin-top: 16px' type='radio' name='access' value='C' checked>
                ";
                break;
            }
            ?>
            <textarea name='text'></textarea>
            <button type='submit' name='submit'>Submit</button>
        </form>
    </body>
</html>
