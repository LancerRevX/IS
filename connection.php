<?php
    require("constants.php");

    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
    mysqli_select_db($con, DB_NAME) or die("Could not select database");
?>
