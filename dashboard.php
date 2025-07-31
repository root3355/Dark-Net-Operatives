<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido</title>
  <style>
    body {
      background-color: #eafaf1;
      font-family: sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .box {
      background: #ffffff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h1 {
      color: #1f4037;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #ffffff;
      background-color: #1f4037;
      padding: 10px 20px;
      border-radius: 8px;
    }

    a:hover {
      background-color: #145a32;
    }
  </style>
</head>
<body>
  <div class="box">
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"]); ?> 👋</h1>
    <a href="logout.php">Cerrar sesión</a>
  </div>
</body>
</html>
