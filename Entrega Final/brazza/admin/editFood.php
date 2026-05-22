<?php
    require '../db/db.php';
    session_start();

    if(isset($_SESSION["username"])) {
        if($_SESSION["role"] != "admin") {
            header("Location: ../index.php?error=No tienes permisos");
            return;
        }
    } else {
        header("Location: ../auth/login.php?error=No has iniciado sesión");
        return;
    }

    if(!isset($_GET['id'])) {
        header("Location: menu-food.php?error=Id inválido");
        return;
    }

    $id     = $_GET['id'];
    $sql    = "SELECT * FROM food WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $item   = mysqli_fetch_array($result);

    if(!$item) {
        header("Location: menu-food.php?error=Corte no encontrado");
        return;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Corte – Panel Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/main.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

  <nav class="admin-nav">
    <div class="brand" style="display:flex; align-items:center; gap:10px;">
      <img src="../assets/images/brazza_logo.png" alt="Logo" style="width:38px; height:38px; object-fit:contain; opacity:0.9;">
      <div>Brazza y Fogo<span>Panel de Administración</span></div>
    </div>
    <button class="admin-hamburger" onclick="toggleAdminMenu()">☰</button>
    <ul>
      <li><a href="../index.php">Inicio</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="menu-food.php" class="active">Cortes</a></li>
      <li><a href="../db/logout.php" class="nav-logout">Cerrar Sesión</a></li>
    </ul>
  </nav>

  <div class="admin-wrap">
    <h1 class="admin-page-title">Editar Corte</h1>
    <p class="admin-page-sub">Modifica los datos del corte seleccionado</p>

    <form class="admin-form" action="../db/updateFood.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $item['id']; ?>">

      <div>
        <label for="name">Nombre *</label>
        <input type="text" id="name" name="name" value="<?php echo $item['name']; ?>">
      </div>
      <div>
        <label for="description">Descripción *</label>
        <input type="text" id="description" name="description" value="<?php echo $item['description']; ?>">
      </div>
      <div>
        <label for="price">Precio <span style="color:#7a6540; font-size:0.75rem;">(opcional)</span></label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo $item['price']; ?>">
      </div>
      <div>
        <label for="show_price">Mostrar precio</label>
        <select id="show_price" name="show_price">
          <option value="1" <?php if($item['show_price'] == 1) echo 'selected'; ?>>Sí</option>
          <option value="0" <?php if($item['show_price'] == 0) echo 'selected'; ?>>No</option>
        </select>
      </div>
      <div>
        <label for="active">Activo (visible en menú)</label>
        <select id="active" name="active">
          <option value="1" <?php if($item['active'] == 1) echo 'selected'; ?>>Sí</option>
          <option value="0" <?php if($item['active'] == 0) echo 'selected'; ?>>No</option>
        </select>
      </div>

      <!-- Show current image if exists -->
      <?php if($item['image']) { ?>
        <div>
          <label>Imagen actual</label>
          <img src="../assets/images/uploads/food/<?php echo $item['image']; ?>"
               alt="Imagen actual"
               style="width:100%; max-height:200px; object-fit:cover; border:1px solid rgba(201,168,76,0.3); margin-bottom:8px;">
        </div>
      <?php } ?>

      <div>
        <label for="image">Cambiar imagen <span style="color:#7a6540; font-size:0.75rem;">(opcional — deja vacío para mantener la actual)</span></label>
        <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png">
      </div>

      <button type="submit">Guardar Cambios</button>

      <?php if(isset($_GET['error'])) { ?>
        <span class="error">Error: <?php echo $_GET['error']; ?></span>
      <?php } ?>
    </form>
  </div>

  <script src="../assets/js/main.js"></script>
</body>
</html>
