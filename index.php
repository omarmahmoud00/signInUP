<?php
    session_start(); 
    if(isset($_SESSION["user_id"])){
        $mysqli = require __DIR__ . "/dataBase.php";
        $sql = "SELECT * FROM user 
             WHERE id = {$_SESSION["user_id"]}";

        $result = $mysqli->query($sql);
        $user = $result ->fetch_assoc();
                    }else {
                        $user = null;
                    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
</head>
<body>
    <h1>home</h1>
    <?php if ( $user):  ?>
        <p>hello <?= htmlspecialchars( $user["name"])  ?> </p>
        <p><a href="logout.php">log out</a></p>

    <?php else:   ?>
        <p><a href="login.php">login</a> or <a href="signup.html">signup</a></p>
    <?php endif; ?>
</body>
</html>