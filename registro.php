<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "12345678";
$db = "usuarios_db"; // Cámbialo por el nombre real

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $clave_plana = trim($_POST["clave"]);
    $clave_segura = password_hash($clave_plana, PASSWORD_DEFAULT);

    // Verifica si el correo ya existe
    $check = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $check->bind_param("s", $correo);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "⚠️ El correo ya está registrado. <a href='registro.html'>Volver</a>";
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, clave, clave_confirmacion) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $clave_segura, $clave_segura);


        if ($stmt->execute()) {
            echo "✅ Usuario registrado con éxito. <a href='login.html'>Iniciar sesión</a>";
        } else {
            echo "❌ Error al registrar el usuario.";
        }

        $stmt->close();
    }

    $check->close();
}

$conn->close();
?>
