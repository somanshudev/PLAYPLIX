<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle Sign In Form
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Implement your validation and authentication logic here

        // Example: Query to check the username and password in the database
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Authentication successful
            echo "Sign In Successful";
        } else {
            // Authentication failed
            echo "Invalid Username or Password";
        }
    }

    // Handle Sign Up Form
    elseif (isset($_POST["new_username"]) && isset($_POST["new_password"]) && isset($_POST["new_email"])) {
        $newUsername = $_POST["new_username"];
        $newPassword = $_POST["new_password"];
        $newEmail = $_POST["new_email"];

        // Implement your registration logic here

        // Example: Insert new user into the database
        $sql = "INSERT INTO users (username, password, email) VALUES ('$newUsername', '$newPassword', '$newEmail')";
        if ($conn->query($sql) === TRUE) {
            echo "Sign Up Successful";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>