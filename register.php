<?php
// register.php
$servername = "localhost";
$username = "root";
$password = ""; // your MySQL password
$dbname = "lms_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];
$confirm_pass = $_POST['confirm_password'];

// Check passwords match
if($pass != $confirm_pass){
    die("Passwords do not match!");
}

// Insert into database
$sql = "INSERT INTO users (username, email, password, role) VALUES ('$user', '$email', '$pass', 'member')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful! <a href='index.html'>Login here</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
