<?php
require "db.php";
session_start();

if(!isset($_SESSION["username"])) {
    header("Location: ../auth/login.php?error=Debes iniciar sesión");
    return;
}

if(!isset($_POST["visit_date"]) || !isset($_POST["stars"]) || !isset($_POST["comment"])) {
    header("Location: ../user/add-review.php?error=Datos incompletos");
    return;
}

// Get user id
$username = $_SESSION["username"];
$userQuery = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
$user      = mysqli_fetch_array($userQuery);
$user_id   = $user["id"];

$author_name = $_SESSION["username"];
$visit_date  = $_POST["visit_date"];
$stars       = $_POST["stars"];
$comment     = $_POST["comment"];

$sql = "INSERT INTO reviews (user_id, author_name, visit_date, comment, stars) VALUES ($user_id, '$author_name', '$visit_date', '$comment', $stars)";

try {
    mysqli_query($conn, $sql);
    header("Location: ../menu.php");
} catch (Exception $e) {
    header("Location: ../user/add-review.php?error=" . $e->getMessage());
    return;
}
?>
