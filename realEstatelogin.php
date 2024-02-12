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
<style>
        h2 {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: center;
            color: purple;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            position: relative;
            background: url('bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid #ccc; /* Added border (cadre) */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            padding: 20px;
            width: 300px;
        }

        form {
            /* Add any additional styling for your form */
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            text-align: center;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            /* Adjust the button color as needed */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            /* Adjust the button color on hover as needed */
        }
    </style>


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