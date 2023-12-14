<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    die();
} else {
    $book = $_GET['book'];

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9; /* Light gray background */
        }

        h1 {
            color: #333; /* Dark text color */
        }

        p {
            color: #555; /* Medium gray text color */
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Details about the book:</h1>
    <?php
    echo "<p><strong>Title:</strong> " . $result['title'] . "</p>";
    echo "<p><strong>Number of pages:</strong> " . $result['number_of_pages'] . "</p>";
    echo "<p><strong>Quantity:</strong> " . $result['quantity'] . "</p>";
    echo "<p><strong>Price:</strong> " . $result['price'] . "</p>";
    ?>
    <p><a href="home.php">Back</a></p>
</body>

</html>
