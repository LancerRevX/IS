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
    else
    {
        $sql = "SELECT * FROM documents WHERE id = ".$_GET['id'];
        $query = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($query);
        if (!mysqli_num_rows($query) || $row['access'] != $_SESSION['access'])
            header("Location: ".$_SERVER['PHP_SELF']);
        $checked = array('A' => '', 'B' => '', 'C' => '');
        $checked[$row['access']] = "checked";
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
                <input type="text" name="title" value="<?=$row['title']?>">
                Access
                <label for="A">A</label>
                <input id="A" type="radio" name="access" value="A" <?=$checked['A']?>>
                <label for="B">B</label>
                <input id="B" type="radio" name="access" value="B" <?=$checked['B']?>>
                <label for="C">C</label>
                <input id="C" type="radio" name="access" value="C" <?=$checked['C']?>>
            </div>
            <textarea name="text" spellcheck="false"><?=$row['text']?></textarea>
            <div>
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </body>
</html>
