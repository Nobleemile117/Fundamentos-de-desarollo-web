<?php
require "db.php";

if(!isset($_POST["name"]) || $_POST["name"] == "" || !isset($_POST["description"]) || $_POST["description"] == "") {
    header("Location: ../admin/menu-desserts.php?error=El nombre y la descripción son obligatorios");
    return;
}

$name        = $_POST["name"];
$description = $_POST["description"];
$show_price  = $_POST["show_price"];
$active      = $_POST["active"];
$imageName   = "";

$price = $_POST["price"];
$priceValue = ($price == "" || $price == null) ? "NULL" : $price;

if(isset($_FILES["image"]) && $_FILES["image"]["name"] != "") {
    $imageName = $_FILES["image"]["name"];
    $type      = $_FILES["image"]["type"];
    $path      = $_FILES["image"]["tmp_name"];

    if(!strpos($type, "jpeg") && !strpos($type, "png") && !strpos($type, "jpg")) {
        header("Location: ../admin/menu-desserts.php?error=Archivo no permitido, usa jpg o png");
        return;
    }
    if(!is_dir("../assets/images/uploads/desserts")) { mkdir("../assets/images/uploads/desserts", 0777, true); }
    move_uploaded_file($path, "../assets/images/uploads/desserts/$imageName");
}

$sql = "INSERT INTO desserts (name, description, image, price, show_price, active) VALUES ('$name', '$description', '$imageName', $priceValue, $show_price, $active)";

try {
    mysqli_query($conn, $sql);
    header("Location: ../admin/menu-desserts.php");
} catch (Exception $e) {
    header("Location: ../admin/menu-desserts.php?error=" . $e->getMessage());
    return;
}
?>
