<?php
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column; /* Display children elements vertically */
    justify-content: center;
    align-items: center;
    height: 100vh;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    display: flex;
    flex-direction: column; /* Display children elements vertically */
    align-items: center;
}

label {
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #0066cc;
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #004080;
}

h4 {
    margin-top: 16px; /* Add space between the form and the "Don't have an account?" text */
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
    <h1>Login to your Account</h1>
    
    <form action="login_handler.php" method="POST">
        <label for="usr">Username:</label>
        <input type="text" id="usr" name="username" value="" placeholder="Enter username">

        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pwd" placeholder="Enter password">

        <input type="submit" name="submit" value="Log in">
    </form>

    <h4>Don't have an account?</h4>
    <a href="signup.php">Sign Up</a>
</body>
</html>
