<?php
    $dsn="mysql:host=localhost;dbname=library_db";
    $dbusername="alichueib";
    $password="password123";

    try{
        $pdo=new PDO($dsn,$dbusername,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection Failed". $e->getMessage();
    }