<?php
    require '../db/db.php';
    session_start();

    if(isset($_SESSION["username"])) {
        if($_SESSION["role"] != "admin") { header("Location: ../index.php?error=No tienes permisos"); return; }
    } else {
        header("Location: ../auth/login.php?error=No has iniciado sesión"); return;
    }

    $sql    = "SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios – Panel Admin</title>
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
      <li><a href="menu-desserts.php">Postres</a></li>
      <li><a href="reviews.php">Reseñas</a></li>
      <li><a href="reservations.php">Reservaciones</a></li>
      <li><a href="users.php" class="active">Usuarios</a></li>
      <li><a href="../db/logout.php" class="nav-logout">Cerrar Sesión</a></li>
    </ul>
  </nav>

  <div class="admin-wrap">
    <h1 class="admin-page-title">Usuarios</h1>
    <p class="admin-page-sub">Usuarios registrados en el sistema</p>

    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Registrado</th>
          </tr>
        </thead>
        <tbody>
          <?php while($user = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><?php echo $user['id']; ?></td>
              <td><?php echo $user['username']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td><?php echo $user['role']; ?></td>
              <td><?php echo $user['created_at']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="../assets/js/main.js"></script>
</body>
</html>
