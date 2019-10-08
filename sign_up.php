<?php
    require_once("connection.php");

    function isLoginCorrect($login)
    {
        if (empty($login)) return false;

        return true;
    }

    function isPasswordCorret($password)
    {
        if (empty($password)) return false;

        return true;
    }

    $message = "";
    if (isset($_POST['submit']))
    {
        echo "worked";
        if (isLoginCorrect($_POST['login']) && isPasswordCorret($_POST['password']))
        {
            if ($_POST['password2'] == $_POST['password'])
            {
                $login = $_POST['login'];
                $password = $_POST['password'];
                $sql = "SELECT * FROM users WHERE login = '".$login."'";
                $query = mysqli_query($con, $sql) or trigger_error(mysqli_error($con));
                $numRows = mysqli_num_rows($query);
                if ($numRows == 0)
                {
                    $sql = "INSERT INTO users (login, password) VALUES('$login', '$password')";
                    $result = mysqli_query($con, $sql);
                    if (!$result)
                    {
                        $message = "Failed to insert user data";
                    }
                    else
                    {
                        header("Location: /");
                    }
                }
                else
                {
                    $message = "That login already exists";
                }
            }
            else
            {
                $message = "Passwords don't match";
            }
        }
        else
        {
            $message = "Fill all the fields";
        }
        header("Location: sign_up.php");
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

            <?php echo $message, " ", $_POST['login'], " ", $_POST['password']; ?>

            <form class="authenticationForm" method="post" action="">
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
