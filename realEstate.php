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

// Function to insert user into the appropriate table (vendeur or client)
function registerUser($ID, $Name, $email, $password, $prix_c, $location, $userType)
{
    global $conn;
    // Note: It's recommended to validate and sanitize user inputs to prevent SQL injection and other security issues
    if ($userType == 'vendeur') {
        $sql = "INSERT INTO vendeur (ID, name, email, passwordv, prix_v, location) VALUES ('$ID', '$Name', '$email', '$password', '$prix_c', '$location')";
    } else {
        $sql = "INSERT INTO client (ID, name, email, passwordc, prix_c, location) VALUES ('$ID', '$Name', '$email', '$password', '$prix_c', '$location')";
    }
    $conn->query($sql);
    header("Location: realEstatelogin.php");
  
}
?>
<?php
// Check if the form is submitted for registration
if (isset($_POST['register'])) {
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $prix_c = $_POST['prix_c'];
    $location = $_POST['location'];
    $userType = isset($_POST['userType']) ? $_POST['userType'] : '';
    registerUser($ID, $name, $email, $password, $prix_c, $location, $userType);
    echo "Hey!";
    exit(); // Add an exit to stop further execution
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Registration</title>
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
                    }

                    body::before {
                              content: '';
                              position: fixed;
                              top: 0;
                              left: 0;
                              width: 100%;
                              height: 100%;
                              background: url('bg.jpg') no-repeat center center fixed;
                              background-size: cover;
                              filter: blur(4px);
                              z-index: -1;
                    }

                    .form-container {
                              position: relative;
                              z-index: 1;
                              background: rgba(255, 255, 255, 0.8);
                              /* Adjust the background color and opacity as needed */
                              padding: 20px;
                              border-radius: 10px;
                              margin: 100px;
                              box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                              /* Adjust the box shadow as needed */
                    }

                    form {
                              /* Add any additional styling for your form */
                    }

                    label {
                              display: block;
                              margin-bottom: 8px;
                    }

                    input {
                              width: 50%;
                              padding: 8px;
                              margin-bottom: 16px;
                    }

                    button:hover {
                              background-color: #45a049;
                              /* Adjust the button color on hover as needed */
                    }


                    form {
                              font-style: bold;
                    }

                    label {
                              display: block;
                              margin-bottom: 8px;
                    }

                    button {
                              padding: 10px;
                              background-color: #4CAF50;
                              /* Adjust the button color as needed */
                              color: white;
                              border: none;
                              border-radius: 5px;
                              cursor: pointer;
                    }

                    button:hover {
                              background-color: #45a049;
                              /* Adjust the button color on hover as needed */
                    }


                    /* body {
                              font-family: Arial, sans-serif;
                              /* background-color: purple ; */

                    */ form {
                              max-width: 300px;
                              margin: 0 auto;
                              background-image: url(pngtree-real-estate-commercial-real-estate-background-banner-image_264561.jpg);
                    }

                    input {
                              margin-bottom: 10px;
                    }

                    input[type="submit"] {
                              text-align: center;
                              width: 150px;
                              height: 30px;

                    }
          </style>
</head>

<body>

          <h2>Where Dreames comes Home</h2>
          <br>
          <div class="form-container">
                    <form method="post" action="">
                    <label>CIN</label>
                              <input type="text" name="ID" required>
                              <br>
                              <label>Name:</label>
                              <input type="text" name="name" required>
                              <br>
                              <label>Email:</label>
                              <input type="text" name="email" required>
                              <br>
                              <label>Password:</label>
                              <input type="password" name="password" required>
                              <br>
                              <label>Appropriate prices for you:</label>
                              <input type="text" name="prix_c" required>
                              <br>
                              <label>Location:</label>
                              <input type="text" name="location" required>
                              <br>
                              <!-- Add the checkbox for user type in the registration form -->
<label>User Type:</label>
<input type="radio" name="userType" value="vendeur"> Vendeur
<label for="vendeur"></label>
<input type="radio" name="userType" value="client"> Client
<label for="client"></label>
<br>
<input type="submit" name="register" value="Register">
                    </form>
          </div>

</body>

</html>

