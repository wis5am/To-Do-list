<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $email = $_POST["email"];
    $login = $_POST["login"];
    $password = $_POST["password"]; // Note: The password should be securely hashed in a production environment.

    $server_name = "localhost:3309";
    $database_name = "todolist";
    
    $user_name = "localhost";
    $user_password = "Aznillest1!";
    
    // sql connect works too        must be in this order first or the code will break.
    $connection = new mysqli($server_name, $user_name, $user_password, $database_name) OR die($connection ->connection_error);
    
    // Check the connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the data into the 'users' table
    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$login', '$password')";

    if (mysqli_query($connection, $sql)) {
        // Registration successful
        echo "Registration successful!";
        header("Location: ../html/login.html"); 
        exit();
    } else {
        // Registration failed
        echo "Error: " . mysqli_error($connection);
        header("Location: ../html/signup.html"); 
    }

    // Close the connection
    mysqli_close($connection);
}
?>
