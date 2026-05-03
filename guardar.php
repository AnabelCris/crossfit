<?php
$conexion = new mysqli("localhost", "root", "", "crossfit");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// FIX: se cambió 'correo' por 'email' para que coincida con el campo del formulario HTML
if (!isset($_POST['nombre'], $_POST['email'], $_POST['telefono'])) {
    die("Faltan datos");
}

$nombre   = $_POST['nombre'];
$correo   = $_POST['email'];     // FIX: lee 'email' del formulario
$telefono = $_POST['telefono'];

$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, telefono) VALUES (?, ?, ?)");

if (!$stmt) {
    die("Error en prepare: " . $conexion->error);
}

$stmt->bind_param("sss", $nombre, $correo, $telefono);

if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error real: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>