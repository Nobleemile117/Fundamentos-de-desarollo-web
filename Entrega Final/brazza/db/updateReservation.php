<?php
require "db.php";

if(!isset($_POST["id"]) || !isset($_POST["status"])) { header("Location: ../admin/reservations.php"); return; }

$id     = $_POST["id"];
$status = $_POST["status"];

$sql = "UPDATE reservations SET status = '$status' WHERE id = $id";

try {
    mysqli_query($conn, $sql);
    header("Location: ../admin/reservations.php");
} catch (Exception $e) {
    header("Location: ../admin/reservations.php?error=" . $e->getMessage()); return;
}
?>
