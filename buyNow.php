<?php
session_start();
if (!isset($_SESSION['username']) ) {
    header('Location: index.php');
    die();
} else {
    $book = $_POST['book_name'];
    if(!isset($book)){
        header('Location: index.php');
        die();
    }else{
    try {
        require_once 'connect.php';

        $query = "SELECT *
                    FROM books
                    WHERE title=:book_title";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":book_title", $book);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Query Failed " . $e->getMessage();
        header("refresh:2;url=home.php");
        die();
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Purchase</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #fafafa; /* Light gray background */
        }

        h2 {
            color: #333; /* Dark text color */
        }

        p {
            color: #555; /* Medium gray text color */
            margin-bottom: 10px;
        }

        form {
            margin-top: 20px;
        }

        input[type="button"] {
            background-color: #4caf50; /* Green button background */
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="button"]:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>

<body>
    <h2>You are buying:</h2>
    <?php
    echo "<p><strong>Title:</strong> " . $result['title'] . "</p>";
    // echo "<p><strong>Number of pages:</strong> " . $result['number_of_pages'] . "</p>";
    // echo "<p><strong>Quantity:</strong> " . $result['quantity'] . "</p>";
    echo "<p><strong>Price:</strong> " . $result['price'] . "</p>";
    ?>
    <form action="bought.php" method="POST">
        <input type="button" value="Buy">
    </form>
    <p><a href="home.php">Back</a></p>
</body>

</html>
