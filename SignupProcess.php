<?php
       
    if(empty($_POST["name"])){
         die("the name is required");
    }

    if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      die("email not valid");
    }

    if (! preg_match("/^5\d{9}$/", $_POST["phone"])){
      die("not valid number");
    }

    if(strlen($_POST["password"])<8){
      die("password must be at least 8 characters");
    }

    if(! preg_match("/[a-z]/", $_POST["password"])){
      die("password must contain at least 1 letter");
    }

    if(! preg_match("/[0-9]/", $_POST["password"])){
      die("password must contain at least 1 number");
    }

    if($_POST["password"]!==$_POST["Repeated_password"]){
      die("password must match");
    }
 
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    
    $mysqli = require __DIR__ . "/dataBase.php";

    $sql = "INSERT INTO user (name,email,password_hash,phone) 
            VALUES ( ? ,?,?,?) ";

    $stm = $mysqli->stmt_init();
    
    if(! $stm->prepare($sql)){

           die("sql error " . $mysqli->error );
    }
      $stm->bind_param("ssss",$_POST["name"], 
                              $_POST["email"],
                              $password_hash ,
                              $_POST["phone"] );


                  try {
                          if (!$stm->execute()) {
                         
                          die("Error: " . $mysqli->error . " (" . $mysqli->errno . ")");
                         }
                         
                           header("Location: signupSuccess.html ");
                           exit();  
                           


                            } catch (mysqli_sql_exception $e) {
                                if ($e->getCode() == 1062) {
                           die("Email address already exists. Please use a different email address.");
                                } else {
                           die("Error: " . $e->getMessage());
                                }
                      }
                      
                            


?>