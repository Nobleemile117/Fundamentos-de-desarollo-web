<?php
require "db.php";

if(!isset($_POST["id"]) || !isset($_POST["name"])) {
    header("Location: ../admin/menu-food.php");
    return;
}

$id          = $_POST["id"];
$name        = $_POST["name"];
$description = $_POST["description"];
$show_price  = $_POST["show_price"];
$active      = $_POST["active"];

$price      = $_POST["price"];
$priceValue = ($price == "" || $price == null) ? "NULL" : $price;

// Check if a new image was uploaded
if(isset($_FILES["image"]) && $_FILES["image"]["name"] != "") {
    $imageName = $_FILES["image"]["name"];
    $type      = $_FILES["image"]["type"];
    $path      = $_FILES["image"]["tmp_name"];

    if(!strpos($type, "jpeg") && !strpos($type, "png") && !strpos($type, "jpg")) {
        header("Location: ../admin/editFood.php?id=$id&error=Archivo no permitido, usa jpg o png");
        return;
    }
    if(!is_dir("../assets/images/uploads/food")) { mkdir("../assets/images/uploads/food", 0777, true); }
    move_uploaded_file($path, "../assets/images/uploads/food/$imageName");
    $sql = "UPDATE food SET name = '$name', description = '$description', price = $priceValue, show_price = $show_price, active = $active, image = '$imageName' WHERE id = $id";
} else {
    // No new image — keep the existing one
    $sql = "UPDATE food SET name = '$name', description = '$description', price = $priceValue, show_price = $show_price, active = $active WHERE id = $id";
}

try {
    mysqli_query($conn, $sql);
    header("Location: ../admin/menu-food.php");
} catch (Exception $e) {
    header("Location: ../admin/editFood.php?id=$id&error=" . $e->getMessage());
    return;
}
?>
