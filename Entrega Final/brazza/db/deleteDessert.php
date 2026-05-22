<?php
require "db.php";

if(!isset($_GET["id"])) { header("Location: ../admin/menu-desserts.php"); return; }

$sql = "DELETE FROM desserts WHERE id = " . $_GET["id"];

try {
    mysqli_query($conn, $sql);
    header("Location: ../admin/menu-desserts.php");
} catch (Exception $e) {
    header("Location: ../admin/menu-desserts.php?error=" . $e->getMessage()); return;
}
?>
