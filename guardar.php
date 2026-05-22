<?php
header('Content-Type: application/json');

$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "infonet_db";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    echo json_encode(["status" => "error", "message" => "Fallo de conexión"]);
    exit;
}

// Recogemos los datos usando el atributo 'name' del HTML
$nombre   = $_POST['nombre'] ?? '';
$email    = $_POST['email'] ?? '';
$mensaje  = $_POST['mensaje'] ?? '';
$servicio = $_POST['servicio'] ?? '';

if (empty($nombre) || empty($email)) {
    echo json_encode(["status" => "error", "message" => "Faltan campos obligatorios"]);
    exit;
}

$sql = "INSERT INTO solicitudes (nombre, email, mensaje, servicio) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $nombre, $email, $mensaje, $servicio);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "¡Guardado con éxito!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al guardar"]);
}

$stmt->close();
$conexion->close();
?>