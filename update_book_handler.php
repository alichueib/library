<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title=$_POST['title'];
        $pages_number=$_POST['pages_number'];
        $quantity=$_POST['quantity'];
        $price=$_POST['price'];
        $user_id=8;//this is to be updated so that it is retrieved auto by selecting id 
        $_SESSION['title']=$title;
        $_SESSION['number_of_pages']=$pages_number;
        $_SESSION['quantity']=$quantity;
        $_SESSION['price']=$price;

        if (isset($_FILES['picture'])) {
            $picture = $_FILES['picture'];
        } else {
            echo "No file uploaded.";
        }

        //echo "Before";
        $book=$_SESSION['selected'];
        //echo $book;

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

            $query="UPDATE books
                    SET title=:title,number_of_pages=:number,quantity=:quantity,price=:price,img_name=:img
                    WHERE title=:selected";
    
            $stmt=$pdo->prepare($query);
            
            $stmt->bindParam(":title",$title);
            $stmt->bindParam(":number",$pages_number);
            $stmt->bindParam(":quantity",$quantity);
            $stmt->bindParam(":price",$price);
            $stmt->bindParam(":selected",$book);
            $stmt->bindParam(":img",$newPicName);
    
            $stmt->execute();

            $stmt=null;
            $pdo=null;
            echo "Successfully Updated the book!";
            header('refresh:2;url=admin.php');
            die();

        }catch(PDOException $e){
            echo "Query Failed ".$e->getMessage();
        }



    }else{
        header('Location: login.php');
        die();
    }