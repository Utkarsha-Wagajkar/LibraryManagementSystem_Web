<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; // your MySQL password
$dbname = "lms_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$user = $_POST['username'];
$pass = $_POST['password'];

// Prevent SQL Injection
$user = $conn->real_escape_string($user);
$pass = $conn->real_escape_string($pass);

// Check username + password together
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];

    if ($row['role'] == 'admin') {
        header("Location: admin/dashboard.html");
    } else {
        header("Location: member/dashboard.html");
    }
    exit();
} else {
    echo "Invalid username or password!";
}

$conn->close();
?>
