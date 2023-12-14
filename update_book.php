<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
} else {
    if (!isset($_POST['menu'])) {
        header('Location: admin.php');
        exit();
    }else{
        $selected_book = $_POST['menu'];
        $_SESSION['selected'] = $selected_book;
    // Get info about the book
    try {
        require_once 'connect.php';

        $query = "SELECT *
                    FROM books
                    WHERE title=:book_title";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":book_title", $selected_book);

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
    <title>Welcome!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: grid;
            gap: 8px;
            flex-direction: column;
            align-items: center;
        }

        label {
            display: contents; /* This allows the label to affect the layout of its children */
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            display: block;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 16px;
        }

        a {
            color: #0066cc;
            text-decoration: none;
            margin-left: 5px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Your Editing <?php echo $selected_book; ?></h1>
    <h2>Update Book Details</h2>
    <form action="update_book_handler.php" method="POST">
        <label for="ti">Title:</label>
        <input type="text" id='ti' name="title" value="<?php if(isset($result['title'])){echo $result['title']; }else{ echo "";}?>" placeholder="Enter Book's Title">

        <label for="pn">Pages Nbr:</label>
        <input type="text" id='pn' name="pages_number" value="<?php if(isset($result['number_of_pages'])){echo $result['number_of_pages']; }else{ echo "";}?>" placeholder="Enter Book's Pages Nbr">

        <label for="qtt">Available Quantity:</label>
        <input type="text" id='qtt' name="quantity" value="<?php if(isset($result['quantity'])){echo $result['quantity']; }else{ echo "";} ?>" placeholder="Enter Book's Quantity">

        <label for="pr">Price:</label>
        <input type="text" id='pr' name="price" value="<?php if(isset($result['price'])){echo $result['price']; }else{ echo "";} ?>" placeholder="Enter Book's Price">

        <input type="submit" value="Save">
    </form>

    <h2>Delete Book</h2>
    <form action="delete.php" method="POST">
        <input type="submit" value="Delete">
    </form>

    <p><a href="admin.php">Back</a></p>
</body>

</html>
