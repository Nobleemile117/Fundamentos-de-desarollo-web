<?php
require "db.php";

if(!isset($_GET["id"])) {
    header("Location: ../admin/menu-food.php");
    return;
}

$sql = "DELETE FROM food WHERE id = " . $_GET["id"];

try {
    mysqli_query($conn, $sql);
    header("Location: ../admin/menu-food.php");
} catch (Exception $e) {
    header("Location: ../admin/menu-food.php?error=" . $e->getMessage());
    return;
}
?>
