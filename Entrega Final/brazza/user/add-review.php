<?php
    require '../db/db.php';
    session_start();

    if(!isset($_SESSION["username"])) {
        header("Location: ../auth/login.php?error=Debes iniciar sesión para agregar una reseña");
        return;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Reseña – Brazza y Fogo</title>
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
      <li><a href="my-reservations.php">Mis Reservaciones</a></li>
      <li><a href="../db/logout.php">Cerrar Sesión</a></li>
    </ul>
  </nav>

  <div class="form-page">
    <div class="form-card">
      <h2>Agregar Reseña</h2>
      <p class="form-subtitle">Bienvenido, <?php echo $_SESSION["username"]; ?></p>

      <form action="../db/insertReview.php" method="POST">

        <div class="form-group">
          <label for="visit_date">Fecha de visita</label>
          <input type="date" id="visit_date" name="visit_date">
        </div>

        <div class="form-group">
          <label for="stars">⭐ Calificación <span style="color:#7a6540; font-size:0.78rem;">(mín. 1 — máx. 5)</span></label>
          <input type="number" id="stars" name="stars" min="1" max="5" value="5">
        </div>

        <div class="form-group">
          <label for="comment">Comentario</label>
          <textarea id="comment" name="comment" placeholder="Cuéntanos tu experiencia..."></textarea>
        </div>

        <button type="submit" class="btn">Publicar Reseña</button>

        <?php if(isset($_GET['error'])) { ?>
          <p class="form-error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
      </form>
    </div>
  </div>

  <script src="../assets/js/main.js"></script>
</body>
</html>
