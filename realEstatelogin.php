<?php
// Database connection parameters
$bdserver = "localhost";
$username = "root";
$password = "";
$db = "real_Estate1";

// Create connection
$conn = new mysqli($bdserver, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function loginUser($email, $password)
{
    global $conn;
    $sql = "SELECT * FROM client WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['passwordc']) {
            echo "Hey again, Client!";
        } else {
            echo "Incorrect password";
        }
    } else {
        // Check if the email is in the vendeur table
        $sqlVendeur = "SELECT * FROM vendeur WHERE email='$email'";
        $resultVendeur = $conn->query($sqlVendeur);

        if ($resultVendeur->num_rows > 0) {
            $rowVendeur = $resultVendeur->fetch_assoc();
            if ($password === $rowVendeur['passwordv']) {
                echo "Hey again, Vendeur!";
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "Email not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
        }

        input {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <h2>Login</h2>
    <form method="post" action="">
        <label>Email:</label>
        <input type="text" name="email" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" name="login" value="Login">
    </form>

</body>

</html>

<?php

// Check if the form is submitted for login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    loginUser($email, $password);
}
if (isset($_POST['register'])) {
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $prix_c = $_POST['prix_c'];
    $location = $_POST['location'];
    $userType = isset($_POST['userType']) ? $_POST['userType'] : '';
    registerUser($ID, $name, $email, $password, $prix_c, $location, $userType);
}
?>