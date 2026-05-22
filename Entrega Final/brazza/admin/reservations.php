<?php
    require '../db/db.php';
    session_start();

    if(isset($_SESSION["username"])) {
        if($_SESSION["role"] != "admin") { header("Location: ../index.php?error=No tienes permisos"); return; }
    } else {
        header("Location: ../auth/login.php?error=No has iniciado sesión"); return;
    }

    $sql    = "SELECT * FROM reservations ORDER BY date ASC";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservaciones – Panel Admin</title>
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
      <li><a href="reservations.php" class="active">Reservaciones</a></li>
      <li><a href="users.php">Usuarios</a></li>
      <li><a href="../db/logout.php" class="nav-logout">Cerrar Sesión</a></li>
    </ul>
  </nav>

  <div class="admin-wrap">
    <h1 class="admin-page-title">Reservaciones</h1>
    <p class="admin-page-sub">Gestionar todas las reservaciones</p>

    <?php if(isset($_GET['error'])) { ?><p style="color:#f09090; margin-bottom:16px;"><?php echo $_GET['error']; ?></p><?php } ?>

    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Personas</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Notas</th>
            <th>Estado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php while($res = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><?php echo $res['id']; ?></td>
              <td><?php echo $res['name']; ?></td>
              <td><?php echo $res['guests']; ?></td>
              <td><?php echo $res['date']; ?></td>
              <td><?php echo $res['time']; ?></td>
              <td><?php echo $res['notes']; ?></td>
              <td>
                <!-- Status update form -->
                <form action="../db/updateReservation.php" method="POST" style="display:inline;">
                  <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
                  <select name="status" class="status-select" onchange="this.form.submit()">
                    <option value="pending"   <?php if($res['status']=='pending')   echo 'selected'; ?>>Pendiente</option>
                    <option value="confirmed" <?php if($res['status']=='confirmed') echo 'selected'; ?>>Confirmada</option>
                    <option value="cancelled" <?php if($res['status']=='cancelled') echo 'selected'; ?>>Cancelada</option>
                  </select>
                </form>
              </td>
              <td>
                <button class="btn-delete-sm" onclick="confirmDelete('../db/deleteReservation.php?id=<?php echo $res['id']; ?>')">
                  Eliminar
                </button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="../assets/js/main.js"></script>
</body>
</html>
