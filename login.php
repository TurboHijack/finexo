<?php
session_start();

// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'finexo';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Check if username and password are set
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM user WHERE username =? AND password =?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debug: Check the number of rows returned
    echo "Number of rows returned: " . $result->num_rows . "<br>";

    if ($result->num_rows > 0) {
        // User found, set session variables
        $user_data = $result->fetch_assoc();
        $_SESSION['username'] = $user_data['username'];
        $_SESSION['email'] = $user_data['email'];
        $_SESSION['address'] = $user_data['address'];
        $_SESSION['country'] = $user_data['country'];
        $_SESSION['city'] = $user_data['city'];
        $_SESSION['phone'] = $user_data['phone'];
        $_SESSION['gender'] = $user_data['gender'];

        // Debug: Check if session variables are set
        var_dump($_SESSION);

        // Redirect to next page
        header('Location: customer_dashboard.php');
        exit;
    } else {
        // Invalid credentials, display error message
        echo "Invalid username or password";
    }

    // Close statement
    $stmt->close();
} else {
    echo "Please enter username and password";
}

// Close connection
$conn->close();
?>