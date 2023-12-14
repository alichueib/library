<?php
    session_start();

    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
    $_SESSION['username']=$username;
    $_SESSION['pwd']=$pwd;

    try{
        require_once 'connect.php';
        
        $query="SELECT username,pwd,type
                FROM users 
                WHERE username=:username and pwd=:pwd";
        
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":pwd",$pwd);
        $stmt->execute();

        $result=$stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            if($result['username']==$username && $result['pwd']==$pwd){
                if($result['type']==1){
                    header("Location: admin.php");
                    die();
                }
                header("Location: home.php");
                die();
            }else{
                echo "Enter valid Credentials!";
                header('refresh:3;url=index.php');
                die();
            }
        }
        else {
            echo "Enter valid Credentials!";
            header('refresh:3;url=index.php');
            exit();
        }

 
    }catch(PDOException $e){
        echo "Query Failed ".$e->getMessage();
    }
?>