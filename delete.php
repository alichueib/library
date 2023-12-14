<?php
    session_start();
    $book=$_SESSION['selected'];

    try{
        require_once 'connect.php';

        $query="DELETE
                FROM books
                WHERE title=:title";
        $stmt=$pdo->prepare($query);

        $stmt->bindParam(":title",$book);

        $stmt->execute();

        $stmt=null;
        $pdo=null;
        echo $book ." was sucessfully deleted";
        header('refresh:3;url=admin.php');
        die();
    }catch(PDOException $e){
        echo "Query Failed";
    }