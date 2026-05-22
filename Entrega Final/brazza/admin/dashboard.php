<?php
    require '../db/db.php';
    session_start();

    if(isset($_SESSION["username"])) {
        if($_SESSION["role"] != "admin") {
            header("Location: ../index.php?error=No tienes permisos para acceder al panel");
            return;
        }
    } else {
        header("Location: ../auth/login.php?error=No has iniciado sesión");
        return;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Admin – Brazza y Fogo</title>
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
      <li><a href="menu-food.php">Cortes</a></li>
      <li><a href="menu-drinks.php">Bebidas</a></li>
      <li><a href="menu-desserts.php">Postres</a></li>
      <li><a href="reviews.php">Reseñas</a></li>
      <li><a href="reservations.php">Reservaciones</a></li>
      <li><a href="users.php">Usuarios</a></li>
      <li><a href="../db/logout.php" class="nav-logout">Cerrar Sesión</a></li>
    </ul>
  </nav>

  <div class="admin-wrap">
    <h1 class="admin-page-title">Bienvenido, <?php echo $_SESSION["username"]; ?></h1>
    <p class="admin-page-sub">Panel de administración · Brazza y Fogo</p>

    <div class="dash-grid">
      <a href="menu-food.php" class="dash-card">
        <div class="dash-icon">🥩</div>
        <h3>Cortes</h3>
        <p>Administrar cortes de carne</p>
      </a>
      <a href="menu-drinks.php" class="dash-card">
        <div class="dash-icon">🍹</div>
        <h3>Bebidas</h3>
        <p>Administrar bebidas</p>
      </a>
      <a href="menu-desserts.php" class="dash-card">
        <div class="dash-icon">🍮</div>
        <h3>Postres</h3>
        <p>Administrar postres</p>
      </a>
      <a href="reviews.php" class="dash-card">
        <div class="dash-icon">⭐</div>
        <h3>Reseñas</h3>
        <p>Ver y eliminar reseñas</p>
      </a>
      <a href="reservations.php" class="dash-card">
        <div class="dash-icon">📅</div>
        <h3>Reservaciones</h3>
        <p>Gestionar reservaciones</p>
      </a>
      <a href="users.php" class="dash-card">
        <div class="dash-icon">👥</div>
        <h3>Usuarios</h3>
        <p>Ver usuarios registrados</p>
      </a>
    </div>
  </div>

  <script src="../assets/js/main.js"></script>
</body>
</html>
