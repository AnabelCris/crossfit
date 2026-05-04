<?php
$conexion = new mysqli("localhost", "root", "", "crossfit");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre   = $_POST['nombre']   ?? '';
$correo   = $_POST['email']    ?? '';  // ✅ coincide con name="email" del HTML
$telefono = $_POST['telefono'] ?? '';

if (empty($nombre) || empty($correo) || empty($telefono)) {
    echo "campos vacios";
    exit();
}

$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, telefono) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $correo, $telefono);

if ($stmt->execute()) {
    echo "exitoso"; // ✅ el JS busca esta palabra
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>