<?php
// Ocultamos errores para asegurar que la salida sea un JSON puro
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

// Función para devolver respuestas uniformes
function json_response($status, $message) {
    echo json_encode(["status" => $status, "message" => $message]);
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infonet_db";

// Intentamos la conexión capturando excepciones de mysqli
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
    json_response("error", "Conexión fallida al servidor de base de datos.");
}

// Recogida de datos del formulario de registro
$nombre = isset($_POST['reg_nombre']) ? trim($_POST['reg_nombre']) : '';
$email = isset($_POST['reg_email']) ? trim($_POST['reg_email']) : '';
$pass = isset($_POST['reg_password']) ? $_POST['reg_password'] : '';

// Validación básica
if (empty($nombre) || empty($email) || empty($pass)) {
    json_response("error", "Faltan campos obligatorios");
}

$password_hashed = password_hash($pass, PASSWORD_BCRYPT);

try {
    // Consulta de inserción CORREGIDA: Sin 'servicio_contratado'
    $sql_insert = "INSERT INTO clientes (nombre, email, password) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);

    if (!$stmt_insert) {
        json_response("error", "Error preparando la consulta: " . $conn->error);
    }

    // CORREGIDO: Ahora son 3 strings ("sss") para nombre, email y password
    $stmt_insert->bind_param("sss", $nombre, $email, $password_hashed);
        
    if ($stmt_insert->execute()) {
        json_response("success", "¡Éxito! Cuenta creada correctamente. Ya puedes iniciar sesión.");
    } else {
        // Por si el email ya existe en la base de datos (clave única)
        json_response("error", "No se pudo registrar. ¿Es posible que el email ya esté en uso?");
    }

    $stmt_insert->close();
} catch (Exception $e) {
    // Si MySQL lanza un fallo crítico, lo capturamos y lo enviamos en formato JSON limpio
    json_response("error", "Error interno de base de datos: " . $e->getMessage());
}

$conn->close();