<?php
    require '../db/db.php';
    session_start();

    if(!isset($_SESSION["username"])) {
        header("Location: ../auth/login.php?error=Debes iniciar sesión para hacer una reservación");
        return;
    }

    // Today's date for the min attribute on the date input
    $today = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservación – Brazza y Fogo</title>
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
      <h2>Nueva Reservación</h2>
      <p class="form-subtitle">Bienvenido, <?php echo $_SESSION["username"]; ?> &nbsp;·&nbsp; <span style="color:#7a6540;">* campos obligatorios</span></p>

      <form action="../db/insertReservation.php" method="POST" onsubmit="return validateReservation()">

        <div class="form-group">
          <label for="name">Nombre para la reservación *</label>
          <input type="text" id="name" name="name" placeholder="Nombre completo">
        </div>

        <div class="form-group">
          <label for="guests">Número de personas * <span style="color:#7a6540; font-size:0.78rem;">(máximo 20)</span></label>
          <input type="number" id="guests" name="guests" min="1" max="20" placeholder="¿Cuántas personas?">
        </div>

        <div class="form-group">
          <label for="date">Fecha * <span style="color:#7a6540; font-size:0.78rem;">(solo fechas futuras)</span></label>
          <input type="date" id="date" name="date" min="<?php echo $today; ?>">
        </div>

        <div class="form-group">
          <label for="time">Hora *</label>
          <select id="time" name="time">
            <option value="">-- Selecciona una hora --</option>
            <option value="12:00">12:00 PM</option>
            <option value="12:30">12:30 PM</option>
            <option value="13:00">1:00 PM</option>
            <option value="13:30">1:30 PM</option>
            <option value="14:00">2:00 PM</option>
            <option value="14:30">2:30 PM</option>
            <option value="15:00">3:00 PM</option>
            <option value="15:30">3:30 PM</option>
            <option value="16:00">4:00 PM</option>
            <option value="16:30">4:30 PM</option>
            <option value="17:00">5:00 PM</option>
            <option value="17:30">5:30 PM</option>
            <option value="18:00">6:00 PM</option>
            <option value="18:30">6:30 PM</option>
            <option value="19:00">7:00 PM</option>
            <option value="19:30">7:30 PM</option>
            <option value="20:00">8:00 PM</option>
            <option value="20:30">8:30 PM</option>
            <option value="21:00">9:00 PM</option>
            <option value="21:30">9:30 PM</option>
            <option value="22:00">10:00 PM</option>
            <option value="22:30">10:30 PM</option>
            <option value="23:00">11:00 PM</option>
          </select>
        </div>

        <div class="form-group">
          <label for="notes">Notas especiales <span style="color:#7a6540; font-size:0.78rem;">(opcional)</span></label>
          <textarea id="notes" name="notes" placeholder="Alergias, celebraciones, etc."></textarea>
        </div>

        <p id="res-error" style="color:#f09090; font-size:0.85rem; margin-bottom:12px; display:none;"></p>

        <button type="submit" class="btn">Confirmar Reservación</button>

        <?php if(isset($_GET['error'])) { ?>
          <p class="form-error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
      </form>
    </div>
  </div>

  <script src="../assets/js/main.js"></script>
  <script>
    function validateReservation() {
        var name   = document.getElementById('name').value.trim();
        var guests = document.getElementById('guests').value;
        var date   = document.getElementById('date').value;
        var time   = document.getElementById('time').value;
        var error  = document.getElementById('res-error');
        var today  = new Date().toISOString().split('T')[0];

        if(name == '' || guests == '' || date == '' || time == '') {
            error.innerHTML = 'Por favor llena todos los campos obligatorios (*).';
            error.style.display = 'block';
            return false;
        }

        if(date < today) {
            error.innerHTML = 'La fecha no puede ser en el pasado. Elige una fecha futura.';
            error.style.display = 'block';
            return false;
        }

        if(parseInt(guests) < 1 || parseInt(guests) > 20) {
            error.innerHTML = 'El número de personas debe ser entre 1 y 20.';
            error.style.display = 'block';
            return false;
        }

        return true;
    }
  </script>
</body>
</html>
