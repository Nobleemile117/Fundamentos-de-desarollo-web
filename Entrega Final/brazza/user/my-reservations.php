<?php
    require '../db/db.php';
    session_start();

    if(!isset($_SESSION["username"])) {
        header("Location: ../auth/login.php?error=Debes iniciar sesión");
        return;
    }

    $username  = $_SESSION["username"];
    $userQuery = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
    $user      = mysqli_fetch_array($userQuery);
    $user_id   = $user["id"];

    $sql    = "SELECT * FROM reservations WHERE user_id = $user_id ORDER BY date DESC";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Reservaciones – Brazza y Fogo</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>

  <!-- NAVBAR -->
  <nav>
    <div class="logo-wrap">
      <img src="../assets/images/brazza_logo.png" alt="Logo Brazza y Fogo">
      <div class="brand">Brazza y Fogo<span>San Luis Potosí</span></div>
    </div>
    <button class="hamburger" onclick="toggleMenu()">☰</button>
    <ul>
      <li><a href="../index.php">Inicio</a></li>
      <li><a href="../menu.php">Menú</a></li>
      <li><a href="add-reservation.php">Nueva Reservación</a></li>
      <li><a href="../db/logout.php">Cerrar Sesión</a></li>
    </ul>
  </nav>

  <section style="background: var(--dark);">
    <h2 class="section-title">Mis Reservaciones</h2>
    <div class="section-line"></div>

    <div class="reservations-list">

      <div style="text-align:right; margin-bottom: 24px;">
        <a href="add-reservation.php" class="btn">Nueva Reservación</a>
      </div>

      <?php
        $count = mysqli_num_rows($result);
        if($count == 0) {
      ?>
        <p style="text-align:center; color: #7a6540;">No tienes reservaciones aún.</p>
      <?php } ?>

      <?php while($res = mysqli_fetch_array($result)) { ?>
        <div class="reservation-card">
          <div class="res-info">
            <h3><?php echo $res['name']; ?></h3>
            <p>
              📅 <?php echo $res['date']; ?> &nbsp;·&nbsp;
              🕐 <?php echo $res['time']; ?> &nbsp;·&nbsp;
              👥 <?php echo $res['guests']; ?> personas
            </p>
            <?php if($res['notes']) { ?>
              <p style="margin-top: 6px; font-style: italic;">📝 <?php echo $res['notes']; ?></p>
            <?php } ?>
          </div>
          <div>
            <?php
              $status = $res['status'];
              $class  = "status-" . $status;
              $labels = array("pending" => "Pendiente", "confirmed" => "Confirmada", "cancelled" => "Cancelada");
            ?>
            <span class="status-badge <?php echo $class; ?>"><?php echo $labels[$status]; ?></span>
          </div>
        </div>
      <?php } ?>

    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <img src="../assets/images/brazza_logo.png" alt="Logo" class="footer-logo">
    <p><span class="gold-text">Brazza y Fogo</span> · San Luis Potosí · © 2024</p>
  </footer>

  <script src="../assets/js/main.js"></script>
</body>
</html>
