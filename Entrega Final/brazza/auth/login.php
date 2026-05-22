<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión – Brazza y Fogo</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/main.css">
  <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

  <div class="auth-page">
    <div class="auth-card">

      <div class="auth-logo">
        <img src="../assets/images/brazza_logo.png" alt="Brazza y Fogo">
        <h2>Brazza y Fogo</h2>
        <p>Iniciar Sesión</p>
      </div>

      <form class="auth-form" action="../db/loginUser.php" method="POST">
        <div>
          <label for="username">Usuario</label>
          <input type="text" id="username" name="username" placeholder="Tu usuario">
        </div>
        <div>
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="Tu contraseña">
        </div>

        <button type="submit">Entrar</button>

        <?php if(isset($_GET['error'])) { ?>
          <span class="error"><?php echo $_GET['error']; ?></span>
        <?php } ?>
      </form>

      <div class="auth-switch">
        ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
      </div>

    </div>
  </div>

</body>
</html>
