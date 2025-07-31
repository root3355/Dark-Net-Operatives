<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "12345678";
$db = "usuarios_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST["correo"]);
    $clave = trim($_POST["clave"]);

    $stmt = $conn->prepare("SELECT id, nombre, clave FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($clave, $usuario["clave"])) {
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["nombre"] = $usuario["nombre"];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<p class='msg'>Contraseña incorrecta.</p>";
        }
    } else {
        echo "<p class='msg'>Correo no registrado.</p>";
    }

    $stmt->close();
}
$conn->close();
?>
