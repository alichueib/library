<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title=$_POST['title'];
        $pages_number=$_POST['pages_number'];
        $quantity=$_POST['quantity'];
        $price=$_POST['price'];
        if (isset($_FILES['picture'])) {
            $picture = $_FILES['picture'];
        } else {
            echo "No file uploaded.";
        }

        $user_id=8;

        //Those are used if requested in later pages, otherwise will take space in memory
        $_SESSION=$title;
        $_SESSION=$pages_number;
        $_SESSION=$quantity;
        $_SESSION=$price;

        try{
            require_once 'connect.php';
            require_once 'fcts/uploadPicture.php';
            $newPicName=uploadPicture($picture);// calling Fct

            //If error has happend:
            if( $newPicName== -1){
                echo "Error happened during Picture Upload";
                header('refresh:3;url=add_book.php');
                die();
            }

            $query='INSERT INTO books(title,number_of_pages,quantity,price,created_by,img_name)
                    VALUES (:title,:number,:quantity,:price,:user_id,:img_name)';
    
            $stmt=$pdo->prepare($query);
            
            $stmt->bindParam(":title",$title);
            $stmt->bindParam(":number",$pages_number);
            $stmt->bindParam(":quantity",$quantity);
            $stmt->bindParam(":price",$price);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->bindParam(":img_name",$newPicName);
    
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