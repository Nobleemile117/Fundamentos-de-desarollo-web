<?php
require "db.php";
session_start();

if(!isset($_SESSION["username"])) {
    header("Location: ../auth/login.php?error=Debes iniciar sesión");
    return;
}

if(!isset($_POST["name"]) || !isset($_POST["guests"]) || !isset($_POST["date"]) || !isset($_POST["time"])) {
    header("Location: ../user/add-reservation.php?error=Datos incompletos");
    return;
}

// Get user id
$username  = $_SESSION["username"];
$userQuery = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
$user      = mysqli_fetch_array($userQuery);
$user_id   = $user["id"];

$name   = $_POST["name"];
$guests = $_POST["guests"];
$date   = $_POST["date"];
$time   = $_POST["time"];
$notes  = $_POST["notes"];

$sql = "INSERT INTO reservations (user_id, name, guests, date, time, notes) VALUES ($user_id, '$name', $guests, '$date', '$time', '$notes')";

try {
    mysqli_query($conn, $sql);
    header("Location: ../user/my-reservations.php");
} catch (Exception $e) {
    header("Location: ../user/add-reservation.php?error=" . $e->getMessage());
    return;
}
?>
