<?php
    require_once("connection.php");

    session_start();
    if (!isset($_SESSION['login']))
        header("Location: sign_in.php");
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
        <a id="create" href="create.php">Create document</a>
        <a id="logout" href="logout.php">Logout</a>
        <div style="padding: 0 16px;">
        <?php
            $sql = "SELECT * FROM documents WHERE access <= '".$_SESSION['access']."'";
            $query = mysqli_query($con, $sql);
            if (mysqli_num_rows($query) == 0)
                echo "<br><p>No documents</p>";
            else
            {
                echo "
                <table class='documentsTable' border='1'>
                    <tr>
                        <td>id</td>
                        <td>title</td>
                        <td>author</td>
                        <td>access</td>
                        <td>created</td>
                        <td>edited</td>
                        <td>read</td>
                        <td>actions</td>
                        </tr>
                ";
                while ($row = mysqli_fetch_array($query))
                {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['title']."</td>";
                    echo "<td>".$row['author']."</td>";
                    echo "<td>".$row['access']."</td>";
                    echo "<td>".$row['created']."</td>";
                    echo "<td>".$row['edited']."</td>";
                    echo "<td>".$row['read']."</td>";
                    echo "
                    <td>
                    <a href='read.php?id=".$row['id']."'>Read</a>
                    <a href='edit.php?id=".$row['id']."'>Edit</a>
                    </td>";
                    echo "</tr></table>";
                }
            }
        ?>
        </div>
    </body>
</html>
