<?php
    require '../db/db.php';
    session_start();

    if(isset($_SESSION["username"])) {
        if($_SESSION["role"] != "admin") { header("Location: ../index.php?error=No tienes permisos"); return; }
    } else {
        header("Location: ../auth/login.php?error=No has iniciado sesión"); return;
    }

    $sql    = "SELECT * FROM desserts";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Postres – Panel Admin</title>
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
      <li><a href="menu-food.php">Cortes</a></li>
      <li><a href="menu-drinks.php">Bebidas</a></li>
      <li><a href="menu-desserts.php" class="active">Postres</a></li>
      <li><a href="reviews.php">Reseñas</a></li>
      <li><a href="reservations.php">Reservaciones</a></li>
      <li><a href="../db/logout.php" class="nav-logout">Cerrar Sesión</a></li>
    </ul>
  </nav>

  <div class="admin-wrap">
    <h1 class="admin-page-title">Postres</h1>
    <p class="admin-page-sub">Agregar, editar y eliminar postres del menú · <span style="color:#c8b89a;">* campos obligatorios</span></p>

    <form class="admin-form" action="../db/insertDessert.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
      <h2>Agregar Postre</h2>

      <div><label>Nombre *</label><input type="text" id="name" name="name"></div>
      <div><label>Descripción *</label><input type="text" id="description" name="description"></div>
      <div>
        <label>Precio <span style="color:#7a6540; font-size:0.75rem;">(opcional)</span></label>
        <input type="number" id="price" name="price" step="0.01" placeholder="Dejar vacío si no aplica">
      </div>
      <div>
        <label>Mostrar precio</label>
        <select name="show_price"><option value="1">Sí</option><option value="0">No</option></select>
      </div>
      <div>
        <label>Activo</label>
        <select name="active"><option value="1">Sí</option><option value="0">No</option></select>
      </div>
      <div><label>Imagen</label><input type="file" name="image" accept=".jpg,.jpeg,.png"></div>

      <p id="form-error" style="color:#f09090; font-size:0.85rem; display:none;">Por favor llena los campos obligatorios (Nombre y Descripción).</p>

      <button type="submit">Agregar Postre</button>
      <?php if(isset($_GET['error'])) { ?><span class="error">Error: <?php echo $_GET['error']; ?></span><?php } ?>
    </form>

    <h2 class="admin-page-title" style="font-size:1.4rem; margin-bottom:20px;">Postres registrados</h2>
    <div class="items-container">
      <?php while($item = mysqli_fetch_array($result)) { ?>
        <div class="item-card">
          <?php if($item['image']) { ?>
            <img src="../assets/images/uploads/desserts/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
          <?php } else { ?>
            <div style="height:160px; background:rgba(201,168,76,0.05); display:flex; align-items:center; justify-content:center; color:#4a3820; font-size:2rem;">🍮</div>
          <?php } ?>
          <div class="item-info">
            <p class="item-name"><?php echo $item['name']; ?></p>
            <p class="item-desc"><?php echo $item['description']; ?></p>
            <?php if($item['price']) { ?><p class="item-price">$<?php echo number_format($item['price'], 2); ?></p><?php } ?>
            <div class="item-badges">
              <?php if($item['active']) { ?><span class="badge badge-active">Activo</span><?php } else { ?><span class="badge badge-inactive">Inactivo</span><?php } ?>
              <?php if($item['show_price']) { ?><span class="badge badge-price">Precio visible</span><?php } else { ?><span class="badge badge-noprice">Precio oculto</span><?php } ?>
            </div>
          </div>
          <div class="item-actions">
            <button class="btn-edit"   onclick="window.location.href='editDessert.php?id=<?php echo $item['id']; ?>'">Editar</button>
            <button class="btn-delete" onclick="confirmDelete('../db/deleteDessert.php?id=<?php echo $item['id']; ?>')">Eliminar</button>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <script src="../assets/js/main.js"></script>
  <script>
    function validateForm() {
        var name = document.getElementById('name').value.trim();
        var desc = document.getElementById('description').value.trim();
        if(name == '' || desc == '') {
            document.getElementById('form-error').style.display = 'block';
            return false;
        }
        return true;
    }
  </script>

</body>
</html>
