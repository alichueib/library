<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title=$_POST['title'];
        $pages_number=$_POST['pages_number'];
        $quantity=$_POST['quantity'];
        $price=$_POST['price'];
        $user_id=8;
        $_SESSION=$title;
        $_SESSION=$pages_number;
        $_SESSION=$quantity;
        $_SESSION=$price;

        try{
            require_once 'connect.php';

            $query='INSERT INTO books(title,number_of_pages,quantity,price,created_by)
                    VALUES (:title,:number,:quantity,:price,:user_id)';
    
            $stmt=$pdo->prepare($query);
            
            $stmt->bindParam(":title",$title);
            $stmt->bindParam(":number",$pages_number);
            $stmt->bindParam(":quantity",$quantity);
            $stmt->bindParam(":price",$price);
            $stmt->bindParam(":user_id",$user_id);
    
            $stmt->execute();

            $stmt=null;
            $pdo=null;
            echo "Successfully Added the book!";
            header('refresh:2;url=admin.php');
            die();

        }catch(PDOException $e){
            echo "Query Failed ".$e->getMessage();
        }



    }else{
        header('Location: index.php');
        die();
    }