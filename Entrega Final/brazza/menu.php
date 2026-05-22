<?php
    require 'db/db.php';
    session_start();

    // Load all active food, drinks, desserts and all reviews
    $foodResult    = mysqli_query($conn, "SELECT * FROM food WHERE active = 1");
    $drinkResult   = mysqli_query($conn, "SELECT * FROM drinks WHERE active = 1");
    $dessertResult = mysqli_query($conn, "SELECT * FROM desserts WHERE active = 1");
    $reviewResult  = mysqli_query($conn, "SELECT * FROM reviews ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú – Brazza y Fogo</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

  <!-- NAVBAR -->
  <nav>
    <div class="logo-wrap">
      <img src="assets/images/brazza_logo.png" alt="Logo Brazza y Fogo">
      <div class="brand">Brazza y Fogo<span>San Luis Potosí</span></div>
    </div>
    <button class="hamburger" onclick="toggleMenu()">☰</button>
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="index.php#nosotros">Nosotros</a></li>
      <li><a href="menu.php" class="nav-active">Menú</a></li>
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

  <!-- MENÚ SECTION -->
  <section id="menu">
    <h2 class="section-title">Nuestro Menú</h2>
    <div class="section-line"></div>

    <!-- TABS -->
    <div class="menu-tabs">
      <button class="tab-btn active" onclick="showTab('tab-food', this)">Cortes</button>
      <button class="tab-btn"       onclick="showTab('tab-drinks', this)">Bebidas</button>
      <button class="tab-btn"       onclick="showTab('tab-desserts', this)">Postres</button>
    </div>

    <!-- CORTES -->
    <div id="tab-food" class="tab-content active">
      <div class="menu-grid">
        <?php while($item = mysqli_fetch_array($foodResult)) { ?>
          <div class="menu-card <?php if(!$item['image']) echo 'menu-card-noimg'; ?>">
            <?php if($item['image']) { ?>
              <img src="assets/images/uploads/food/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
            <?php } else { ?>
              <div class="menu-card-icon">🥩</div>
            <?php } ?>
            <div class="menu-card-info">
              <h3><?php echo $item['name']; ?></h3>
              <p><?php echo $item['description']; ?></p>
              <?php if($item['show_price'] && $item['price']) { ?>
                <p class="price">$<?php echo number_format($item['price'], 2); ?></p>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

    <!-- BEBIDAS -->
    <div id="tab-drinks" class="tab-content">
      <div class="menu-grid">
        <?php while($item = mysqli_fetch_array($drinkResult)) { ?>
          <div class="menu-card <?php if(!$item['image']) echo 'menu-card-noimg'; ?>">
            <?php if($item['image']) { ?>
              <img src="assets/images/uploads/drinks/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
            <?php } else { ?>
              <div class="menu-card-icon">🍹</div>
            <?php } ?>
            <div class="menu-card-info">
              <h3><?php echo $item['name']; ?></h3>
              <p><?php echo $item['description']; ?></p>
              <?php if($item['show_price'] && $item['price']) { ?>
                <p class="price">$<?php echo number_format($item['price'], 2); ?></p>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

    <!-- POSTRES -->
    <div id="tab-desserts" class="tab-content">
      <div class="menu-grid">
        <?php while($item = mysqli_fetch_array($dessertResult)) { ?>
          <div class="menu-card <?php if(!$item['image']) echo 'menu-card-noimg'; ?>">
            <?php if($item['image']) { ?>
              <img src="assets/images/uploads/desserts/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
            <?php } else { ?>
              <div class="menu-card-icon">🍮</div>
            <?php } ?>
            <div class="menu-card-info">
              <h3><?php echo $item['name']; ?></h3>
              <p><?php echo $item['description']; ?></p>
              <?php if($item['show_price'] && $item['price']) { ?>
                <p class="price">$<?php echo number_format($item['price'], 2); ?></p>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- RESEÑAS SECTION -->
  <section class="reviews-section" id="reviews">
    <h2 class="section-title">Reseñas</h2>
    <div class="section-line"></div>

    <div class="reviews-grid">
      <?php while($review = mysqli_fetch_array($reviewResult)) { ?>
        <div class="review-card">
          <div class="stars">
            <?php
              for($i = 1; $i <= 5; $i++) {
                  echo ($i <= $review['stars']) ? "⭐" : "☆";
              }
            ?>
          </div>
          <p class="review-author"><?php echo $review['author_name']; ?></p>
          <p class="review-date">Visitó el <?php echo $review['visit_date']; ?></p>
          <p class="review-comment"><?php echo $review['comment']; ?></p>
        </div>
      <?php } ?>
    </div>

    <!-- CTA para agregar reseña -->
    <div class="review-cta">
      <?php if(isset($_SESSION["username"])) { ?>
        <a href="user/add-review.php" class="btn">Agregar Reseña</a>
      <?php } else { ?>
        <p>¿Visitaste el restaurante? Inicia sesión para dejar tu reseña.</p>
        <a href="auth/login.php" class="btn">Iniciar Sesión</a>
      <?php } ?>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <img src="assets/images/brazza_logo.png" alt="Logo" class="footer-logo">
    <p><span class="gold-text">Brazza y Fogo</span> · San Luis Potosí · © 2026</p>
  </footer>

  <script src="assets/js/main.js"></script>
</body>
</html>
