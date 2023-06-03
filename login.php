<?php

$is_valid=false;
         if($_SERVER["REQUEST_METHOD"]==="POST"){
            echo $_POST["email"];
            $mysqli = require __DIR__ . "/dataBase.php";
            $sql = sprintf("SELECT * FROM user 
                            WHERE email = '%s' ",
                             $mysqli->real_escape_string($_POST["email"])
                            );

            $result = $mysqli->query($sql);
            $user = $result ->fetch_assoc();
            
            if($user){
                if(password_verify($_POST["password"],$user["password_hash"])){
                    session_start();
                    $_SESSION["user_id"] = $user["id"];
                    session_regenerate_id();
                    header("Location: index.php ");
                    exit();
                }
            }          

            $is_valid = true;
         } 

      

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
</head>
<body>
     
      <h1>login</h1>
      <?php if($is_valid): ?>
        <em>login is invalid</em>
        <?php endif; ?>
     <form method = "post">
        <label for="email">email</label>
        <input type="email" id="email" name="email"
        value="<?=  htmlspecialchars($_POST["email"] ?? "") ?>">

        <label for="password">password</label>
        <input type="password" id="password" name="password">
        <button>log in</button>
     </form>
    
</body>
</html>