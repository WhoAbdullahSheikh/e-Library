<?php
// Retrieve the parameters from the request
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Perform the deletion logic
// Assuming you are using MySQLi for database operations
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "elibrary";

// Create a new PDO instance
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $dbUsername, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user exists in the "faculty" table
    $stmt = $conn->prepare("SELECT * FROM faculty WHERE username = :username AND email = :email AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $facultyUser = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user exists in the "faculty" table, delete the row
    if ($facultyUser) {
        $stmt = $conn->prepare("DELETE FROM faculty WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        echo "User deleted successfully!";
        exit;
    }

    // Check if the user exists in the "students" table
    $stmt = $conn->prepare("SELECT * FROM students WHERE username = :username AND email = :email AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $studentUser = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user exists in the "students" table, delete the row
    if ($studentUser) {
        $stmt = $conn->prepare("DELETE FROM students WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        echo "User deleted successfully!";
        exit;
    }

    echo "User not found!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}