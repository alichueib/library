<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup Page</title>
</head>
<body>
    <h1>Sign Up!</h1>
    
    <form action="signup_handler.php" method="POST">
        
        <label for="usr">Username:</label>
        <input type="text" id="usr" name="username" value="" placeholder="Enter username"><br><br>

        <label for="pass">Password:</label>
        <input type="text" id="pass" name="pwd" placeholder="Enter password"><br><br>
        
        <label for="pass">Re-Password:</label>
        <input type="text" id="pass" name="pwd" placeholder="Re enter password"><br><br>

        <input type="submit" name="submit" value="Sign Up"><br><br><br>

    </form>

</body>
</html>