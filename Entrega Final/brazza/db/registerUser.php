<?php
require "db.php";
session_start();

if(!isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["password"])) {
    header("Location: ../auth/register.php?error=Datos incompletos");
    return;
}

$username = $_POST["username"];
$email    = $_POST["email"];
$password = $_POST["password"];

// Check if username already exists
$check = "SELECT COUNT(*) as total FROM users WHERE username = '$username'";
$q     = mysqli_query($conn, $check);
$r     = mysqli_fetch_array($q);

if($r["total"] > 0) {
    header("Location: ../auth/register.php?error=Ese usuario ya existe");
    return;
}

$sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'user')";

try {
    mysqli_query($conn, $sql);
    $_SESSION["username"] = $username;
    $_SESSION["role"]     = "user";
    header("Location: ../index.php");
} catch (Exception $e) {
    header("Location: ../auth/register.php?error=" . $e->getMessage());
    return;
}
?>
