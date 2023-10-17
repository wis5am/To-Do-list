<?php
// Start the session
session_start();
$base_url = "http://localhost/Assignment2/";
// Include the database connection configuration (replace with your actual credentials)
$server_name = "localhost:3309";
$database_name = "todolist";
$user_name = "localhost";
$user_password = "Aznillest1!";

$connection = new mysqli($server_name, $user_name, $user_password, $database_name) OR die($connection ->connection_error);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the user ID from the session
$userId = $_SESSION["user_id"];

// Save a new task
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["task"])) {
    $task = $_POST["task"];
    $userEmail = $_SESSION["user_email"];

    // Insert the task into the tasks table with the associated user_email and user_id
    $sql = "INSERT INTO tasks (description, userID, useremail) VALUES ('$task', '$userId', '$userEmail')";
    if ($connection->query($sql) === TRUE) {
        // Redirect to a separate page after a successful form submission
        header("Location: " . $base_url . "php/Index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Retrieve tasks for the current user
$sql = "SELECT * FROM tasks WHERE userID = '$userId'";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Hussein Mansour">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $base_url; ?>CSS/Style.css">
        <script src="../JS/Script.js" defer></script>
        <title>TaskWise - My Tasks</title>
    </head>
    <body>
        <header>
            <img class="header-logo" src="<?php echo $base_url; ?>images/logo2.png" alt="alternative_text">
            <nav class="nav-header-right">
                <a class="home" href="<?php echo $base_url; ?>index.php">MyTasks</a>
                <?php
                // Check if the user is logged in and display appropriate navigation links
                if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                    echo '<a href="' . $base_url . 'html/login.html">Login</a>';
                    echo '<a href="' . $base_url . 'html/signup.html">Sign up</a>';
                }else{
                    echo '<a href="' . $base_url . 'html/login.html">Login</a>';
                }
                ?>
            </nav>
        </header>
        <div class="container">
            <div class="todo-app">
                <form id="todo-form" action="" method="POST" onsubmit="return addTask()">
                    <h2>To-Do List <img src="images/icons8-todo-list.gif" alt="gif"></h2>
                    <div class="row">
                    <input type="text" name="task" id="input-box" placeholder="Add your task">'
                    <?php
                        // Check if the user is logged in before displaying the task input and button
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                            echo '<button id="butt" type="submit">Add</button>';
                        }
                    ?>
                    </div>
                    <ul id="list-container">
                        <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Echo each task description as a list item
                                    echo '<li data-task-id=' . $row["taskid"] . '" onclick="addTask()">' . $row["description"] . '</li>'; 
                                }
                            }
                        ?>
                    </ul>
                </form>
            </div>
        </div>
        <footer>
            <p id="footerP">&copy; 2023 TaskWise - All rights reserved</p>
        </footer>
        <script>
            var base_url = "http://localhost/Assignment2/";
        </script>
    </body>
</html>