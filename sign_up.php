<?php
    require_once("connection.php");

    function isLoginCorrect($login)
    {
        if (empty($login)) return false;

        return true;
    }

    session_start();
    if (isset($_SESSION['login']))
        header("Location: index.php");

    $message = "";
    if (isset($_POST['submit']))
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (empty($login) && empty($password) && empty($_POST['password2']))
            $message = "Fill all fields";
        elseif (!isLoginCorrect($login))
            $message = "Incorrent login";
        elseif ($password != $_POST['password2'])
            $message = "Passwords don't match";
        else
        {
            $sql = "SELECT * FROM users WHERE login = '".$login."'";
            $query = mysqli_query($con, $sql) or trigger_error(mysqli_error($con));
            $numRows = mysqli_num_rows($query);
            if ($numRows == 0)
            {
                $sql = "INSERT INTO users (login, password) VALUES('$login', '$password')";
                $result = mysqli_query($con, $sql);
                if (!$result)
                    $message = "Failed to insert user data";
                else
                    $message = "User created";
            }
            else
                $message = "That login already exists";
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
        <div class="authenticationBlock">

            <?=$message;?>

            <form class="authenticationForm" method="post">
                <div class="authenticationField">
                    Login<br>
                    <input type="text" name="login" size="16" value="">
                </div>
                <div class="authenticationField">
                    Password<br>
                    <input type="password" name="password" size="16" value="">
                </div>
                <div class="authenticationField">
                    Repeat<br>
                    <input type="password" name="password2" size="16" value="">
                </div>
                <button class="authenticationButton" type="submit" name="submit">Submit</button>
                <br><a href="sign_in.php">Sign in</a>
            </form>
        </div>
    </body>
</html>
