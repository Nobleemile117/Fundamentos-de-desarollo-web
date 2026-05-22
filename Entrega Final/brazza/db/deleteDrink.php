<?php
require "db.php";

if(!isset($_GET["id"])) { header("Location: ../admin/menu-drinks.php"); return; }

$sql = "DELETE FROM drinks WHERE id = " . $_GET["id"];

try {
    mysqli_query($conn, $sql);
    header("Location: ../admin/menu-drinks.php");
} catch (Exception $e) {
    header("Location: ../admin/menu-drinks.php?error=" . $e->getMessage()); return;
}
?>
