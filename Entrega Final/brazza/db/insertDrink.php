<?php
require "db.php";

if(!isset($_POST["name"]) || $_POST["name"] == "" || !isset($_POST["description"]) || $_POST["description"] == "") {
    header("Location: ../admin/menu-drinks.php?error=El nombre y la descripción son obligatorios");
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
        header("Location: ../admin/menu-drinks.php?error=Archivo no permitido, usa jpg o png");
        return;
    }
    if(!is_dir("../assets/images/uploads/drinks")) { mkdir("../assets/images/uploads/drinks", 0777, true); }
    move_uploaded_file($path, "../assets/images/uploads/drinks/$imageName");
}

$sql = "INSERT INTO drinks (name, description, image, price, show_price, active) VALUES ('$name', '$description', '$imageName', $priceValue, $show_price, $active)";

try {
    mysqli_query($conn, $sql);
    header("Location: ../admin/menu-drinks.php");
} catch (Exception $e) {
    header("Location: ../admin/menu-drinks.php?error=" . $e->getMessage());
    return;
}
?>
