<?php
require "db.php";
session_start();

if(!isset($_POST["username"]) || !isset($_POST["password"])) {
    header("Location: ../auth/login.php?error=Datos incompletos");
    return;
}

$username = $_POST["username"];
$password = $_POST["password"];

$sql    = "SELECT COUNT(*) as login, role FROM users WHERE username = '$username' AND password = '$password'";
$query  = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);

if($result["login"] > 0) {
    $_SESSION["username"] = $username;
    $_SESSION["role"]     = $result["role"];
    header("Location: ../index.php");
} else {
    header("Location: ../auth/login.php?error=Usuario o contraseña incorrectos");
    return;
}
?>
