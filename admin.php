<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
} else {
    // get the result via a select query
    require_once "connect.php";

    $query = "SELECT *
                FROM books";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        align-items: center; /* Center content horizontally */
    }

    h1, h2 {
        text-align: center; /* Center text */
        color: #333;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    select, input {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
        border: none; /* Remove button border */
        padding: 10px; /* Increase padding for better appearance */
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
    <h1>Welcome, <?php echo $_SESSION['username']; ?>! to Admins page</h1>
    <h2>Choose your Book, you wish to edit!</h2>
    <form action="update_book.php" method="POST">
        <label for="drop_menu"></label>
        <select id="drop_menu" name="menu">
            <?php foreach ($result as $row) { ?>
                <option value="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Update">
    </form>
    <h2>Add a New Book:</h2>
    <form action="add_book.php" method="POST">
        <input type="submit" value="Add New">
    </form>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>
