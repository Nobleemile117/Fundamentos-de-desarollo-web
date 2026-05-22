<?php
    require 'db/db.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Brazza y Fogo – SLP</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

  <!-- NAVBAR -->
  <nav>
    <div class="logo-wrap">
      <img src="assets/images/brazza_logo.png" alt="Logo Brazza y Fogo">
      <div class="brand">
        Brazza y Fogo
        <span>San Luis Potosí</span>
      </div>
    </div>

    <button class="hamburger" onclick="toggleMenu()">☰</button>

    <ul>
      <li><a href="index.php" class="nav-active">Inicio</a></li>
      <li><a href="index.php#nosotros">Nosotros</a></li>
      <li><a href="menu.php">Menú</a></li>
      <li><a href="index.php#galeria">Galería</a></li>
      <li><a href="index.php#contacto">Contacto</a></li>

      <?php if(isset($_SESSION["username"])) { ?>
        <li><a href="menu.php#reviews">Reseñas</a></li>
        <?php if($_SESSION["role"] == "admin") { ?>
          <li><a href="admin/dashboard.php">Panel Admin</a></li>
        <?php } ?>
        <li><a href="user/my-reservations.php">Mis Reservaciones</a></li>
        <li><a href="db/logout.php">Cerrar Sesión</a></li>
      <?php } else { ?>
        <li><a href="auth/login.php" class="nav-login">Iniciar Sesión</a></li>
        <li><a href="auth/register.php" class="nav-register">Registrarse</a></li>
      <?php } ?>
    </ul>
  </nav>

  <?php if(isset($_GET['error'])) { ?>
    <div class="msg-error"><?php echo $_GET['error']; ?></div>
  <?php } ?>

  <!-- HERO -->
  <section class="hero" id="inicio">
    <div class="hero-content">
      <img src="assets/images/brazza_logo.png" alt="Brazza y Fogo" class="hero-logo">
      <h1>BRAZZA <span>&</span> FOGO</h1>
      <p class="tagline">Churrascaria · San Luis Potosí</p>
      <a href="menu.php" class="btn">Ver Menú</a>
    </div>
  </section>

  <!-- NOSOTROS -->
  <section id="nosotros" style="background: var(--dark);">
    <h2 class="section-title">Nuestra Historia</h2>
    <div class="section-line"></div>
    <div class="about">
      <div class="about-text">
        <h2>El arte del fuego en cada corte</h2>
        <p>
          En Brazza y Fogo traemos la auténtica tradición de la churrascaria brasileña
          al corazón de San Luis Potosí. Cada pieza de carne es seleccionada con precisión,
          marinada con secretos de la casa y asada lentamente sobre brasas vivas.
        </p>
        <p>
          Nuestro rodízio ofrece una experiencia sin límites: cortes premium que desfilan
          por tu mesa uno tras otro, acompañados de ensaladas frescas, yuca frita, piña asada
          y mucho más.
        </p>
        <p>
          Más que un restaurante, Brazza y Fogo es una celebración del fuego, la carne y
          la buena compañía.
        </p>
      </div>
      <div class="about-img-grid">
        <img src="assets/images/1.jpeg" alt="Carne a la brasa">
        <img src="assets/images/2.jpeg" alt="Espetinho">
        <img src="assets/images/3.jpeg" alt="Costillas">
      </div>
    </div>
  </section>

  <!-- GALERÍA -->
  <section id="galeria">
    <h2 class="section-title">Galería</h2>
    <div class="section-line"></div>
    <div class="gallery-grid">
      <img src="assets/images/4.jpeg"  alt="galeria 1">
      <img src="assets/images/5.jpeg"  alt="galeria 2">
      <img src="assets/images/6.jpeg"  alt="galeria 3">
      <img src="assets/images/7.jpeg"  alt="galeria 4">
      <img src="assets/images/8.jpeg"  alt="galeria 5">
      <img src="assets/images/9.jpeg"  alt="galeria 6">
      <img src="assets/images/10.jpeg" alt="galeria 7">
      <img src="assets/images/11.jpeg" alt="galeria 8">
    </div>
  </section>

  <!-- CONTACTO -->
  <section id="contacto">
    <h2 class="section-title">Visítanos</h2>
    <div class="section-line"></div>
    <div class="contact-wrap">
      <div class="contact-info">
        <h3>Información</h3>
        <div class="contact-item">
          <div class="contact-icon">📍</div>
          <p><strong>Dirección</strong>San Luis Potosí, S.L.P., México</p>
        </div>
        <div class="contact-item">
          <div class="contact-icon">🕐</div>
          <p>
            <strong>Horario</strong>
            Lunes – Jueves: 12:00 pm – 10:00 pm<br>
            Viernes – Domingo: 12:00 pm – 11:00 pm
          </p>
        </div>
        <div class="contact-item">
          <div class="contact-icon">📞</div>
          <p><strong>Reservaciones</strong>+52 444 000 0000</p>
        </div>
        <div class="contact-item">
          <div class="contact-icon">📸</div>
          <p><strong>Instagram</strong>@brazzayfogo_slp</p>
        </div>
      </div>
      <div class="map-placeholder">
        <span>🗺️</span>
        <p>San Luis Potosí, S.L.P.</p>
        <p style="font-size:0.75rem; opacity:0.6;">Próximamente mapa interactivo</p>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <img src="assets/images/brazza_logo.png" alt="Logo" class="footer-logo">
    <p><span class="gold-text">Brazza y Fogo</span> · San Luis Potosí · © 2026</p>
    <p style="margin-top:8px;">La auténtica experiencia churrascaria</p>
  </footer>

  <script src="assets/js/main.js"></script>
</body>
</html>
