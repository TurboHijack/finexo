<?php
session_start();
include 'config.php'; // Ensure your PDO connection is included properly

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Prepare SQL statement
    $stmt = $pdo->prepare("INSERT INTO user ( username, email, password, address, country, state, city, phone, gender) 
                          VALUES (:username, :email, :password, :address, :country, :state, :city, :phone, :gender)");

    // Bind parameters
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $hashedPassword);
    $stmt->bindValue(':address', $address);
    $stmt->bindValue(':country', $country);
    $stmt->bindValue(':state', $state);
    $stmt->bindValue(':city', $city);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':gender', $gender);

    // Execute statement
    try {
        $stmt->execute();
        $_SESSION['success_message'] = "Registration successful. You can now login.";
        header("Location: login.html");
        exit;
    } catch (PDOException $e) {
        $error = "Registration failed: " . $e->getMessage();
    }
}
?>
