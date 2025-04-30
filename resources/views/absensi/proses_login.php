<?php
session_start();  // Start the session to store user data

// Database credentials (update these based on your setup)
$host = 'localhost';  // Database host
$username = 'root';   // Database username (change as needed)
$password = '';       // Database password (change as needed)
$database = 'absensi'; // Your existing database name

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to check if the email exists
    $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if email exists in the database
    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($id, $name, $db_email, $db_password);
        $stmt->fetch();

        // Verify the password using password_verify (if hashed)
        if (password_verify($password, $db_password)) {
            // Correct password, set up session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $db_email;
            header('Location: dashboard.php'); // Redirect to the dashboard (or homepage)
            exit();
        } else {
            // Incorrect password
            $error_message = "Incorrect password.";
        }
    } else {
        // No user found with the provided email
        $error_message = "No user found with this email.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>