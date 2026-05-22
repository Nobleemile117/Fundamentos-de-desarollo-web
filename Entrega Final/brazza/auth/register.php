<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse – Brazza y Fogo</title>
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
        <p>Crear Cuenta</p>
      </div>

      <form class="auth-form" action="../db/registerUser.php" method="POST">
        <div>
          <label for="username">Usuario</label>
          <input type="text" id="username" name="username" placeholder="Elige un usuario">
        </div>
        <div>
          <label for="email">Correo Electrónico</label>
          <input type="email" id="email" name="email" placeholder="tu@correo.com">
        </div>
        <div>
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="Crea una contraseña">
        </div>

        <button type="submit">Registrarse</button>

        <?php if(isset($_GET['error'])) { ?>
          <span class="error"><?php echo $_GET['error']; ?></span>
        <?php } ?>
      </form>

      <div class="auth-switch">
        ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
      </div>

    </div>
  </div>

</body>
</html>
