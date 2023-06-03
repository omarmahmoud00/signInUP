<?php


     $mysqli = new mysqli("localhost","root","","login_db");

     if($mysqli->connect_error){

        die("connection error" . $mysqli->connect_error );
     }
     
     return  $mysqli;