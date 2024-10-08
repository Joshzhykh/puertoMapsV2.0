<?php

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "prueba_app");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $tipoUsuario = $_POST['tipoUsuario'];

    // Preparar la consulta para evitar inyección SQL
    $stmt = $conn->prepare("INSERT INTO login_usuarios (nombre, email, direccion, telefono, contrasena, tipoUsuario, fecha_registro) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssss", $nombre, $email, $direccion, $telefono, $contrasena, $tipoUsuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
