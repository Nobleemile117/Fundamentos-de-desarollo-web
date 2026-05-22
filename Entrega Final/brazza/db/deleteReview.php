<?php
require "db.php";

if(!isset($_GET["id"])) { header("Location: ../admin/reviews.php"); return; }

$sql = "DELETE FROM reviews WHERE id = " . $_GET["id"];

try {
    mysqli_query($conn, $sql);
    header("Location: ../admin/reviews.php");
} catch (Exception $e) {
    header("Location: ../admin/reviews.php?error=" . $e->getMessage()); return;
}
?>
