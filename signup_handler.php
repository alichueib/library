<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $pwd=$_POST['pwd'];

        try{
            require_once 'connect.php';

            $query="INSERT INTO users (username,pwd,type) VALUES (:username,:pwd,0)";
            $stmt=$pdo->prepare($query);
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":pwd",$pwd);
            $stmt->execute();

            $pdo=null;
            $stmt=null;
            header("Location: index.php");

            die();
        }catch(PDOException $e){
            echo "Query Failed ". $e->getMessage();
        }

    }else{
        header('Location: signup.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>