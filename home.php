<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: index.php');
        exit();
    } else {
        // Some variables
        try {
            require_once 'connect.php';

            $query = "SELECT * FROM books";
            
            $stmt = $pdo->prepare($query);

            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e){
            echo "Query Failed ". $e->getMessage();
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
    <title>Welcome!</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #eaf7e4; /* Light green background */
        }

        h1 {
            color: #4caf50; /* Green text */
        }

        h2 {
            color: #689f38; /* Darker green text */
        }

        div {
            background-color: #fff;
            border: 1px solid #4caf50; /* Green border */
            padding: 10px;
            margin-bottom: 10px;
            display: inline-block;
        }

        a {
            text-decoration: none;
            color: #00796b; /* Teal color */
        }

        form {
            display: inline;
            margin-left: 10px;
        }

        input[type="submit"] {
            background-color: #4caf50; /* Green button background */
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        p {
            margin-top: 20px;
        }

        a.logout-link {
            color: #d32f2f; /* Red color for logout link */
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <h2>Check our Books Collections:</h2>

    <?php
        if ($result) {
            foreach ($result as $row) {
    ?>
        <div>
            <a href="book_detials.php?book=<?php echo $row['title'];?>"><?php echo $row['title']; ?></a>
            <form action="buyNow.php" method="POST">
                <input type="hidden" name="book_name" value="<?php echo $row['title']; ?>">
                <input type="submit" value="Buy Now">
            </form>
            <img src="images/<?php echo $row['img_name']; ?>" alt="Image" height="150" width="100">
        </div>
    <?php
            }
        }
    ?>

    <p><a class="logout-link" href="logout.php">Logout</a></p>
</body>
</html>
