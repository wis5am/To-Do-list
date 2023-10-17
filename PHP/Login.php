<?php
// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $server_name = "localhost:3309";
    $database_name = "todolist";
    $user_name = "localhost";
    $user_password = "Aznillest1!";

    $connection = new mysqli($server_name, $user_name, $user_password, $database_name) OR die($connection->connection_error);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL query with parameterized statement to retrieve the user with the given login and password
    $sql = "SELECT UserID, email FROM users WHERE email = ? AND password = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Login successful: Set the user's login status and other details in the session
        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $row['UserID'];
        $_SESSION['user_email'] = $row['email'];

        // Redirect to the user's dashboard or any other page after successful login
        header("Location: ../PHP/index.php");
        exit();
    } else {
        // Login failed: Redirect back to the login page with an error message
        $_SESSION['login_error'] = "Invalid login credentials. Please try again.";
        header("Location: ../html/login.html");
        exit();
    }

    // Close the connection
    $stmt->close();
    $connection->close();
}
?>
