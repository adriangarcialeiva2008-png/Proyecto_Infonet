<?php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

function json_response($status, $message) {
    echo json_encode(["status" => $status, "message" => $message]);
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infonet_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    json_response("error", "Conexión fallida al servidor");
}

// Recogemos las variables usando los atributos 'name' que pusimos en el HTML de index.php
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$servicio = isset($_POST['servicio']) ? trim($_POST['servicio']) : '';
$mensaje = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';

if (empty($nombre) || empty($email) || empty($servicio)) {
    json_response("error", "Por favor, rellena todos los campos obligatorios.");
}

// Preparamos la inserción apuntando exactamente a tus columnas: nombre, email, servicio, mensaje
$sql = "INSERT INTO presupuestos (nombre, email, servicio, mensaje) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    json_response("error", "Error en la preparación de la base de datos: " . $conn->error);
}

$stmt->bind_param("ssss", $nombre, $email, $servicio, $mensaje);

if ($stmt->execute()) {
    json_response("success", "¡Tu solicitud de presupuesto ha sido enviada con éxito!");
} else {
    json_response("error", "No se pudo guardar el presupuesto: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>