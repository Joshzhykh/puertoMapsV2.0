<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "prueba_app");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica que los datos POST estén presentes
if (isset($_POST['nombre']) && isset($_POST['email'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Consulta SQL para verificar si el usuario existe
    $sql = "SELECT * FROM login_usuarios WHERE nombre='$nombre' AND email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario encontrado
        echo "Login exitoso";
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado";
    }
} else {
    echo "Faltan datos";
}

$conn->close();
?>
