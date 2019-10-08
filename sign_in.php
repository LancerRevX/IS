<?php
    require_once("connection.php");
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
            <div class="authenticationBox">
                <form class="authenticationForm" method="post">
                    <div class="authenticationField">
                        Login<br>
                        <input type="text" name="login" size="16">
                    </div>
                    <div class="authenticationField">
                        Password<br>
                        <input type="password" name="password" size="16">
                    </div>
                    <button class="authenticationButton" type="submit" name="button">Submit</button>
                    <br><a href="sign_up.php">Sign up</a>
                </form>
            </div>
        </div>
    </body>
</html>
