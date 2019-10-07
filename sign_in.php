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

            <?php echo rand(1,8); ?>

            <div class="authenticationBox">
                <form method="post">
                    <div class="authenticationField">
                        Login<br>
                        <input type="text" name="login" size="16">
                    </div>
                    <div class="authenticationField">
                        Password<br>
                        <input type="password" name="password" size="16">
                    </div>
                    <button class="authenticationButton" type="submit" name="button">Submit</button>
                </form>
                <a href="sign_up.php">Sign up</a>
            </div>
        </div>
    </body>
</html>
