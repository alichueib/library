<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
</head>
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
    <h1>Add a Book:</h1>

    <form action="add_book_handler.php" method="POST" enctype="multipart/form-data">
        <label for="ti">Title:</label>
        <input type="text" id='ti' name="title" placeholder="Enter Book's Title">

        <label for="pn">Pages Nbr:</label>
        <input type="text" id='pn' name="pages_number" placeholder="Enter Book's Pages Nbr">

        <label for="qtt">Available Quantity:</label>
        <input type="text" id='qtt' name="quantity" placeholder="Enter Book's Quantity">

        <label for="pr">Price:</label>
        <input type="text" id='pr' name="price" placeholder="Enter Book's Price">

        <label for="pic">Book's Cover Photo:</label>
        <input type="file" id="pic" name="picture"><br>

        <input type="submit" value="Upload">
    </form>

    <p><a href="admin.php">Back</a></p>
</body>

</html>
