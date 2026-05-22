<?php
require "db.php";

if(!isset($_GET["id"])) { header("Location: ../admin/reservations.php"); return; }

$sql = "DELETE FROM reservations WHERE id = " . $_GET["id"];

try {
    mysqli_query($conn, $sql);
    header("Location: ../admin/reservations.php");
} catch (Exception $e) {
    header("Location: ../admin/reservations.php?error=" . $e->getMessage()); return;
}
?>
