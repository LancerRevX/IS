<?php
    require_once("connection.php");

    session_start();
    if (isset($_SESSION['login']))
        header("Location: index.php");

    $message = "";
    if (isset($_POST['submit']))
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (empty($login) || empty($password))
            $message = "Fill all fields";
        else
        {
            $sql = "SELECT * FROM users WHERE login = '".$login."' AND password = '".$password."'";
            $query = mysqli_query($con, $sql);
            if (mysqli_num_rows($query) != 0)
            {
                $_SESSION['login'] = $login;
                header("Location: index.php");
            }
            else
            {
                $message = "Invalid login or password";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <title>Uber Citadel</title>
    </head>
    <body>
        <div class="authenticationBlock">

            <?=$message;?>

            <form class="authenticationForm" method="post">
                <div class="authenticationField">
                    Login<br>
                    <input type="text" name="login" size="16">
                </div>
                <div class="authenticationField">
                    Password<br>
                    <input type="password" name="password" size="16">
                </div>
                <button class="authenticationButton" type="submit" name="submit">Submit</button>
                <br><a href="sign_up.php">Sign up</a>
            </form>
        </div>
    </body>
</html>
